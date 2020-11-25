<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Fortify;
use App\Models\Service;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::loginView(function () {
            $services = Service::all()->sortBy("service");
            if (session('link')) {
              
                return view('auth.login',["services"=>$services]);
            } 
            else {
                session(['link' => url()->previous()]);
                return view('auth.login',["services"=>$services]);
            }
           
           
        });
        Fortify::registerView(function () {
            $services = Service::all()->sortBy("service");
            if (session('link')) {
                return view('auth.register',["services"=>$services]);
            } 
            else {
                session(['link' => url()->previous()]);
                return view('auth.register',["services"=>$services]);
            }
         
           
        });
         //   register new LoginResponse & RegisterResponse
         $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Http\Responses\LoginResponse::class,
        );

        $this->app->singleton(
            \Laravel\Fortify\Contracts\RegisterResponse::class,
            \App\Http\Responses\RegisterResponse::class
        );
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
