<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Disciplina;
use App\Models\UserDisciplina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DisciplinasRelationManager extends RelationManager
{
    protected static string $relationship = 'disciplinas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('disciplina_id')
                    ->label('Disciplina')
                    ->searchable()
                    ->options(Disciplina::all()->pluck('nome', 'id'))
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
            ->recordTitleAttribute('disciplina_id')
            ->columns([
                Tables\Columns\TextColumn::make('Disciplina')
                    ->state(function (UserDisciplina $userDisciplina) {
                        $name = $userDisciplina->disciplina()->get()[0]->nome;

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
