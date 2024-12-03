<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Formulir;
use Illuminate\Support\Facades\DB;

class EnvironmentChart extends ChartWidget
{
    protected static ?string $heading = 'Environment Chart';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // Query untuk menghitung jumlah masing-masing environment
        $data = Formulir::select(
            DB::raw("SUM(CASE WHEN `loc-a` = 'PROD' THEN 1 ELSE 0 END) as prod_count"),
            DB::raw("SUM(CASE WHEN `loc-a` = 'Development' THEN 1 ELSE 0 END) as dev_count")
        )->first(); // Dapatkan hasilnya sebagai satu record

        return [
            'datasets' => [
                [
                    'label' => 'Environment Distribution',
                    'data' => [$data->prod_count, $data->dev_count], // Data untuk chart
                    'backgroundColor' => [ '#0ea5e9' , '#eab308'], // Warna untuk masing-masing segment
                ],
            ],
            'labels' => ['PROD', 'Development'], // Label untuk chart
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
