<?php

namespace Eclipse\World\Filament\Clusters\World\Resources;

use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Eclipse\World\Filament\Clusters\World;
use Eclipse\World\Filament\Clusters\World\Resources\CountryResource\Pages;
use Eclipse\World\Models\Country;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Country::class;

    protected static ?string $slug = 'countries';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = World::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                    ->required()
                    ->length(2)
                    ->unique(table: Country::class, ignoreRecord: true)
                    ->label('ID')
                    ->helperText('ISO-3166 Alpha-2 code'),

                TextInput::make('name')
                    ->label('Country name')
                    ->required(),

                TextInput::make('flag')
                    ->label('Flag')
                    ->suffixAction(function () {
                        if (class_exists('\TangoDevIt\FilamentEmojiPicker\EmojiPickerAction')) {
                            return \TangoDevIt\FilamentEmojiPicker\EmojiPickerAction::make('emoji-flag');
                        }

                        return null;
                    }),

                TextInput::make('a3_id')
                    ->required()
                    ->length(3)
                    ->label('Alpha-3 ID')
                    ->helperText('ISO-3166 Alpha-3 code'),

                TextInput::make('num_code')
                    ->numeric()
                    ->length(3)
                    ->label('ISO-3166 numeric code'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(50)
            ->defaultSort('name')
            ->striped()
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable()
                    ->width(100),

                TextColumn::make('name')
                    ->label('Country name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('flag')
                    ->label('Flag')
                    ->width(100),

                TextColumn::make('a3_id')
                    ->label('Alpha-3 ID')
                    ->searchable()
                    ->sortable()
                    ->width(100),

                TextColumn::make('num_code')
                    ->label('Num. code')
                    ->searchable()
                    ->sortable()
                    ->width(100),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                ActionGroup::make([
                    DeleteAction::make(),
                    RestoreAction::make(),
                    ForceDeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view_any',
            'create',
            'update',
            'restore',
            'restore_any',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
        ];
    }
}
