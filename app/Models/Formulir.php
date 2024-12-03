<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Formulir extends Model
{
    use HasFactory;
    protected $fillable = [
        'status', 'response', 'domain', 'url', 'loc-a', 'loc-b', 'dns-record',
        'dns-formula', 'vapt', 'desc', 'credential', 'pentest', 'date',
        'critical', 'high', 'medium', 'low', 'info', 'method', 'note',
    ];

    // Method to calculate total vulnerability score for each app
    public function totalVulnerability()
    {
        return $this->critical + $this->high + $this->medium + $this->low;
    }

    // Scope to get top 10 vulnerable apps
    public function scopeTopVulnerableApps($query)
    {
        return $query->select('domain', 'critical', 'high', 'medium', 'low')
                     ->addSelect(DB::raw('
                        (critical + high + medium + low) as total_vulnerability
                     '))
                     ->orderByDesc('total_vulnerability')
                     ->limit(10)
                     ->get();
    }
}
