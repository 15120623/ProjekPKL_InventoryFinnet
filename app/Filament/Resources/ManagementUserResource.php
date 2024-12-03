<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManagementUserResource\Pages;
use App\Filament\Resources\ManagementUserResource\RelationManagers;
use App\Models\ManagementUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class ManagementUserResource extends Resource
{
    protected static ?string $model = ManagementUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Management User'; 
    protected static ?string $navigationLabel = 'User';
    protected static ?string $modelLabel = 'User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Section::make('INPUT USER')
            -> description()
            -> schema([
                Forms\Components\TextInput::make('name')
                ->label('Name')
                ->maxLength(255) 
                ->required(),

                Forms\Components\TextInput::make('usn')
                ->label('Username')
                ->maxLength(255) 
                ->required(),

                Forms\Components\Select::make('role')
                ->label('Role')
                ->required()
                ->options([
                    'Super Administrator' => 'Super Administrator',
                    'Pentester' => 'Pentester',
                    'Security Admin' => 'Security Admin',
                ]),
            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row')
                ->label('No')
                ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                ->label('Name')
                ->searchable(),
                Tables\Columns\TextColumn::make('usn')
                ->label('Username'),
                Tables\Columns\TextColumn::make('role')
                ->label('Role')
                ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status')
                ->options([
                'Super Administrator' => 'Super Administrator',
                'Pentester' => 'Pentester',
                'Security Admin' => 'Security Admin',
                ]),

            ])
            ->actions([
                Tables\Actions\DeleteAction::make('delete')
                ->icon('heroicon-s-trash')
                ->iconButton()
                ->color('danger'),
                
                Tables\Actions\EditAction::make()
                ->icon('heroicon-m-pencil-square')
                ->iconButton()
                ->color('primary'),
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
            'index' => Pages\ListManagementUsers::route('/'),
            'create' => Pages\CreateManagementUser::route('/create'),
            'edit' => Pages\EditManagementUser::route('/{record}/edit'),
        ];
    }
}
