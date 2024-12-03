<?php

namespace App\Filament\Widgets;

use App\Models\Formulir;
use Filament\Widgets\Widget;

class TopVulnerableApps extends Widget
{
    protected static ?string $heading = 'Top 10 Vulnerable Application';
    protected static ?int $sort = 1;

    protected static string $view = 'filament.widgets.top-vulnerable-apps';

    public function getViewData(): array
    {
        $records = Formulir::select('domain')
            ->selectRaw('SUM(critical) + SUM(high) + SUM(medium) + SUM(low) as total_vulnerabilities')
            ->groupBy('domain')
            ->orderByDesc('total_vulnerabilities')
            ->limit(10)
            ->get();

        return [
            'records' => $records,
        ];
    }
}
