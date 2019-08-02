<?php
/**
 * Created by PhpStorm.
 * User: blackhades
 * Date: 8/2/19
 * Time: 2:05 PM
 */

namespace BlackHades\PHPZipkin;


use BlackHades\PHPZipkin\Zipkin\Instrumentation\Laravel\Services\ZipkinTracingService;
use Illuminate\Support\ServiceProvider;

class ZipKinProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->publishes([__DIR__ . '/config/zipkin.php' => config_path('zipkin.php')], 'config');

    }

    public function register()
    {
        $this->app->singleton(
            ZipkinTracingService::class,
            function ($app) {
                return new ZipkinTracingService();
            }
        );
    }
}