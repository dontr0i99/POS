<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;

class AppServiceProvider extends ServiceProvider
{
    public function register():void
    {
        //
    }
    public function boot(): void
    {
        //
        Builder::useVite();
    }
}