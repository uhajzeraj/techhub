<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Services\BatInterface;
use App\Services\BatOne;
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

                $apiClient->setConfig([
                    'apiKey' => config('mailchimp.api_key'),
                    'server' => config('mailchimp.server'),
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
