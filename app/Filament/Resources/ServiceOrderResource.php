<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Enums\ServiceLocationType;
use App\Filament\Resources\ServiceOrderResource\Pages;
use App\Models\ServiceOrder;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontFamily;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServiceOrderResource extends Resource
{
    protected static ?string $model = ServiceOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return __('label.order');
    }

    public static function getNavigationLabel(): string
    {
        return __('label.order');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('label.nav.group.customer_management');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', OrderStatus::PENDING)
            ->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return __('label.nav.badge.tooltip.order');
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('status', OrderStatus::PENDING)
            ->count() > 0 ? 'success' : 'danger';
    }

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->withRoleAccess(parent::getEloquentQuery());
    }

    public static function table(Table $table): Table
    {
        $formatId = fn (string $state) => strtoupper($state);

        return $table
            ->poll()
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('label.id'))
                    ->fontFamily(FontFamily::Mono)
                    ->formatStateUsing($formatId)
                    ->tooltip(__('label.copyable'))
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('label.customer_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('label.customer_email'))
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->label(__('label.service_name'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('service.price')
                    ->label(__('label.service_price'))
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\IconColumn::make('service.is_outside_area')
                    ->label(__('label.is_outside_area')),
                Tables\Columns\TextColumn::make('start_time')
                    ->label(__('label.start_time'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label(__('label.end_time'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('label.status'))
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('label.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('label.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('service')
                    ->label(__('label.service'))
                    ->relationship('service', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple(),
                Tables\Filters\SelectFilter::make('area')
                    ->label(__('label.area'))
                    ->options(ServiceLocationType::options())
                    ->modifyQueryUsing(function (Builder $query, $state) {
                        if ($state['value'] === null) {
                            return;
                        }

                        $query->whereHas('service', function ($q) use ($state) {
                            $q->where('is_outside_area', $state);
                        });
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->infolist([
                            Fieldset::make(__('label.customer'))
                                ->schema([
                                    TextEntry::make('user.id')
                                        ->label(__('label.id'))
                                        ->fontFamily(FontFamily::Mono)
                                        ->formatStateUsing($formatId)
                                        ->tooltip(__('label.copyable'))
                                        ->copyable(),
                                    Grid::make()
                                        ->schema([
                                            TextEntry::make('user.name')
                                                ->label(__('label.name')),
                                            TextEntry::make('user.email')
                                                ->label(__('label.email'))
                                                ->icon('heroicon-o-envelope')
                                                ->iconColor(fn (ServiceOrder $record) =>
                                                    $record->user->email_verified_at ? 'success' : 'warning'
                                                )
                                                ->tooltip(fn (ServiceOrder $record) =>
                                                    $record->user->email_verified_at
                                                        ? __('label.verified') : __('label.not_verified')
                                                )
                                                ->hint(fn (ServiceOrder $record) =>
                                                    $record->user->email_verified_at?->format('d/m/Y H:i:s')
                                                ),
                                            TextEntry::make('user.customerProfile.gender')
                                                ->label(__('label.gender'))
                                                ->badge()
                                                ->placeholder('-'),
                                            TextEntry::make('user.customerProfile.phone')
                                                ->label(__('label.phone'))
                                                ->placeholder('-'),
                                        ]),
                                ]),
                            Fieldset::make(__('label.service'))
                                ->schema([
                                    TextEntry::make('service.id')
                                        ->label(__('label.id')),
                                    Grid::make()
                                        ->schema([
                                            TextEntry::make('service.name')
                                                ->label(__('label.name')),
                                            TextEntry::make('service.slug')
                                                ->label(__('label.slug'))
                                                ->color('primary'),
                                            TextEntry::make('service.serviceCategory.name')
                                                ->label(__('label.category'))
                                                ->badge(),
                                            TextEntry::make('service.serviceUnit.name')
                                                ->label(__('label.unit'))
                                                ->badge(),
                                            TextEntry::make('service.price')
                                                ->label(__('label.price'))
                                                ->money('IDR'),
                                            IconEntry::make('service.is_outside_area')
                                                ->label(__('label.is_outside_area')),
                                        ]),
                                ]),
                            Fieldset::make(__('label.order'))
                                ->schema([
                                    TextEntry::make('id')
                                        ->label(__('label.id'))
                                        ->fontFamily(FontFamily::Mono)
                                        ->formatStateUsing($formatId)
                                        ->tooltip(__('label.copyable'))
                                        ->copyable(),
                                    Grid::make()
                                        ->schema([
                                            TextEntry::make('start_time')
                                                ->label(__('label.start_time'))
                                                ->dateTime(),
                                            TextEntry::make('end_time')
                                                ->label(__('label.end_time'))
                                                ->dateTime(),
                                            TextEntry::make('phone')
                                                ->label(__('label.phone')),
                                            TextEntry::make('status')
                                                ->label(__('label.status'))
                                                ->badge(),
                                            TextEntry::make('address')
                                                ->label(__('label.address'))
                                                ->columnSpanFull(),
                                            TextEntry::make('notes')
                                                ->label(__('label.notes'))
                                                ->columnSpanFull(),
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
                        ]),
                    Tables\Actions\Action::make('confirm')
                        ->label('Terima')
                        ->color(OrderStatus::CONFIRMED->getColor())
                        ->icon(OrderStatus::CONFIRMED->getIcon())
                        ->requiresConfirmation()
                        ->modalDescription('Pesanan akan berubah status menjadi DIKONFIRMASI. Apakah Anda yakin?')
                        ->action(function (ServiceOrder $record) {
                            $record->update([
                                'status' => OrderStatus::CONFIRMED,
                            ]);

                            Notification::make()
                                ->title('Berhasil mengonfirmasi pesanan')
                                ->success()
                                ->send();
                        })
                        ->visible(fn (ServiceOrder $record): bool =>
                            $record->status->value === OrderStatus::PENDING->value
                        ),
                    Tables\Actions\Action::make('onprogress')
                        ->label('Kerjakan')
                        ->color(OrderStatus::ONPROGRESS->getColor())
                        ->icon(OrderStatus::ONPROGRESS->getIcon())
                        ->requiresConfirmation()
                        ->modalDescription('Pesanan akan berubah status menjadi SEDANG DIKERJAKAN. Apakah Anda yakin?')
                        ->action(function (ServiceOrder $record) {
                            $record->update([
                                'status' => OrderStatus::ONPROGRESS,
                            ]);

                            Notification::make()
                                ->title('Berhasil mengubah status pesanan')
                                ->success()
                                ->send();
                        })
                        ->visible(fn (ServiceOrder $record): bool =>
                            $record->status->value === OrderStatus::CONFIRMED->value
                        ),
                    Tables\Actions\Action::make('complete')
                        ->label('Selesai')
                        ->color(OrderStatus::COMPLETED->getColor())
                        ->icon(OrderStatus::COMPLETED->getIcon())
                        ->requiresConfirmation()
                        ->modalDescription('Pesanan akan berubah status menjadi SELESAI. Apakah Anda yakin?')
                        ->action(function (ServiceOrder $record) {
                            $record->update([
                                'status' => OrderStatus::COMPLETED,
                            ]);

                            Notification::make()
                                ->title('Berhasil menyelesaikan pesanan')
                                ->success()
                                ->send();
                        })
                        ->visible(fn (ServiceOrder $record): bool =>
                            $record->status->value === OrderStatus::ONPROGRESS->value
                        ),
                    Tables\Actions\Action::make('cancel')
                        ->label('Batalkan')
                        ->color(OrderStatus::CANCELED->getColor())
                        ->icon(OrderStatus::CANCELED->getIcon())
                        ->requiresConfirmation()
                        ->modalDescription('Pesanan akan dibatalkan. Apakah Anda yakin?')
                        ->action(function (ServiceOrder $record) {
                            $record->update([
                                'status' => OrderStatus::CANCELED,
                            ]);

                            Notification::make()
                                ->title('Berhasil membatalkan pesanan')
                                ->success()
                                ->send();
                        })
                        ->visible(fn (ServiceOrder $record): bool =>
                            in_array($record->status, [
                                OrderStatus::CONFIRMED,
                                OrderStatus::ONPROGRESS,
                            ])
                        ),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 50, 100, 200]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceOrders::route('/'),
        ];
    }
}
