<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        // Unguard all models
        Model::unguard();

        // Add cascadeDelete macro
        Relation::macro('cascadeDelete', function() {
            $this->chunk(500, function($chunks){
                $chunks->each(function($row) {
                    $row->delete();
                });
            });
        });
    }
}
