<?php
namespace Laboiteacode\RGPDManager;
use Laboiteacode\RGPDManager\Http\Livewire\Consent;
use Laboiteacode\RGPDManager\Http\Livewire\Contact;
use Laboiteacode\RGPDManager\View\RGPDManagerLayout;
use Livewire\Livewire;

class RGPDManagerServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'rgpdmanager');
    }

    public function boot()
    {
        //$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'rgpdmanager');
        $this->loadViewComponentsAs('rgpdmanager', [
            RGPDManagerLayout::class,
        ]);

        Livewire::component('rgpd-contact', Contact::class);
        Livewire::component('rgpd-consent', Consent::class);

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'rgpdmanager');
        $this->loadJsonTranslationsFrom(__DIR__.'/../lang');

        if ($this->app->runningInConsole()) {
            // Publish views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/rgpdmanager'),
            ], ['rgpdmanager', 'rgpdmanager:views']);

            if (! class_exists('CreateTermsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_terms_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_terms_table.php'),
                    __DIR__ . '/../database/migrations/create_consents_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_consents_table.php'),
                    // you can add any number of migrations here
                ], ['rgpdmanager', 'rgpdmanager:migrations']);
            }

            if (! class_exists('CreateConsentsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_consents_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_consents_table.php'),
                    // you can add any number of migrations here
                ], ['rgpdmanager', 'rgpdmanager:migrations']);
            }

            $this->publishes([
                __DIR__.'/../lang' => $this->app->langPath('vendor/rgpdmanager'),
            ], ['rgpdmanager', 'rgpdmanager:lang']);
        }
    }
}