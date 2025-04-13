<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeneficiaryResource\Pages;
use App\Filament\Resources\BeneficiaryResource\RelationManagers;
use App\Models\Beneficiary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Project;
class BeneficiaryResource extends Resource
{
    protected static ?string $model = Beneficiary::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('national_id')
                    ->required()
                    ->maxLength(255),          
                Forms\Components\TextInput::make('fullname')
                    ->required()
                    ->maxLength(255),            
                Forms\Components\TextInput::make('phonenumber')
                    ->tel()
                    ->required()
                    ->maxLength(255),            
                Forms\Components\TextInput::make('recipient_name')
                    ->required()
                    ->maxLength(255),          
                Forms\Components\TextInput::make('recipient_phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),              
                Forms\Components\TextInput::make('recipient_nid')
                    ->required()
                    ->maxLength(255),            
                Forms\Components\TextInput::make('transfer_value')
                    ->required()
                    ->numeric(),               
                Forms\Components\TextInput::make('transfer_count')
                    ->required()
                    ->numeric(),         
                Forms\Components\DatePicker::make('recieve_date')
                    ->required(),
                Forms\Components\Select::make('project_id')
                    ->required()
                    ->relationship('project','name')
                    ->searchable(),
                Forms\Components\TextInput::make('created_by')                   
                    ->default(null),
                Forms\Components\TextInput::make('updated_by')      
                 ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('national_id')
                    ->searchable(),
            
        
                Tables\Columns\TextColumn::make('phonenumber')
                    ->searchable(),
        
                Tables\Columns\TextColumn::make('recipient_name')
                    ->searchable(),
         
                Tables\Columns\TextColumn::make('recipient_phone')
                    ->searchable()
                     ->toggleable(isToggledHiddenByDefault: true),
      
                Tables\Columns\TextColumn::make('recipient_nid')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
  
                Tables\Columns\TextColumn::make('transfer_value')
                    ->numeric()
                    ->sortable(),
          
                Tables\Columns\TextColumn::make('transfer_count')
                    ->numeric()
                    ->sortable(),
             
                Tables\Columns\TextColumn::make('recieve_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
              
                    Tables\Columns\TextColumn::make('project.name')
                    ->label('Project Name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListBeneficiaries::route('/'),
            'create' => Pages\CreateBeneficiary::route('/create'),
            'edit' => Pages\EditBeneficiary::route('/{record}/edit'),
        ];
    }
}
