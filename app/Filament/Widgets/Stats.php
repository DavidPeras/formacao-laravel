<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Stats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Disciplinas Inscritas', function () {

                $user = auth()->user();

                return count($user->disciplinas()->get());

            }),

            Stat::make('Média das Disciplinas', function () {

                $user = auth()->user();
                $disciplinas = $user->disciplinas()->get();

                if ($disciplinas->isEmpty()) {
                    return 0;
                }

                $media = $disciplinas->avg('nota');

                return round($media, 2);

            })
        ];
    }
}
