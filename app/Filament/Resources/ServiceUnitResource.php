<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceUnitResource\Pages;
use App\Models\ServiceUnit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceUnitResource extends Resource
{
    protected static ?string $model = ServiceUnit::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('label.service_unit');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('label.nav.group.service_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('label.service_unit');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('label.name'))
                            ->required()
                            ->unique(ignoreRecord: true),
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
                Tables\Columns\TextColumn::make('name')
                    ->label(__('label.name'))
                    ->badge()
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
                                    TextEntry::make('name')
                                        ->label(__('label.name'))
                                        ->badge(),
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
            'index' => Pages\ListServiceUnits::route('/'),
            'create' => Pages\CreateServiceUnit::route('/create'),
            'edit' => Pages\EditServiceUnit::route('/{record}/edit'),
        ];
    }
}
