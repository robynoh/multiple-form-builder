<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		@yield('title')	

		@yield('meta')

		<!-- Favicon -->
		
		<link rel="shortcut icon" href="{{ asset('dist/images/favi.png') }}" type="image/x-icon" />
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


	</head>
	<body data-target="#header" data-spy="scroll" data-offset="257">

		<div class="body">
			<header id="header" class="header-effect-shrink header-transparent" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
				<div class="header-body header-body-bottom-border border-top-0 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="900">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="demo-startup-agency.html">
											<img src="{{ asset('form/img/demos/startup-agency/logo.png')}}" class="img-fluid" width="195" height="64" alt="" />
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row">
									<div class="header-nav header-nav-line header-nav-bottom-line header-nav-bottom-line-effect-1">
										<div class="header-nav-main header-nav-main-text-capitalize header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li><a href="/" class="nav-link active" data-hash data-hash-offset="70">Home</a></li>

													
													
													<li><a href="/solution" class="nav-link" data-hash data-hash-offset="35">Solutions</a></li>
                                                    <li><a href="/pricing" class="nav-link" data-hash data-hash-offset="135">Pricing</a></li>
													<li><a href="/pages" class="nav-link" data-hash data-hash-offset="255">Pages</a></li>
													<li><a href="/blog" class="nav-link" data-hash data-hash-offset="255">Blog</a></li>
													
													
													<li>
													<?php if(Auth::check()) {?>

														<a href="/users" class="nav-link" data-hash data-hash-offset="135">Dashboard</a>
														<?php }else{?>
													

													<a href="{{ route('login') }}" class="nav-link" data-hash data-hash-offset="135">Login</a>
														
													<?php }?>
												</li>
													<!---<li><a href="#blog" class="nav-link" data-hash data-hash-offset="70">Blog</a></li>
													<li><a href="#footer" class="nav-link" data-hash data-hash-offset="70">Contact</a></li> -->
												</ul>
											</nav>
										</div>
									</div>
									<ul class="header-social-icons social-icons social-icons-clean social-icons-medium ml-0 ml-xl-3 d-none d-md-inline-flex">
										<li class="social-icons-facebook"><a href="https://www.facebook.com/watawazitips" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
										<li class="social-icons-twitter"><a href="https://twitter.com/watawazi" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
										</ul>
									<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
										<i class="fas fa-bars"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main">
				
			@yield('content')

				

			</div> 

			<footer id="footer" class="border-0 bg-dark pt-4 mt-0">
				
				<div class="footer-copyright bg-dark mt-0 pb-5">
					<div class="container footer-top-light-border pt-0">
						<div class="row">
							<div class="col">
								<p class="text-center text-color-light opacity-5">Watawazi © <?php echo date('Y'); ?>. All Rights Reserved.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>

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

