<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Exports\ProjectExporter;
use Filament\Tables\Actions\ExportBulkAction;
use App\Models\Project;
use App\Filament\Imports\ProjectImporter;
use Filament\Tables\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\Governates;
use App\Enums\Sectors;
use App\Enums\Modality;
use App\Enums\Status;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationGroup = 'Projects';
    protected static ?string $navigationIcon  = 'heroicon-o-wallet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('donor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('partner')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options( Status::all()),
                Forms\Components\Select::make('governate')
                ->options( Governates::all() )
                    ->required() ,
                Forms\Components\Select::make('sector')
                    ->required()->options(Sectors::all()),
                Forms\Components\Select ::make('modality')
                    ->required()
                    ->options(Modality::all()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->headerActions([
            ImportAction::make()
                ->importer(ProjectImporter::class)
                ->options([
                    'updateExisting' => false,
                ]),

        ])->striped()
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('donor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('partner')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('governate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sector')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modality')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->striped()
            ->modifyQueryUsing(function (Builder $query) {
                if(auth()->user()->governate == 'All' && auth()->user()->sector =='All'){
                  return  $query;
                }
                elseif (auth()->user()->governate != 'All' && auth()->user()->sector !='All') {
                    return $query->where('governate', auth()->user()->governate)
                        ->where('sector', auth()->user()->sector);

                } elseif (auth()->user()->governate !=Governates::ALL) {
                    return $query->where('governate', auth()->user()->governate);

                } elseif (auth()->user()->sector != Sectors::ALL) {
                    return $query->where('sector', auth()->user()->sector);
                } else {
                    return $query->all();
                }
            })
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible(fn( $record): bool => auth()->user()->isAdmin()),
            ])
            ->bulkActions([
                ExportBulkAction::make()
                ->exporter(ProjectExporter::class),
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])->visible(fn( $record): bool => auth()->user()->isAdmin()),
            
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BeneficiariesRelationManager::class,
        ];
    }
    public static function canCreate(): bool
    {

        return auth()->user()->isAdmin();

    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            
        ];
    }
}
