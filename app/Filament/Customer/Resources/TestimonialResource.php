<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
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

    public static function getModelLabel(): string
    {
        return __('label.testimonial');
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
                    ->fontFamily(FontFamily::Mono)
                    ->formatStateUsing($formatId)
                    ->tooltip($formatId)
                    ->limit(10)
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('serviceOrder.id')
                    ->fontFamily(FontFamily::Mono)
                    ->formatStateUsing($formatId)
                    ->tooltip($formatId)
                    ->limit(10)
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('serviceOrder.service.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('serviceOrder.service.price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->wrap()
                    ->limit(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('service')
                    ->relationship('serviceOrder.service', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->infolist([
                        Section::make()
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextEntry::make('id')
                                            ->fontFamily(FontFamily::Mono)
                                            ->formatStateUsing($formatId)
                                            ->copyable(),
                                        TextEntry::make('serviceOrder.id')
                                            ->fontFamily(FontFamily::Mono)
                                            ->formatStateUsing($formatId)
                                            ->copyable(),
                                        TextEntry::make('serviceOrder.service.id'),
                                    ]),
                            ]),
                        Section::make()
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        Group::make([
                                            TextEntry::make('serviceOrder.service.name'),
                                            TextEntry::make('serviceOrder.service.serviceCategory.name')
                                                ->badge(),
                                            TextEntry::make('serviceOrder.service.serviceUnit.name')
                                                ->badge(),
                                        ]),
                                        Group::make([
                                            IconEntry::make('serviceOrder.service.is_outside_area'),
                                            TextEntry::make('serviceOrder.service.price')
                                                ->money('IDR'),
                                            TextEntry::make('serviceOrder.status')
                                                ->badge(),
                                        ]),
                                    ]),
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('serviceOrder.address'),
                                        TextEntry::make('serviceOrder.notes'),
                                    ]),
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('serviceOrder.start_time')
                                            ->dateTime(),
                                        TextEntry::make('serviceOrder.end_time')
                                            ->dateTime(),
                                    ]),
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('serviceOrder.created_at')
                                            ->dateTime(),
                                        TextEntry::make('serviceOrder.updated_at')
                                            ->dateTime(),
                                    ]),
                            ]),
                        Section::make()
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('content')
                                            ->markdown()
                                            ->columnSpanFull(),
                                        TextEntry::make('created_at')
                                            ->dateTime(),
                                        TextEntry::make('updated_at')
                                            ->dateTime(),
                                    ]),
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
