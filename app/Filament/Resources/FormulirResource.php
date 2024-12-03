<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormulirResource\Pages;
use App\Filament\Resources\FormulirResource\RelationManagers;
use App\Models\Formulir;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists\Components\Section;

class FormulirResource extends Resource
{
    protected static ?string $model = Formulir::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text'; 
    protected static ?string $navigationLabel = 'Inventory';
    protected static ?string $navigationGroup = 'Inventory Pentest'; 
    protected static ?string $modelLabel = 'Pentest';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                #SECTION 
            Forms\Components\Section::make('INPUT PENTEST')
            -> description('Isi informasi secara lengkap.')
            -> schema ([
                Forms\Components\Select::make('status')
                ->label('Status')
                ->required()
                ->options([
                    'Active' => 'Active',
                    'No Active' => 'No Active',
                ]),

                Forms\Components\Select::make('response')
                ->label('Web Response')
                ->options([
                    'Accessible' => 'Accessible',
                    'Block' => 'Block',
                    'Error' => 'Error',
                ]),

                Forms\Components\TextInput::make('domain')
                ->label('Domain')
                ->maxLength(255) #PERLU GA??
                ->required(),

                Forms\Components\TextInput::make('url')
                ->label('URL')
                ->url()
                ->maxLength(255),

                Forms\Components\Select::make('loc-a')
                ->label('Environment')
                ->required()
                ->options([
                    'PROD' => 'PROD',
                    'Development' => 'Development',
                ]),

                Forms\Components\Select::make('loc-b')
                ->label('Location')
                ->required()
                ->options([
                    'On Prem' => 'On Prem',
                    'Cloud' => 'Cloud',
                ]),
                Forms\Components\TextInput::make('dns-record')
                ->label('DNS Record')
                ->maxLength(255),

                Forms\Components\TextInput::make('dns-formula')
                ->label('Formula DNS')
                ->maxLength(255),

                Forms\Components\Select::make('vapt')
                ->label('Exclude / Include VAPT')
                ->options([
                    'Exclude' => 'Exclude',
                    'Include' => 'Include',
                ]),

                Forms\Components\TextInput::make('credential')
                ->label('Credential')
                ->maxLength(255),

                Forms\Components\TextArea::make('desc')
                ->label('Description')
                ->columnSpan('full')
                ->maxLength(255),

                Forms\Components\Select::make('pentest')
                ->label('Pentest')
                ->required()
                ->options([
                    'Yes' => 'Yes',
                    'No' => 'No',
                ]),

                Forms\Components\DatePicker::make('date')
                ->label('Latest Date')
                ->required(),

                Forms\Components\TextInput::make('critical')
                ->label('Critical')
                ->required()
                ->numeric(),

                Forms\Components\TextInput::make('high')
                ->label('High')
                ->required()
                ->numeric(),

                Forms\Components\TextInput::make('medium')
                ->label('Medium')
                ->required()
                ->numeric(),

                Forms\Components\TextInput::make('low')
                ->label('Low')
                ->required()
                ->numeric(),

                Forms\Components\TextInput::make('info')
                ->label('Info')
                ->maxLength(255)
                ->required(),

                Forms\Components\Select::make('method')
                ->label('Method')
                ->required()
                ->options ([
                    'Blackbox' => 'Blackbox',
                    'Whitebox' => 'Whitebox',
                    'Greybox' => 'Greybox',
                ]),

                Forms\Components\TextArea::make('note')
                ->label('Note')
                ->columnSpan('full')
                ->maxLength(255),
            ]) ->Columns(2), 
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row')
                ->label('No')
                ->rowIndex(),

                Tables\Columns\TextColumn::make('status')
                ->searchable(),
                
