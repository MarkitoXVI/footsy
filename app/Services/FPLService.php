<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FPLService
{
    protected string $base = 'https://fantasy.premierleague.com/api/';

    public function bootstrap(): array
{
    return Cache::remember('fpl:bootstrap', 900, function () {
        $res = Http::withHeaders([
                'User-Agent' => 'FootsyApp/1.0 (+https://yourapp.example)'
            ])
            ->timeout(120)        // ⏰ 120 seconds instead of default 30
            ->retry(3, 3000)      // 🔁 retry up to 3 times, 3 s apart
            ->get($this->base.'bootstrap-static/');

        return $res->successful() ? $res->json() : [];
    });
}

    public function teams(): array    { return $this->bootstrap()['teams'] ?? []; }
    public function elements(): array { return $this->bootstrap()['elements'] ?? []; }
    public function elementTypes(): array { return $this->bootstrap()['element_types'] ?? []; }
    public function events(): array   { return $this->bootstrap()['events'] ?? []; }
}
