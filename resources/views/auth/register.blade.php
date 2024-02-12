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
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Watawazi - Register</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="dist/css/app.css" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="./" class="-intro-x flex items-center pt-2">
                    <img alt="watawazi logo"  src="dist/images/logo.png">  </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x" src="dist/images/illustration2.png">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10" style="color:#000000">
                        Convert your visitors 
                            <br>
                            into subscribers.
                        </div>
                        <div class="-intro-x mt-5 text-lg " style="color:#333333">Create and manage all your landing page, optin forms<br/> and email list in one place.</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <br/><br/><br/><h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Sign up
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center" >Convert your visitors into subscribers. Manage all your optin forms and email list in one place.</div>
                        <div class="intro-x mt-8">

                          <!--  <input type="text" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Email">-->


                                <input  placeholder="Name" id="name" type="text" class="intro-x login__input input input--lg border border-gray-300 block" name="name" value="{{ old('name') }}" required autofocus>

@if ($errors->has('name'))
    <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
    </span>
@endif


<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           <br/>
                            <div class="col-md-6">
                                <input  placeholder="Email" id="email" type="email" class="intro-x login__input input input--lg border border-gray-300 block" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <br/>

                            <div class="col-md-6">
                                <input  placeholder="Password" id="password" type="password"  class="intro-x login__input input input--lg border border-gray-300 block" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                        <br/>

                            <div class="col-md-6">
                                <input  placeholder="Confirm Password" id="password-confirm" type="password" class="intro-x login__input input input--lg border border-gray-300 block" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                               
                                <label class="cursor-pointer select-none" for="remember-me"></label>
                            </div>
                            <a href="{{ route('login') }}">Already have an account? </a> 
                        </div>
                        </div>
                       
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-9 xl:mr-3">Register</button>
                         </div>
                        <div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">
                            By signin up, you agree to our 
                            <br>
                            <a class="text-theme-1" href="">Terms and Conditions</a> & <a class="text-theme-1" href="">Privacy Policy</a> 
                        </div>
                    </div>
                </form>




                



                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="dist/js/app.js"></script>
        <!-- END: JS Assets-->
    </body>
</html>