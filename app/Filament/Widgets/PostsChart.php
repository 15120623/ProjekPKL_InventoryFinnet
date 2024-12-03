<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Formulir;
use Illuminate\Support\Facades\DB;

class PostsChart extends ChartWidget
{
    protected static ?string $heading = 'Post Chart';
    protected static ?int $sort = 3;
    protected function getData(): array
    {
        $data = Formulir::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"),
            DB::raw("COUNT(*) as aggregate")
        )
        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
        ->orderBy('date', 'asc')
        ->get();
        

        return [
            'datasets' => [
                [
                    'label' => 'Pentest Post',
                    'data' => $data->map(fn ($value) => $value->aggregate), // Sesuaikan tipe dari Formulir
                    'backgroundColor' => [ 'rgba(14, 165, 233)'],
                    // 'borderColor' => ['rgba(93, 173, 226, 1)'],
                ],
            ],
            'labels' => $data->map(fn ($value) => $value->date), // Sesuaikan tipe dari Formulir
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
