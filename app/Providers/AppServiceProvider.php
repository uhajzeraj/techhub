<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Services\BatInterface;
use App\Services\BatOne;
use App\Services\BatTwo;
use App\Services\Baz;
use App\Services\Newsletters\MailchimpNewsletterService;
use App\Services\Newsletters\NewsletterService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

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

        $this->app->singleton(
            NewsletterService::class,
            fn () => $this->app->get(MailchimpNewsletterService::class),
        );

        $this->app->singleton(
            ApiClient::class,
            function () {
                $apiClient = new ApiClient();

                // Don't do this, this is a bad practice
                // API keys, tokens, passwords should be stored in .env and never commited
                $apiClient->setConfig([
                    'apiKey' => '3ceec5dbbe7324f7624d3375d48afc87-us21',
                    'server' => 'us21'
                ]);

                return $apiClient;
            },
        );
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
