<?php

namespace App\Providers;

use App\Models\Game;
use App\Models\Player;
use App\Observers\GameObserver;
use App\Observers\PlayerObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Player::observe(PlayerObserver::class);
        Game::observe(GameObserver::class);
    }
}
