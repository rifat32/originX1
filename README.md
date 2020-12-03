 <a href='http://masterrifat.000webhostapp.com/about/en' style='background-color:red'> <h1>My Portfolio Website link </h1> </a>
 <h2> This project includes laravel jetstream, crud using methods provided by laravel, Ajax crud and much more. It uses both Model and query builder for crud operation.</h2>
 <h2>The trickiest part of this project was it redirects the user back to the previous page after authentication, that is not provided by the laravel jetstream by default.
I want to explain this here</h2>
<h3><strong>App\Providers\JetstreamServiceProvider.php </strong>  </h3>
<pre>
<strong>
 public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::loginView(function () {
            
            if (session('link')) 
                return view('auth.login');
            } 
            else {
                session(['link' => url()->previous()]);
                return view('auth.login');
            }
           
           
        });
        Fortify::registerView(function () {
            $services = Service::all()->sortBy("service");
            if (session('link')) {
                return view('auth.register');
            } 
            else {
                session(['link' => url()->previous()]);
                return view('auth.register');
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
</strong>
</pre>
<h3><strong>app/Http/Responses/LoginResponse.php</strong>  </h3>
<pre>
<strong>
<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract {

    public function toResponse($request) {
        return redirect(session('link'));
    }
}
</strong>
</pre>
<h3><strong>app/Http/Responses/RegisterResponse.php</strong></h3>
<pre>
<strong>
<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract {

    public function toResponse($request) {
        return redirect(session('link'));
    }
}
</strong>
</pre>
<p>It clean up that duplicate code in the JetstreamServiceProvider. </p>
<p>As we can see I have created session('link'). If session('link') is there and the user requests for the login page or the registration page, the app will not create another  session(['link' => url()->previous()]). And if session('link') is not there and the user requests for the login page or the registration page, the app will create  session(['link' => url()->previous()]);.</p>  
<p> And This for the scnerio when the user is in the login page and the user does not have an acount. the  user will go to the registration  page. Remember that when the user was in the login page,  session(['link' => url()->previous()]) was created. And when the user will request for the registration page, the app will not create a  session(['link' => url()->previous()]).</p> 
<p> If it would create  session(['link' => url()->previous()]) for that request then session('link') would be for the login page and this is not the concept because we need session('link') for redirecting the user back to the previous page after authentication. That will not be a login or registration page.</p> 
<p> We also need to pull the session('link') for every other page requests and this is for the scnerio where a user requests for the login page, a session(['link' => url()->previous()]) will be created and than the user leaves that page and goes to another page other than the login or the registration page, the session('link') is there. and then the user again requests for the login page, another session('link') will not be created because session('link') is already there . but this session('link') is not desired. so we need to pull the session('link') for every  page requests other than the login or the registration page to get desired session('link').</p> 
<p> And again think about that scnerio and we have pulled the session('link') for every  page requests other than the login or the registration page. and then when the user requests again for the login page a session(['link' => url()->previous()]) will be created because there will be no session('link') before and we have pulled session('link') for every  page requests other than the login or the registration page.  </p>
<pre>
<strong>
 session()->pull('link');
<strong>
</pre>



