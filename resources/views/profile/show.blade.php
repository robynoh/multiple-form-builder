
<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Profile </title>
@endsection
@section('content')
<x-app-layout >
    
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Profile</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>  </div>
                    
                </div>

    <div >
      
            @livewire('profile.update-profile-information-form')

           
    </div>
    
</x-app-layout>
@endsection