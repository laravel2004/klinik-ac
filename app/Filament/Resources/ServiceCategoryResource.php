<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceCategoryResource\Pages;
use App\Models\ServiceCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return __('label.service_category');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('label.nav.group.service_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('label.service_category');
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
                            ->directory('thumbnails/service-category')
                            ->imagePreviewHeight(300)
                            ->image()
                            ->maxSize(1024),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('label.name'))
                                    ->required()
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state)
                                    => $set('slug', str()->slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->label(__('label.slug'))
                                    ->unique(ignoreRecord: true)
                                    ->readOnly(),
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
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('label.slug'))
                    ->color('primary')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('label.description'))
                    ->wrap()
                    ->limit()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('label.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('label.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
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
                                                ->label(__('label.name'))
                                                ->badge(),
                                            TextEntry::make('slug')
                                                ->label(__('label.slug'))
                                                ->color('primary'),
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
            'index' => Pages\ListServiceCategories::route('/'),
            'create' => Pages\CreateServiceCategory::route('/create'),
            'edit' => Pages\EditServiceCategory::route('/{record}/edit'),
        ];
    }
}
