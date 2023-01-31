<?php

namespace App\Providers;

use App\Services\Mat;
use Illuminate\Support\ServiceProvider;

final class MyNewCustomServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Mat::class, function () {
            return new Mat([1, 2, 3, 4, 5]);
        });
    }
}
