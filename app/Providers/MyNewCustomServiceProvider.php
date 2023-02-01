<?php

namespace App\Providers;

use App\Services\Mat;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

final class MyNewCustomServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Mat::class, function () {
            return new Mat([1, 2, 3, 4, 5]);
        });

        $this->app->singleton(FilesystemAdapter::class, fn () => Storage::disk('public'));
    }
}
