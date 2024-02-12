
<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('dist/images/logo.svg')}}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Forgot Password - watawazi - reclaim password with the following process</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('dist/css/app.css')}}" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="login"  >
        <div class="container sm:px-10" >
            <div class="block xl:grid grid-cols-2 gap-4"  >
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen"  >
                    <a href="./" class="-intro-x flex items-center pt-2">
                        <img alt="watawazi logo"  src="dist/images/logo.png">
                       
                    </a>
                    <div class="my-auto" >
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x " src="dist/images/illustration3.png">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10" style="color:#000000" >
                            A few more clicks to 
                           
                            <br>
                            sign in to your account.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white" style="color:#333333"> Choosing a hard-to-guess, but easy-to-remember password is important!</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Forgot Password
                        </h2>

                        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        


        <div class="mb-4 text-sm text-gray-600">
         Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')
        </div>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center" >A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                       
                       
                      
                        <form method="POST" action="{{ route('password.email') }}">
            
                       @csrf
                        <div class="intro-x mt-8">
                            <input class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                         
                        </div>
                        @if ($errors->has('email'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif


                        
                     
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
        
                            <button class="button button--lg w-43 text-white bg-theme-9 xl:mr-3">Email Password Reset Link</button>
                         </div>

</form>
                      
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('dist/js/app.js')}}"></script>
        <!-- END: JS Assets-->
    </body>
</html>
