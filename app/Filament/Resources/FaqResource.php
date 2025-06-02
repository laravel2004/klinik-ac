<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function getModelLabel(): string
    {
        return __('label.faq');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('label.nav.group.guide');
    }

    public static function getNavigationLabel(): string
    {
        return __('label.faq');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('question')
                        ->label(__('label.question'))
                        ->required(),
                    Forms\Components\RichEditor::make('answer')
                        ->label(__('label.answer'))
                        ->required()
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'blockquote',
                            'h2',
                            'h3',
                            'strike',
                        ])
                        ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('question')
                    ->label(__('label.question'))
                    ->wrap()
                    ->limit()
                    ->searchable(),
                Tables\Columns\TextColumn::make('answer')
                    ->label(__('label.answer'))
                    ->wrap()
                    ->limit()
                    ->searchable(),
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
                                    Grid::make(1)
                                        ->schema([
                                        TextEntry::make('id')
                                            ->label(__('label.id')),
                                        TextEntry::make('question')
                                            ->label(__('label.question')),
                                        TextEntry::make('answer')
                                            ->label(__('label.answer'))
                                            ->markdown(),
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
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at')
            ->paginated([10, 25, 50, 100]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
