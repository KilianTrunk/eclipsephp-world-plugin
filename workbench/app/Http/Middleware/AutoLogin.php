<?php

namespace Workbench\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Workbench\App\Models\User;

class AutoLogin
{
    public function handle(Request $request, Closure $next)
    {
        Log::debug('[Workbench] AutoLogin middleware triggered', [
            'env' => config('app.env'),
            'authenticated' => Auth::check(),
            'guard' => config('auth.defaults.guard'),
            'path' => $request->path(),
        ]);

        if (config('app.env') === 'local' && ! Auth::guard('web')->check()) {
            $dbPath = config('database.connections.sqlite.database');
            $userCount = (int) DB::table('users')->count();
            Log::debug('[Workbench] AutoLogin DB info', [
                'sqlite_path' => $dbPath,
                'sqlite_exists' => is_string($dbPath) ? file_exists($dbPath) : null,
                'users_count' => $userCount,
            ]);

            $user = User::query()->first();
            Log::debug('[Workbench] AutoLogin user lookup', ['found' => (bool) $user]);

            if ($user) {
                $this->bootstrapPermissionsAndAssign($user);
                Auth::guard('web')->login($user);
                $request->session()->regenerate();
                Log::info('[Workbench] AutoLogin successfully logged in first user', ['user_id' => $user->id]);

                // If we are on the login page, skip it after auto-login
                if ($request->is('admin/login')) {
                    return redirect()->to('/admin');
                }
            } else {
                Log::warning('[Workbench] AutoLogin could not find any users to login — creating default admin user');
                $created = User::query()->create([
                    'name' => 'Admin User',
                    'email' => 'test@example.com',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]);
                if ($created) {
                    $this->bootstrapPermissionsAndAssign($created);
                    Auth::guard('web')->login($created);
                    $request->session()->regenerate();
                    Log::info('[Workbench] AutoLogin created and logged in default user', ['user_id' => $created->id]);
                    if ($request->is('admin/login')) {
                        return redirect()->to('/admin');
                    }
                }
            }
        }

        return $next($request);
    }

    private function bootstrapPermissionsAndAssign(User $user): void
    {
        try {
            // Normalize guards first
            DB::table('permissions')->whereNull('guard_name')->orWhere('guard_name', '')->update(['guard_name' => 'web']);
            DB::table('roles')->whereNull('guard_name')->orWhere('guard_name', '')->update(['guard_name' => 'web']);

            // Generate Filament Shield permissions if none exist yet
            if (Permission::query()->count() === 0) {
                Artisan::call('shield:generate', [
                    '--all' => true,
                    '--panel' => 'admin',
                ]);
                Log::info('[Workbench] Generated Shield permissions');
            }

            // Reset caches/registrar to ensure guards are picked up
            Artisan::call('permission:cache-reset');
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            // Ensure roles with correct guard
            $existingSuper = Role::where('name', 'super_admin')->first();
            if ($existingSuper && $existingSuper->guard_name !== 'web') {
                $existingSuper->guard_name = 'web';
                $existingSuper->save();
            }
            $existingPanel = Role::where('name', 'panel_user')->first();
            if ($existingPanel && $existingPanel->guard_name !== 'web') {
                $existingPanel->guard_name = 'web';
                $existingPanel->save();
            }

            $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
            $panelUser = Role::firstOrCreate(['name' => 'panel_user', 'guard_name' => 'web']);

            $all = Permission::query()->where('guard_name', 'web')->get();
            if ($all->isNotEmpty()) {
                $superAdmin->syncPermissions($all->pluck('name')->all());
            }

            $user->syncRoles([$superAdmin->name, $panelUser->name]);
        } catch (\Throwable $e) {
            Log::error('[Workbench] Bootstrap permissions failed', ['message' => $e->getMessage()]);
        }
    }
}
