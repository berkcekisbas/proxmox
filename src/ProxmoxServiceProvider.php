<?php

namespace Berk\Proxmox;

use Illuminate\Support\ServiceProvider;

class ProxmoxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Konfigürasyon dosyasını publish etmek için
        $this->publishes([
            __DIR__.'/../config/proxmox.php' => config_path('proxmox.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Konfigürasyon dosyasını yüklemek için
        $this->mergeConfigFrom(
            __DIR__.'/../config/proxmox.php', 'proxmox'
        );

        $this->app->singleton(ProxmoxClient::class, function ($app) {
            return new ProxmoxClient();
        });
    }
}
