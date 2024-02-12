<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Update Password </title>
@endsection
@section('content')
<x-app-layout>
    
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Password Update</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>  </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                   
                    <!-- END: Search -->
                    <!-- BEGIN: Notifications -->
                 
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    
                    <!-- END: Account Menu -->
                </div>
                <h1 class="text-lg font-medium mr-auto mt-3" style="font-size:23px">
                Account Settings
                    </h1><br/>
    <div class="intro-y box py-10 sm:py-20">
    <div class="px-5 mt-5">
                        <div class="font-medium text-center text-lg">Update Password</div>
                        <div class="text-gray-600 text-center mt-2">Ensure your account is using a long, random password to stay secure. <u class=""><a href="/users/profile_view">Go Back</a></u></div>
                    </div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
           

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
               
            
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>
           
                @endif
          

          
        </div>
    </div>
    
</x-app-layout>



                 
@endsection