<?php   use \App\Http\Controllers\UserController; ?>
<!DOCTYPE html>
<html>
	<head>
	<style>
.img {
    margin: 0 auto;
}


    </style>
		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title><?php echo ucfirst(str_replace('-', ' ',strtolower($title))); ?></title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">



		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CPlayfair+Display:400,700,900&display=swap" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('form/vendor/bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('form/vendor/fontawesome-free/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('form/vendor/animate/animate.compat.css') }}">
		<link rel="stylesheet" href="{{ asset('form/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('form/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('form/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
		<link rel="stylesheet" href="{{ asset('form/vendor/magnific-popup/magnific-popup.min.css') }}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('form/css/theme.css') }}">
		<link rel="stylesheet" href="{{ asset('form/css/theme-elements.css') }}">
		<link rel="stylesheet" href="{{ asset('form/css/theme-blog.css') }}">
		<link rel="stylesheet" href="{{ asset('form/css/theme-shop.css') }}">



		<!-- Demo CSS -->
		<link rel="stylesheet" href="{{ asset('form/css/demos/demo-startup-agency.css')}}">
		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="{{asset('form/css/skins/skin-startup-agency.css')}}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('form/css/custom.css')}}">

		<!-- Head Libs -->
        <script src="{{ asset('form/vendor/modernizr/modernizr.min.js') }}"></script>
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bfc05fd108f497b"></script>



	</head>
	<body data-target="#header" data-spy="scroll" data-offset="257" >
	<div style="text-align:center;padding-top:10px">

	<?php if(Auth::check()) {?>
	<a class="btn btn-secondary btn-with-arrow mb-2" href="http://watawazi.com/users/all_pages">Go Back<span><i class="fas fa-chevron-right"></i></span></a>
	
	<div class="addthis_inline_share_toolbox"></div>
	<?php }?>
</div>
		<div class="body">
	
			<div role="main" class="main">
				
		
<section id="team" class="section section-with-shape-divider border-0 m-0" style="background-color:<?php echo $page->bgcolor ?>">
	

<div class="container mb-5">


					<div id="pricing" class="row justify-content-center ">
						
						<div class="col-lg-10 text-center <?php if($page->border_option==1){?>card <?php }?>" style="background-color:<?php echo $page->bgcolor; ?>;padding:20px;border-color:<?php echo $page->border_color ?>">
							<h1 style="color:<?php echo $page->color; ?>"><?php echo ucfirst(str_replace('-', ' ',strtolower($title))); ?></h1>
						
						@foreach($divs as $div)
					
						<?php echo UserController::filterContent2($div->id)?>
					
					
					@endforeach
					
					
					</div>
					</div>





					
				</div>
				</section>

				

			</div> 

		

		</div>

		<!-- Vendor -->
		<script src="{{asset('form/vendor/jquery/jquery.min.js')}}"></script>
		<script src="{{asset('form/vendor/jquery.appear/jquery.appear.min.js')}}"></script>
		<script src="{{asset('form/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
		<script src="{{asset('form/vendor/jquery.cookie/jquery.cookie.min.js')}}"></script>
		<script src="{{asset('form/vendor/popper/umd/popper.min.js')}}"></script>
		<script src="{{asset('form/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('form/vendor/jquery.validation/jquery.validate.min.js')}}"></script>
		<script src="{{asset('form/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
		<script src="{{asset('form/vendor/jquery.gmap/jquery.gmap.min.js')}}"></script>
		<script src="{{asset('form/vendor/lazysizes/lazysizes.min.js')}}"></script>
		<script src="{{asset('form/vendor/isotope/jquery.isotope.min.js')}}"></script>
		<script src="{{asset('form/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
		<script src="{{asset('form/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
		<script src="{{asset('form/vendor/vide/jquery.vide.min.js')}}"></script>
		<script src="{{asset('form/vendor/vivus/vivus.min.js')}}"></script>
		<script src="{{asset('form/vendor/kute/kute.min.js')}}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('form/js/theme.js')}}"></script>

		

		<!-- Current Page Vendor and Views -->
		<script src="{{asset('js/views/view.contact.js')}}"></script>

		<!-- Demo -->
		<script src="{{asset('form/js/demos/demo-startup-agency.js')}}"></script>
		<!-- Theme Custom -->
		<script src="{{asset('form/js/custom.js')}}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{asset('form/js/theme.init.js')}}"></script>



	</body>
</html>





















		