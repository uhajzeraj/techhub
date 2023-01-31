<?php

namespace App\Providers;

use App\Http\Controllers\UpdateAvatarController;
use App\Services\Mat;
use Illuminate\Support\ServiceProvider;

final class MyNewCustomServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Mat::class, function () {
            return new Mat([1, 2, 3, 4, 5]);
        });

        // Not really scalable; What if we have 100 controllers that use the disk?
        $this->app->singleton(UpdateAvatarController::class, function () {
            return new UpdateAvatarController('public');
        });
    }
}
