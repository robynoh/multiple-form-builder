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
<html lang="{{ app()->getLocale() }}">
    <!-- BEGIN: Head -->
    <head>

    <style>
.img {
    margin: 0 auto;
}


    </style>

        <meta charset="utf-8">
        <link href="{{ asset('dist/images/favi.png') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@yield('title')

        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
      
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="app">
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="{{request()->getHost()}}" class="flex mr-auto">
                    <img alt="Convert your leads" src="{{ asset('dist/logo.png') }}">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-black transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-theme-24 py-5 hidden">
           <!---- <li>
                        <a href="/user" class="menu menu--active">
                            <div class="menu__icon"> <i data-feather="slack"></i> </div>
                            <div class="menu__title"> Dashboard</div>
                        </a>
                    </li>
-->
                    <li>
                        <a style="color:black" href="/users" class="menu menu<?php if(Request::segment(2)==''){?>--active<?php }?>">
                            <div class="menu__icon"> <i data-feather="slack"></i> </div>
                            <div class="menu__title"> Dashboard </div>
                        </a>
                    </li>

                    <li>
                        <a style="color:black" href="/users/collect_information" class="menu menu<?php if(Request::segment(2)=='collect_information'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="menu__icon"> <i data-feather="package"></i> </div>
                            <div class="menu__title">Niche boards</div>
                        </a>
                    </li>

                    <li>
                        <a style="color:black" href="/users/collect_information" class="menu menu<?php if(Request::segment(2)=='collect_information'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="menu__icon"> <i data-feather="package"></i> </div>
                            <div class="menu__title">Landing Page</div>
                        </a>
                    </li>

                  
                    
                    <li>
                        <a style="color:black"  href="/users/profile_view" class="menu menu<?php if(Request::segment(2)=='profile_view'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="menu__icon"> <i data-feather="user"></i> </div>
                            <div class="menu__title">Business/Brand Profile</div>
                        </a>
                    </li>

                    <li>
                        <a style="color:black" href="/users/my-package" class="menu menu<?php if(Request::segment(2)=='package'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="menu__icon"> <i data-feather="credit-card"></i> </div>
                            <div class="menu__title">My Plan</div>
                        </a>
                    </li>

                    <li >
                        <a style="color:black" href="/users/request-feature" class="menu menu<?php if(Request::segment(2)=='senderid'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="menu__icon"> <i data-feather="help-circle"></i> </div>
                            <div class="menu__title">Request a feature</div>
                        </a>
                    </li>

                    <li >
                        <a style="color:black" href="/users/get-started" class="menu menu<?php if(Request::segment(2)=='senderid'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="menu__icon"> <i data-feather="cast"></i> </div>
                            <div class="menu__title">Getting Started</div>
                        </a>
                    </li>

                    <li >
                        <a style="color:black" href="/users/visitors-download" class="menu menu<?php if(Request::segment(2)=='senderid'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="menu__icon"> <i data-feather="cast"></i> </div>
                            <div class="menu__title">Visitor Downloads</div>
                        </a>
                    </li>

                    <li >
                        <a style="color:black" href="/users/help-videos" class="menu menu<?php if(Request::segment(2)=='senderid'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="menu__icon"> <i data-feather="film"></i> </div>
                            <div class="menu__title">Tutorial Videos</div>
                        </a>
                    </li>

                    <li >
                        <a style="color:black" href="/user" class="menu menu--active">
                            <div class="menu__icon"> <i data-feather="toggle-right"></i> </div>
                            <div class="menu__title"> Logout</div>
                        </a>
                    </li>
                   
               
               
               
                   
                   
               
        
            
             
            </ul>
        </div>
        <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
            <a href="http://{{request()->getHost()}}" class="intro-x flex ">
                <img alt="watawazi" width="195" height="64" src="{{ asset('dist/logo.png') }}">
                  </a>
                <div class="side-nav__devider my-6" style="background:black"></div>
                <ul>
                    <li>
                        <a style="color:black" href="/users" class="side-menu side-menu<?php if(Request::segment(2)==''){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="slack"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>

                 <!--   <li>
                        <a href="/users/list" class="side-menu side-menu<?php if(Request::segment(2)=='list'){?>--active<?php }?><?php if(Request::segment(2)=='listDetail'){?>--active<?php }?><?php if(Request::segment(3)=='anniversary'){?>--active<?php }?><?php if(Request::segment(2)=='anniversary'){?>--active<?php }?><?php if(Request::segment(2)=='anniversaryByMonths'){?>--active<?php }?><?php if(Request::segment(2)=='smsallcontacts'){?>--active<?php }?><?php if(Request::segment(2)=='todayBirthday'){?>--active<?php }?><?php if(Request::segment(2)=='tomorrowBirthday'){?>--active<?php }?><?php if(Request::segment(2)=='celebrantsByMonths'){?>--active<?php }?><?php if(Request::segment(2)=='monthExtract'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="book"></i> </div>
                            <div class="side-menu__title"> Contact list</div>
                        </a>
                    </li>
                    <li>
                        <a href="/users/scheduleList" class="side-menu side-menu<?php if(Request::segment(2)=='scheduleList'){?>--active<?php }?><?php if(Request::segment(2)=='multipleupdate'){?>--active<?php }?><?php if(Request::segment(2)=='contacts'){?>--active<?php }?><?php if(Request::segment(2)=='scheduleUpdate'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="clock"></i> </div>
                            <div class="side-menu__title">Auto schedule</div>
                        </a>
                    </li>
                    <li>
                        <a href="/users/sentMessages" class="side-menu side-menu<?php if(Request::segment(2)=='sentMessages'){?>--active<?php }?><?php if(Request::segment(2)=='smsdetail'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="send"></i> </div>
                            <div class="side-menu__title">Message History</div>
                        </a>
                    </li>

                    <li>
                        <a href="/users/senderid" class="side-menu side-menu<?php if(Request::segment(2)=='senderid'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="key"></i> </div>
                            <div class="side-menu__title">Sender ID</div>
                        </a>
                    </li>

                    <li>
                        <a href="/users/senderid" class="side-menu side-menu<?php if(Request::segment(2)=='senderid'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="message-circle"></i> </div>
                            <div class="side-menu__title">Auto Responder</div>
                        </a>
                    </li>-->

                  


                    <li>
                        <a style="color:black" href="/users/collect_information" class="side-menu side-menu<?php if(Request::segment(2)=='collect_information'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="package"></i> </div>
                            <div class="side-menu__title">Niche boards</div>
                        </a>
                    </li>

                    <li>
                        <a style="color:black" href="/users/all_pages" class="side-menu side-menu<?php if(Request::segment(2)=='all_pages'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="file"></i> </div>
                            <div class="side-menu__title">Landing Page</div>
                        </a>
                    </li>

                  
                    
                    <li>
                        <a style="color:black" href="/users/profile_view" class="side-menu side-menu<?php if(Request::segment(2)=='profile_view'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                            <div class="side-menu__title">Business/Brand Profile</div>
                        </a>
                    </li>

                    <li>
                        <a style="color:black" href="/users/my-package" class="side-menu side-menu<?php if(Request::segment(2)=='package'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?><?php if(Request::segment(2)=='my-package'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="credit-card"></i> </div>
                            <div class="side-menu__title">My Plan</div>
                        </a>
                    </li>

                    <li>
                        <a style="color:black" href="/users/request-feature" class="side-menu side-menu<?php if(Request::segment(2)=='senderid'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?><?php if(Request::segment(2)=='request-feature'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="help-circle"></i> </div>
                            <div class="side-menu__title">Request a feature</div>
                        </a>
                    </li>

                    <li>
                        <a style="color:black" href="/users/get-started" class="side-menu side-menu<?php if(Request::segment(2)=='senderid'){?>--active<?php }?><?php if(Request::segment(2)=='my_senderid'){?>--active<?php }?><?php if(Request::segment(2)=='get-started'){?>--active<?php }?><?php if(Request::segment(2)=='getting-started-niche-board'){?>--active<?php }?><?php if(Request::segment(2)=='getting-started-interface'){?>--active<?php }?><?php if(Request::segment(2)=='getting-started-share'){?>--active<?php }?><?php if(Request::segment(2)=='getting-started-access-lead'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="cast"></i> </div>
                            <div class="side-menu__title">Getting Started</div>
                        </a>
                    </li>


                    <li>
                        <a style="color:black" href="/users/visitors-download" class="side-menu side-menu<?php if(Request::segment(2)=='visitors-download'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="download"></i> </div>
                            <div class="side-menu__title">Visitor Downloads</div>
                        </a>
                    </li>

                    <li>
                        <a style="color:black" href="/users/help-videos" class="side-menu side-menu<?php if(Request::segment(2)=='help-videos'){?>--active<?php }?>">
                            <div class="side-menu__icon"> <i data-feather="film"></i> </div>
                            <div class="side-menu__title">Tutorial Videos</div>
                        </a>
                    </li>

                   


                  <!---  <li>
                        <a href="/user/sentMessages" class="side-menu side-menu">
                            <div class="side-menu__icon"> <i data-feather="help-circle"></i> </div>
                            <div class="side-menu__title"> How it work</div>
                        </a>
                    </li>

                    <li>
                        <a href="/users/pricing" class="side-menu side-menu">
                            <div class="side-menu__icon"> <i data-feather="credit-card"></i> </div>
                            <div class="side-menu__title">Pricing</div>
                        </a>
                    </li>
                   
                    <li>
                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"  class="side-menu side-menu">
                            <div class="side-menu__icon"> <i data-feather="settings"></i> </div>
                            <div class="side-menu__title"> Settings</div>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                    </li>-->
                
                   
                  
                    <li class="side-nav__devider my-6" style="background:black"></li>
                   
                   
                   
                   
                   
                   
                </ul>
            </nav>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            
            <div class="content">

            
            @yield('content')
            
