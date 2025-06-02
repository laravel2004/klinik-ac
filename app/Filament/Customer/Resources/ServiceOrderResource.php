<?php

namespace App\Filament\Customer\Resources;

use App\Enums\OrderStatus;
use App\Enums\ServiceLocationType;
use App\Filament\Customer\Resources\ServiceOrderResource\Pages;
use App\Models\ServiceOrder;
use Filament\Forms\Components\RichEditor;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
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

    public static function getModelLabel(): string
    {
        return __('label.order');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereIn('status', [OrderStatus::CONFIRMED, OrderStatus::ONPROGRESS])
            ->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return __('label.nav.badge.tooltip.order');
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::whereIn('status', [OrderStatus::CONFIRMED, OrderStatus::ONPROGRESS])
            ->count() > 0 ? 'success' : 'danger';
    }

    public static function getNavigationLabel(): string
    {
        return __('label.order');
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
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
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
							Fieldset::make(__('label.testimonial'))
								->schema([
                                    TextEntry::make('testimonial.content')
                                        ->label(__('label.content'))
                                        ->markdown()
                                        ->columnSpanFull(),
                                    TextEntry::make('testimonial.created_at')
                                        ->label(__('label.created_at'))
                                        ->dateTime(),
                                    TextEntry::make('testimonial.updated_at')
                                        ->label(__('label.updated_at'))
                                        ->dateTime(),
								])->visible(fn (ServiceOrder $record): bool => $record->testimonial()->exists()),
                        ]),
                    Tables\Actions\Action::make('cancel')
                        ->label('Batalkan')
                        ->color(OrderStatus::CANCELED->getColor())
                        ->icon('heroicon-o-x-mark')
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
                                OrderStatus::PENDING,
                                OrderStatus::CONFIRMED,
                            ])
						),
					Tables\Actions\Action::make('testimonial')
                        ->label('Ulasan')
                        ->color('info')
                        ->icon('heroicon-o-star')
                        ->requiresConfirmation()
                        ->modalDescription('Buat ulasan untuk pesanan Anda. Pastikan data yang Anda masukkan sudah benar.')
						->form([
							RichEditor::make('content')
								->required()
								->minLength(20)
								->disableToolbarButtons([
									'attachFiles',
									'codeBlock',
									'blockquote',
									'h2',
									'h3',
									'strike',
									'underline',
									'link',
									'orderedList',
									'bulletList',
								]),
						])
						->action(function (ServiceOrder $record, array $data) {
							$record->testimonial()->create([
								'user_id' => auth()->id(),
								'content' => $data['content'],
							]);

							Notification::make()
								->title('Berhasil membuat ulasan')
								->success()
								->send();
						})
                        ->visible(fn (ServiceOrder $record): bool =>
						    $record->status === OrderStatus::COMPLETED
							&& !$record->testimonial()->exists()
                        ),
                    Tables\Actions\DeleteAction::make()
                        ->visible(fn (ServiceOrder $record): bool =>
                            in_array($record->status, [
                                OrderStatus::COMPLETED,
                                OrderStatus::CANCELED,
                            ]) && !$record->testimonial()->exists()
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
