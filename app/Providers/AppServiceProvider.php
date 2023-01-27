<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
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
