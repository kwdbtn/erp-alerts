<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        view()->composer(['messages.form', 'messages.bulksms'], function ($view) {
            $senders = [
                'BAUnit'  => 'BAUnit',
                'GRIDSol' => 'GRIDSol',
            ];

            $view->with('senders', $senders);
        });
    }
}
