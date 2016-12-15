<?php

namespace App\Providers;

use App\Model\Report;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\AbstractPaginator;
use App\Repositories\Pagination\PaginationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // 使用自定义分页类，便于全局使用
        Paginator::presenter(function (AbstractPaginator $paginator) {
            return new PaginationRepository($paginator);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