</div>
            <!-- END: Content -->
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
       
        <!-- END: JS Assets-->

        <script>






$('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      if($(this).val()=='radio' || $(this).val()=='checkbox'){
		  
		  $('#optTable').show();
		  $('#menuTable').hide();
		   $('#inputT').hide();
	  }
      else if($(this).val()=='yes' || $(this).val()=='no'){
		  
          // $('#optTable').show();
          // $('#menuTable').show();
           // $('#inputT').hide();
       }
	 else if($(this).val()=='selectMenu'){
		  
		  $('#menuTable').show();
		  $('#optTable').hide();
		   $('#inputT').hide();
	  }
	  else if($(this).val()=='textfield'){
		  
		  $('#menuTable').hide();
		  $('#optTable').hide();
		  $('#inputT').show();
	  }
	  
	  else{
		  
		 $('#optTable').hide();  
		  $('#menuTable').hide();  
		  $('#inputT').hide();
	  }
    }
  });


  var viewsVal = $('#views').val();
var arrayViews = viewsVal.split(",").map(x=>+x);

var entryVal = $('#entry').val();
var arrayEntry = entryVal.split(",").map(x=>+x);



var xValues = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      label: 'Interface View',
      data:arrayViews,
      borderColor: "red",
      fill: false
    }, { 
    label: 'Visitor Sign ups',
      data:arrayEntry,
      borderColor: "green",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});





