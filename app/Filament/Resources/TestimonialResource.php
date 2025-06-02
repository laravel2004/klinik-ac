<?php

namespace App\Filament\Resources;

use App\Enums\PublishStatus;
use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontFamily;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('label.testimonial');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('label.nav.group.customer_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('label.testimonial');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'info';
    }

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->withRoleAccess(parent::getEloquentQuery());
    }

    public static function table(Table $table): Table
    {
        $formatId = fn (string $state) => strtoupper($state);

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('label.id'))
                    ->fontFamily(FontFamily::Mono)
                    ->formatStateUsing($formatId)
                    ->tooltip($formatId)
                    ->limit(6)
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('user.id')
                    ->label(__('label.user_id'))
                    ->fontFamily(FontFamily::Mono)
                    ->formatStateUsing($formatId)
                    ->tooltip($formatId)
                    ->limit(6)
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('serviceOrder.id')
                    ->label(__('label.service_order_id'))
                    ->fontFamily(FontFamily::Mono)
                    ->formatStateUsing($formatId)
                    ->tooltip($formatId)
                    ->limit(6)
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('label.customer_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('label.customer_email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('serviceOrder.service.name')
                    ->label(__('label.service_name')),
                Tables\Columns\TextColumn::make('content')
                    ->label(__('label.content'))
                    ->wrap()
                    ->limit()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_publish')
                    ->label(__('label.is_publish'))
                    ->getStateUsing(fn (Testimonial $record): bool =>
                        $record->is_publish === PublishStatus::PUBLISHED
                    ),
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
                    ->relationship('serviceOrder.service', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple(),
            ])
            ->actions([
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
                                            ->iconColor(fn (Testimonial $record) =>
                                                $record->user->email_verified_at ? 'success' : 'warning'
                                            )
                                            ->tooltip(fn (Testimonial $record) =>
                                                $record->user->email_verified_at
                                                    ? __('label.verified') : __('label.not_verified')
                                            )
                                            ->hint(fn (Testimonial $record) =>
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
                                TextEntry::make('serviceOrder.service.id')
                                    ->label(__('label.id')),
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('serviceOrder.service.name')
                                            ->label(__('label.name')),
                                        TextEntry::make('serviceOrder.service.slug')
                                            ->label(__('label.slug'))
                                            ->color('primary'),
                                        TextEntry::make('serviceOrder.service.serviceCategory.name')
                                            ->label(__('label.category'))
                                            ->badge(),
                                        TextEntry::make('serviceOrder.service.serviceUnit.name')
                                            ->label(__('label.unit'))
                                            ->badge(),
                                        TextEntry::make('serviceOrder.service.price')
                                            ->label(__('label.price'))
                                            ->money('IDR'),
                                        IconEntry::make('serviceOrder.service.is_outside_area')
                                            ->label(__('label.is_outside_area')),
                                    ]),
                            ]),
                        Fieldset::make(__('label.order'))
                            ->schema([
                                TextEntry::make('serviceOrder.id')
                                    ->label(__('label.id'))
                                    ->fontFamily(FontFamily::Mono)
                                    ->formatStateUsing($formatId)
                                    ->tooltip(__('label.copyable'))
                                    ->copyable(),
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('serviceOrder.start_time')
                                            ->label(__('label.start_time'))
                                            ->dateTime(),
                                        TextEntry::make('serviceOrder.end_time')
                                            ->label(__('label.end_time'))
                                            ->dateTime(),
                                        TextEntry::make('serviceOrder.phone')
                                            ->label(__('label.phone')),
                                        TextEntry::make('serviceOrder.address')
                                            ->label(__('label.address'))
                                            ->columnSpanFull(),
                                        TextEntry::make('serviceOrder.notes')
                                            ->label(__('label.notes'))
                                            ->columnSpanFull(),
                                    ]),
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('serviceOrder.created_at')
                                            ->label(__('label.created_at'))
                                            ->dateTime(),
                                        TextEntry::make('serviceOrder.updated_at')
                                            ->label(__('label.updated_at'))
                                            ->dateTime(),
                                    ]),
                            ]),
                        Fieldset::make(__('label.testimonial'))
                            ->schema([
                                TextEntry::make('id')
                                    ->label(__('label.id'))
                                    ->fontFamily(FontFamily::Mono)
                                    ->formatStateUsing($formatId)
                                    ->tooltip(__('label.copyable'))
                                    ->copyable(),
                                IconEntry::make('is_publish')
                                    ->label(__('label.is_publish'))
                                    ->columnSpanFull(),
                                TextEntry::make('content')
                                    ->label(__('label.content'))
                                    ->markdown()
                                    ->columnSpanFull(),
                                TextEntry::make('created_at')
                                    ->label(__('label.created_at'))
                                    ->dateTime(),
                                TextEntry::make('updated_at')
                                    ->label(__('label.updated_at'))
                                    ->dateTime(),
                            ]),
                    ])->hiddenLabel(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 50, 100, 200]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
        ];
    }
}
