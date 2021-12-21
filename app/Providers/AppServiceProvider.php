<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Max key length error fix
        Schema::defaultStringLength(191);

        /*Search Macro for Backend Table Component*/
        Builder::macro('tableSearch', function ($request) {
            $obj = (object)$request;
            $perPage = (isset($obj->perPage)) ? $obj->perPage : 15;
            $simpleSearchText = (isset($obj->simpleSearchText)) ? $obj->simpleSearchText : "";


            return $this->when($simpleSearchText, function ($query, $simpleSearchText) use ($obj) {
                foreach ($obj->simpleSearchQuery as $field) {
                    $query->orWhere($field, 'like', '%' . $simpleSearchText . '%');
                }
                return $query;
            })->paginate($perPage);
        });
    }
}
