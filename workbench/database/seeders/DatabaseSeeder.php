<?php

namespace Workbench\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Workbench\App\Models\User;
use Workbench\Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Starting database seeding...');
        // Log effective DB path to ensure seeding matches runtime
        try {
            $connection = config('database.default');
            $driver = config("database.connections.$connection.driver");
            $database = config("database.connections.$connection.database");
            Log::info('[Workbench][Seeder] Database configuration', [
                'connection' => $connection,
                'driver' => $driver,
                'database' => $database,
            ]);
        } catch (\Throwable $e) {
            // ignore
        }

        // Generate Filament Shield permissions for all resources
        $this->command->info('🛡️ Generating Filament Shield permissions...');
        Artisan::call('shield:generate', [
            '--all' => true,
            '--panel' => 'admin',
        ]);
        $this->command->info('✓ Shield permissions generated');

        // Get or create admin user
        $adminEmail = 'test@example.com';
        $adminPassword = 'password';

        $existingUser = User::where('email', $adminEmail)->first();

        if (! $existingUser) {
            $this->command->info('Creating new admin user...');
            $user = UserFactory::new()->create([
                'name' => 'Admin User',
                'email' => $adminEmail,
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]);
            $this->command->info("Admin user created with ID: {$user->id}");
        } else {
            $this->command->info('Using existing admin user...');
            // Ensure the user has the correct password
            $existingUser->update([
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]);
            $user = $existingUser;
            $this->command->info("Admin user found with ID: {$user->id}");
        }

        // Create super_admin role if it doesn't exist
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);
        $this->command->info("✓ Super admin role ensured: {$superAdminRole->name}");

        // Create panel_user role if it doesn't exist (required by Filament Shield)
        $panelUserRole = Role::firstOrCreate([
            'name' => 'panel_user',
            'guard_name' => 'web',
        ]);
        $this->command->info("✓ Panel user role ensured: {$panelUserRole->name}");

        // Get all existing roles
        $allRoles = Role::all();
        $this->command->info("Found {$allRoles->count()} total roles");

        // Assign all roles to the user
        if ($allRoles->count() > 0) {
            $user->syncRoles($allRoles);
            $assignedRoles = $user->getRoleNames()->toArray();
            $this->command->info('✓ Assigned roles to user: '.implode(', ', $assignedRoles));
        }

        // Get all permissions and assign them directly to the user (ensures super admin access)
        $allPermissions = Permission::all();
        if ($allPermissions->count() > 0) {
            $user->syncPermissions($allPermissions);
            $this->command->info("✓ Assigned {$allPermissions->count()} permissions directly to user");
        } else {
            $this->command->info('No permissions found in database');
        }

        // Verify the user was created/updated
        if ($user) {
            $this->command->info("✓ Admin user verified: {$user->email} (ID: {$user->id})");
            $this->command->info('✓ User roles: '.$user->getRoleNames()->implode(', '));
            $this->command->info('✓ Direct permissions: '.$user->getDirectPermissions()->count());
            $this->command->info('✓ All permissions: '.$user->getAllPermissions()->count());
        } else {
            $this->command->error('✗ Failed to create/update admin user!');
        }

        $this->command->info('Database seeding completed.');
        $this->command->info('');
        $this->command->info('🎯 Login Credentials:');
        $this->command->info("   Email: {$adminEmail}");
        $this->command->info("   Password: {$adminPassword}");
    }
}
