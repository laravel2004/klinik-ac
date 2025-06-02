<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Enums\Occupation;
use App\Enums\UserRole;
use App\Filament\Resources\CustomerResource\Pages;
use App\Models\User;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontFamily;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CustomerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('label.customer');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('label.nav.group.customer_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('label.customer');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::hasRole(UserRole::CUSTOMER->value)->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'info';
    }

    public static function table(Table $table): Table
    {
        $formatId = fn (string $state) => strtoupper($state);

        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('label.id'))
                    ->fontFamily(FontFamily::Mono)
                    ->formatStateUsing($formatId)
                    ->tooltip($formatId)
                    ->limit(10)
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('name')
                    ->label(__('label.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('label.email'))
                    ->icon('heroicon-o-envelope')
                    ->iconColor(fn (User $record) =>
                        $record->email_verified_at ? 'success' : 'warning')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('email_verified_at')
                    ->label(__('label.is_verified'))
                    ->boolean()
                    ->placeholder('-'),
                TextColumn::make('customerProfile.gender')
                    ->label(__('label.gender'))
                    ->badge()
                    ->placeholder('-'),
                TextColumn::make('customerProfile.birth_date')
                    ->label(__('label.birth_date'))
                    ->date()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('customerProfile.phone')
                    ->label(__('label.phone'))
                    ->placeholder('-')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('customerProfile.occupation')
                    ->label(__('label.occupation'))
                    ->badge()
                    ->placeholder('-'),
                TextColumn::make('customerProfile.address')
                    ->label(__('label.address'))
                    ->limit()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label(__('label.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('label.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('gender')
                    ->label(__('label.gender'))
                    ->options(Gender::options())
                    ->modifyQueryUsing(function (Builder $query, $state) {
                        if (!$state['value']) {
                            return;
                        }

                        $query->whereHas('customerProfile', function ($q) use ($state) {
                            $q->where('gender', $state);
                        });
                    }),
                SelectFilter::make('occupation')
                    ->label(__('label.occupation'))
                    ->options(Occupation::options())
                    ->modifyQueryUsing(function (Builder $query, $state) {
                        if (!$state['value']) {
                            return;
                        }

                        $query->whereHas('customerProfile', function ($q) use ($state) {
                            $q->where('occupation', $state);
                        });
                    }),
            ])
            ->actions([
                ViewAction::make()
                    ->infolist([
                        Section::make()
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        Group::make([
                                            TextEntry::make('id')
                                                ->label(__('label.id'))
                                                ->fontFamily(FontFamily::Mono)
                                                ->formatStateUsing($formatId)
                                                ->tooltip(__('label.copyable'))
                                                ->copyable(),
                                            TextEntry::make('name')
                                                ->label(__('label.name')),
                                            TextEntry::make('email')
                                                ->label(__('label.email'))
                                                ->icon('heroicon-o-envelope')
                                                ->iconColor(fn (User $record) =>
                                                    $record->email_verified_at ? 'success' : 'warning'
                                                )
                                                ->tooltip(fn (User $record) =>
                                                    $record->email_verified_at ? __('label.verified') : __('label.not_verified')
                                                )
                                                ->hint(fn (User $record) =>
                                                    $record->email_verified_at?->format('d/m/Y H:i:s')
                                                ),
                                            TextEntry::make('customerProfile.gender')
                                                ->label(__('label.gender'))
                                                ->badge()
                                                ->placeholder('-'),
                                        ]),
                                        Group::make([
                                            TextEntry::make('customerProfile.birth_date')
                                                ->label(__('label.birth_date'))
                                                ->date()
                                                ->placeholder('-'),
                                            TextEntry::make('customerProfile.phone')
                                                ->label(__('label.phone'))
                                                ->placeholder('-'),
                                            TextEntry::make('customerProfile.occupation')
                                                ->label(__('label.occupation'))
                                                ->badge()
                                                ->placeholder('-'),
                                            TextEntry::make('customerProfile.address')
                                                ->label(__('label.address'))
                                                ->placeholder('-'),
                                        ]),
                                    ]),
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('created_at')
                                            ->label(__('label.created_at'))
                                            ->dateTime(),
                                        TextEntry::make('updated_at')
                                            ->label(__('label.updated_at'))
                                            ->dateTime(),
                                    ]),
                            ]),
                    ])
                    ->hiddenLabel(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 50, 100, 200]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
        ];
    }
}
