<?php

namespace App\Filament\Clusters\BukuMenu\Resources;

use Filament\Forms;
use App\Models\Menu;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\BukuMenu;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\BukuMenu\Resources\MenuResource\Pages;
use App\Filament\Clusters\BukuMenu\Resources\MenuResource\RelationManagers;
use App\Models\Category;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = BukuMenu::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Select::make('category_id')
                        ->options(Category::all()->pluck('name', 'id')->mapWithKeys(fn($name, $id) => [$id => ucfirst($name)]))
                        ->searchable()
                        ->required(),
                    TextInput::make('name')
                        ->unique(ignoreRecord: true)
                        ->required(),
                    TextInput::make('price')
                        ->required(),
                ])
                    ->columnSpan(1),
                Section::make([
                    SpatieMediaLibraryFileUpload::make('foto_menu')
                        ->collection('foto_menu')
                        ->disk('public')
                        ->required(),
                    RichEditor::make('description')
                        ->required()
                ])
                    ->columnSpan(3),
            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->searchable(),
                TextColumn::make('price')
                    ->money('IDR', true)
                    ->searchable(),
                TextColumn::make('category.name')
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('foto_menu')
                    ->collection('foto_menu')
                    ->circular()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