var viewsVal = $('#views2').val();
var arrayViews = viewsVal.split(",").map(x=>+x);


var xValues = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];

new Chart("myChart2", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      label: 'Interface View',
      data:arrayViews,
      borderColor: "red",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});

var entryVal = $('#entry2').val();
var arrayVEntry = entryVal.split(",").map(x=>+x);


var xValues = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];

new Chart("myChart3", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      label: 'Interface View',
      data:arrayVEntry,
      borderColor: "green",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});

		   




	
	
	
 
  $('input[type="radio"]').click(function() {
    setActiveBox($(this));            
});   

function setActiveBox($radioButton) {
    if(!($radioButton instanceof jQuery)) {
        $radioButton = $($radioButton);
    }
    
    var value = $radioButton.attr("value");
    $(".box").hide();
    $("." + value).show();
    saveData("activeRadio",value);    
}

function saveData(key,value) {
       localStorage.setItem(key,value) || (document.cookie = key + "=" + value);
}

function getData(key) {
    return localStorage.getItem(key) || document.cookie.match(new RegExp(key + "\=(.+?)(?=;)"))[1];
}

//check stored radioButton on page load
var $radioButton = $("[value=" + getData("activeRadio") + "]");
$($radioButton).attr("checked",true);
setActiveBox($radioButton);
  
  






 </script>
    </body>
</html>