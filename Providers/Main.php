<?php

namespace Modules\OfflinePayments\Providers;

use Illuminate\Support\ServiceProvider as Provider;
use Modules\OfflinePayments\Parser\Markdown as Markdown;

class Main extends Provider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive(Markdown::class, function ($expression) {
            return "<?php echo app('markdown-parser')->text($expression); ?>";
        });

        $this->loadTranslations();
        $this->loadViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutes();

        $this->app->singleton('markdown-parser', function () {
            return new Markdown();
        });
    }

    /**
     * Load views.
     *
     * @return void
     */
    public function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'offline-payments');
    }

    /**
     * Load translations.
     *
     * @return void
     */
    public function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'offline-payments');
    }

    /**
     * Load routes.
     *
     * @return void
     */
    public function loadRoutes()
    {
        if (app()->routesAreCached()) {
            return;
        }

        $routes = [
            'admin.php',
            'portal.php',
            'signed.php',
        ];

        foreach ($routes as $route) {
            $this->loadRoutesFrom(__DIR__ . '/../Routes/' . $route);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
