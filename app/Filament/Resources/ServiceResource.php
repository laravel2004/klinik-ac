<?php

namespace App\Filament\Resources;

use App\Enums\ServiceLocationType;
use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('label.service');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('label.nav.group.service_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('label.service');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail')
                            ->label(__('label.thumbnail'))
                            ->required()
                            ->directory('thumbnails/service')
                            ->imagePreviewHeight(300)
                            ->image()
                            ->maxSize(1024),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Group::make([
                                    Forms\Components\TextInput::make('name')
                                        ->label(__('label.name'))
                                        ->required()
                                        ->live(debounce: 500)
                                        ->afterStateUpdated(fn (Forms\Set $set, ?string $state)
                                            => $set('slug', str()->slug($state))
                                        ),
                                    Forms\Components\TextInput::make('slug')
                                        ->label(__('label.slug'))
                                        ->unique(ignoreRecord: true)
                                        ->readOnly(),
                                    Forms\Components\Select::make('service_category_id')
                                        ->label(__('label.category'))
                                        ->relationship('serviceCategory', 'name')
                                        ->required()
                                        ->preload()
                                        ->searchable(),
                                ]),
                                Forms\Components\Group::make([
                                    Forms\Components\Select::make('service_unit_id')
                                        ->label(__('label.unit'))
                                        ->relationship('serviceUnit', 'name')
                                        ->required()
                                        ->preload()
                                        ->searchable(),
                                    Forms\Components\TextInput::make('price')
                                        ->label(__('label.price'))
                                        ->numeric()
                                        ->default(0)
                                        ->minValue(0)
                                        ->maxValue(999999999)
                                        ->prefix('Rp'),
                                    Forms\Components\Toggle::make('is_outside_area')
                                        ->label(__('label.is_outside_area'))
                                        ->inline(false),
                                ]),
                            ]),
                        Forms\Components\RichEditor::make('description')
                            ->label(__('label.description'))
                            ->required()
                            ->disableToolbarButtons([
                                'attachFiles',
                                'codeBlock',
                                'blockquote',
                                'h2',
                                'h3',
                                'strike',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('label.id'))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label(__('label.thumbnail'))
                    ->size(120)
                    ->square()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('label.name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('label.description'))
                    ->wrap()
                    ->limit()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('serviceCategory.name')
                    ->label(__('label.category'))
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('serviceUnit.name')
                    ->label(__('label.unit'))
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('label.price'))
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_outside_area')
                    ->label(__('label.is_outside_area'))
                    ->getStateUsing(fn (Service $record): bool =>
                        $record->is_outside_area === ServiceLocationType::OUTSIDE
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
                Tables\Filters\SelectFilter::make('category')
                    ->label(__('label.category'))
                    ->relationship('serviceCategory', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple(),
                Tables\Filters\SelectFilter::make('unit')
                    ->label(__('label.unit'))
                    ->relationship('serviceUnit', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->infolist([
                            Section::make()
                                ->schema([
                                    TextEntry::make('id')
                                        ->label(__('label.id')),
                                    ImageEntry::make('thumbnail')
                                        ->label(__('label.thumbnail'))
                                        ->size(250)
                                        ->square(),
                                    Grid::make()
                                        ->schema([
                                            TextEntry::make('name')
                                                ->label(__('label.name')),
                                            TextEntry::make('slug')
                                                ->label(__('label.slug'))
                                                ->color('primary'),
                                            TextEntry::make('price')
                                                ->label(__('label.price'))
                                                ->money('IDR'),
                                            IconEntry::make('is_outside_area')
                                                ->label(__('label.is_outside_area')),
                                            TextEntry::make('serviceCategory.name')
                                                ->label(__('label.category'))
                                                ->formatStateUsing(fn (Model $record): View => view(
                                                    'filament.components.tooltips.service-category',
                                                    ['category' => $record->serviceCategory],
                                                )),
                                            TextEntry::make('serviceUnit.name')
                                                ->label(__('label.unit'))
                                                ->formatStateUsing(fn (Model $record): View => view(
                                                    'filament.components.tooltips.service-unit',
                                                    ['unit' => $record->serviceUnit],
                                                )),
                                        ]),
                                    TextEntry::make('description')
                                        ->label(__('label.description'))
                                        ->markdown(),
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
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name')
            ->paginated([10, 25, 50, 100]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
