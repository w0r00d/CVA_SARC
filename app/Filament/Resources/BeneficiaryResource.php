<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeneficiaryResource\Pages;
use App\Filament\Resources\BeneficiaryResource\RelationManagers;
use App\Models\Beneficiary;
use App\Filament\Exports\BeneficiaryResourceExporter;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Project;
use App\Filament\Imports\BeneficiaryImporter;
use Filament\Tables\Actions\ImportAction;
use App\Enums\Governates;
use App\Enums\Sectors;
use Filament\Forms\Components\Hidden;
class BeneficiaryResource extends Resource
{
    protected static ?string $model           = Beneficiary::class;
    protected static ?string $navigationGroup = 'Projects';
    protected static ?string $navigationIcon  = 'heroicon-o-user-group';

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
                    Hidden::make('created_by')
                    ->default(auth()->id()),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->headerActions([
            ImportAction::make()
                ->importer(BeneficiaryImporter::class)
                ->options([
                    'updateExisting' => false,
                ]),

        ])->striped()
        ->heading('Beneficiaries')
            ->columns([
                Tables\Columns\TextColumn::make('national_id')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('phonenumber')
                    ->searchable(),
        
                Tables\Columns\TextColumn::make('recipient_name')
                    ->searchable(),
               
                Tables\Columns\TextColumn::make('transfer_value')
                    ->numeric()
                    ->sortable(),
          
                Tables\Columns\TextColumn::make('transfer_count')
                    ->numeric(),                            
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Project Name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('project.governate')
                    ->label('Governate'),
     
            
            ])->modifyQueryUsing(function (Builder $query) {
                if(auth()->user()->governate == 'All' && auth()->user()->sector =='All'){
                
                  return  $query;
                }
                elseif (auth()->user()->governate != 'All' && auth()->user()->sector !='All') {
                    return $query->whereRelation('project', 'governate',auth()->user()->governate)
                        ->whereRelation('project','sector', auth()->user()->sector);

                } elseif (auth()->user()->governate !=Governates::ALL) {
                    return $query->whereRelation('project','governate' , auth()->user()->governate);

                } elseif (auth()->user()->sector !=Sectors::ALL) {
                    return $query->whereRelation('project','sector' , auth()->user()->sector);

                } 
            })
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible(fn( $record): bool => auth()->user()->isAdmin()),
                Tables\Actions\ViewAction::make()->modal(),
            ])
            ->bulkActions([
                ExportBulkAction::make()
                ->exporter(BeneficiaryResourceExporter::class),
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ])->visible(fn( $record): bool => auth()->user()->isAdmin()),
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
            'view' => Pages\ViewBeneficiary::route('/{record}/view'),
        ];
    }
}
