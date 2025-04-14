<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\Governates;
use App\Enums\Sectors;
use App\Enums\Roles;

class UserResource extends Resource
{
    protected static ?string $model           = User::class;
    protected static ?int $navigationSort     = 4;
    protected static ?string $navigationIcon  = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Settings';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
           
                Forms\Components\Select::make('governate')
                   ->options( Governates::all())
                   ->required(),
                Forms\Components\Select::make('sector')
                    ->options(Sectors::all())
                    ->required(),
                Forms\Components\Select::make('role')
                    ->options(Roles::all())
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),          
                Tables\Columns\TextColumn::make('governate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sector')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                
            ])
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function canCreate(): bool
    {

        return auth()->user()->isAdmin();

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
