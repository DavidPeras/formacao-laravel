<?php

namespace App\Filament\Resources\DisciplinaResource\RelationManagers;

use App\Models\Disciplina;
use App\Models\User;
use App\Models\UserDisciplina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Aluno')
                    ->searchable()
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('nota')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(20),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                Tables\Columns\TextColumn::make('Aluno')
                    ->state(function (UserDisciplina $userDisciplina) {

                        $name = $userDisciplina->user()->get()[0]->name;

                        return $name;

                    }),
                Tables\Columns\TextColumn::make('nota'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
