<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    View::composer('auth.register', function ($view) {
        $response = Http::get('https://fantasy.premierleague.com/api/bootstrap-static/');
        $teams = collect($response->json()['teams'])->map(function ($team) {
            return (object) [
                'id' => $team['id'],
                'name' => $team['name'],
                'short_name' => $team['short_name'],
                'code' => $team['code'],
            ];
        });

        $view->with('teams', $teams);
    });
}
}
