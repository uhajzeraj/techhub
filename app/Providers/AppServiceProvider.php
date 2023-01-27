<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Services\BatInterface;
use App\Services\BatOne;
use App\Services\BatTwo;
use App\Services\Baz;
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
        $this->app->singleton(Baz::class, fn () => new Baz('123456789'));

        // BatOne can be replaced with BatTwo, or any other class
        // that implementes the BatInterface interface
        $this->app->singleton(BatInterface::class, fn () => new BatOne());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();

        Relation::enforceMorphMap([
            'post' => Post::class,
            'author' => User::class,
        ]);
    }
}