                Tables\Columns\TextColumn::make('response')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault:true),

                Tables\Columns\TextColumn::make('domain')
                ->searchable(),

                Tables\Columns\TextColumn::make('url')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault:true)
                ->label('URL'),

                Tables\Columns\TextColumn::make('loc-a')
                ->searchable()
                ->label('Environment'),

                Tables\Columns\TextColumn::make('loc-b')
                ->searchable()
                ->label('Location'),

                Tables\Columns\TextColumn::make('dns-record')
                ->toggleable(isToggledHiddenByDefault:true)
                ->searchable()
                ->label('DNS Record'),

                Tables\Columns\TextColumn::make('dns-formula')
                ->toggleable(isToggledHiddenByDefault:true)
                ->searchable()
                ->label('Formula DNS'),

                Tables\Columns\TextColumn::make('vapt')
                ->toggleable(isToggledHiddenByDefault:true)
                ->searchable()
                ->label('VAPT'),
                Tables\Columns\TextColumn::make('desc')
                ->toggleable(isToggledHiddenByDefault:true)
                ->searchable()
                ->label('Description'),
                Tables\Columns\TextColumn::make('credential')
                ->toggleable(isToggledHiddenByDefault:true)
                ->searchable(),

                Tables\Columns\TextColumn::make('pentest')
                ->searchable(),
                Tables\Columns\TextColumn::make('date')
                ->label('Latest Date'),
                Tables\Columns\TextColumn::make('critical'),
                Tables\Columns\TextColumn::make('high'),
                Tables\Columns\TextColumn::make('medium'),
                Tables\Columns\TextColumn::make('low'),
                Tables\Columns\TextColumn::make('info')
                ->searchable(),
                Tables\Columns\TextColumn::make('method')
                ->searchable(),
                // Tables\Columns\TextColumn::make('note')
                // ->searchable(),

            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Active' => 'Active',
                        'No Active' => 'No Active',
                    ]),

                SelectFilter::make('response')
                    ->options([
                        'Accessible' => 'Accessible',
                        'Block' => 'Block',
                        'Error' => 'Error',
                    ]),

                SelectFilter::make('loc-a')
                    ->label('Environment')
                    ->options([
                        'PROD' => 'PROD',
                        'Development' => 'Development',
                    ]),

                SelectFilter::make('loc-b')
                    ->label('Location')
                    ->options([
                        'On Prem' => 'On Prem',
                        'Cloud' => 'Cloud',
                    ]),

                SelectFilter::make('vapt')
                    ->label('VAPT')
                    ->options([
                        'Exclude' => 'Exclude',
                        'Include' => 'Include',
                    ]),

                SelectFilter::make('pentest')
                    ->options([
                        'Yes' => 'Yes',
                        'No' => 'No',
                    ]),

                SelectFilter::make('method')
                    ->options([
                        'Blackbox' => 'Blackbox',
                        'Whitebox' => 'Whitebox',
                        'Greybox' => 'Greybox',
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

                Tables\Actions\ViewAction::make()
                ->icon('heroicon-s-eye')
                ->iconButton()
                ->color('gray'), 
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        -> schema([
            Components\Section::make('VIEW PENTEST')
            ->schema([
                TextEntry::make('status')
                ->badge()
                ->color(function ($record) {
                    return $record->status === 'Active' ? 'success' : 'danger';
                }),

                // TextEntry::make('response'),
                TextEntry::make('domain'),
                // TextEntry::make('url')
                // ->label('URL'),
                TextEntry::make('loc-a')
                ->label('Environment'),
            
                TextEntry::make('loc-b')
                ->label('Location'),

                // TextEntry::make('dns-record')
                // ->label('DNS Record'),

                // TextEntry::make('dns-formula')
                // ->label('Formula DNS'),

                // TextEntry::make('vapt')
                // ->label('VAPT'),

                // TextEntry::make('desc')
                // ->label('Description'),

                // TextEntry::make('credential'),
                TextEntry::make('pentest')
                ->badge()
                ->color(function ($record) {
                    return $record->pentest === 'Yes' ? 'success' : 'danger';
                }),

                TextEntry::make('date')
                ->label('Latest Date')
                ->date(),
                TextEntry::make('method'),
                // TextEntry::make('note'),

                // Section::make('')
                // ->schema([
                // ]),
            ]) ->Columns(4), 
        Components\Section::make('VIEW NOMINAL PENTEST')
            ->schema([
                TextEntry::make('critical')
                ->badge()
                ->color('danger'),
                TextEntry::make('high')
                ->badge()
                ->color('danger'),
                
                TextEntry::make('medium')
                ->badge()
                ->color('primary'),
            
                TextEntry::make('low')
                ->badge()
                ->color('success')
                ->badge(),

                TextEntry::make('info')
                ->badge()
                ->color('info'),
            ])->Columns(5),
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
            'index' => Pages\ListFormulirs::route('/'),
            'create' => Pages\CreateFormulir::route('/create'),
            'edit' => Pages\EditFormulir::route('/{record}/edit'),
        ];
    }
}
