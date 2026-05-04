<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\DataTablesServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(DataTablesServiceProvider::class);
    }

    public function boot(): void
    {
        //
    }
}
