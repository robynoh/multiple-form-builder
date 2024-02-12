<?php   use \App\Http\Controllers\UserController;
		use Illuminate\Support\Facades\Auth;

?>

<!DOCTYPE html>
<html>
	<head>
		<style>

#organisation{
	display:block;
}










   

			</style>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Forms Basic | Porto - Responsive HTML5 Template</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">



		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet" type="text/css">

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




		<!-- Admin Extension Specific Page Vendor CSS -->
		<link rel="stylesheet" href="admin/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Admin Extension CSS -->
		<link rel="stylesheet" href="admin/css/theme-admin-extension.css">

		<!-- Admin Extension Skin CSS -->
		<link rel="stylesheet" href="admin/css/skins/extension.css">
		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="{{ asset('form/css/skins/default.css') }}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('form/css/custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('form/vendor/modernizr/modernizr.min.js') }}"></script>

	</head>
	<body data-plugin-page-transition>

		<div class="body">






		
			<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': true, 'stickyStartAt': 70, 'stickyChangeLogo': false, 'stickyHeaderContainerHeight': 70}">
				
			
			<div class="header-body border-top-0 box-shadow-none">


			

				
					<div class="header-container header-container-md container">

					
						
						<div class="header-row">
							
							<div class="header-column" style="width:50%">
								<div class="header-row">
									<div class="header-logo" style="font-size:18px">
										<a href="#" class="goto-top"><img alt="Porto" width="100" height="80" data-sticky-width="82" data-sticky-height="40" data-sticky-top="0" src="{{ asset($logos) }}"></a>
									<!---	<div  id="organisation" style="padding-left:3px">{{ $company_name }}</div>-->
									</div>
								</div>
							</div>




							<div class="header-column justify-content-start">
									<div class="header-row">
										<nav class="header-nav-top">
											<ul class="nav nav-pills">
											
											<li class="nav-item nav-item-left-border nav-item-left-border-remove nav-item-left-border-sm-show">
													<span class="ws-nowrap"><i class="fas fa-globe"></i> grb-finfo@gmail.com</span>
												</li>
												<li class="nav-item nav-item-left-border nav-item-left-border-remove nav-item-left-border-sm-show">
													<span class="ws-nowrap"><i class="fas fa-phone"></i> 090975755874</span>
												</li>
											</ul>
										</nav>
									</div>
								</div>

							
								
							<div class="header-column justify-content-end">
								<div class="header-row">
									<div class="header-nav header-nav-line header-nav-bottom-line header-nav-bottom-line-no-transform header-nav-bottom-line-active-text-dark header-nav-bottom-line-effect-1 order-2 order-lg-1">
										
									
									
									<div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
											
										<nav class="collapse">
												
												<ul class="nav nav-pills" id="mainNav">
													
												
													
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle" href="#">
															Home
														</a>
														
													</li>
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle" data-toggle="modal" data-target="#largeModal" href="javascript:void(0)">
															About
														</a>
														
													</li>

												<?php 	if(Auth::check()){ ?>


													<li class="dropdown">
														<a href="/users/collect_information" class="dropdown-item dropdown-toggle" href="#">
															DASHBOARD
														</a>
														
													</li>

													<?php } ?>
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			

			<div role="main" class="main">

				
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="alert alert-info alert-admin alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div class="row">
									<div class="col-lg-12">
										<h4>IMPORTANT INFORMATION</h4>
										<p><strong class="warning"><i class="fas fa-exclamation-triangle"></i> Warning!</strong> This page is part of the admin extension and is <strong>NOT</strong> included on Porto - Responsive HTML5 Template, to get all features, purchase both templates: <a target="_blank" href="http://www.themeforest.net/item/porto-responsive-html5-template/4106987?ref=Okler">Porto ($16)</a> + <a target="_blank" href="http://www.themeforest.net/item/porto-admin-responsive-html5-template/8539472?ref=Okler">Porto Admin ($16)</a>: <strong>$32 Total.</strong></p>
										<p>
											<a class="btn btn-lg btn-sm btn-primary" target="_blank" href="http://www.themeforest.net/item/porto-admin-responsive-html5-template/8539472?ref=Okler">Back to Dashborad</a>
										</p>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="container">
					<div class="row">
						<div class="col">
							<section class="card card-admin">
								<header class="card-header" style="text-align:center">
									<div class="card-actions">
										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
										<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
									</div>
<br/><br/>
									<h4 class="card-title">{{ucfirst($title)}} </h4>
									<p style="mt-2">{!! ucfirst(substr($notes,0,300)) !!}<a href="javascript:void(0);"  data-toggle="modal" data-target="#largeModal">View More </a>
									</p>

									<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="largeModalLabel" style="text-align:center">{{ucfirst($title)}}</h4>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												</div>
												<div class="modal-body" style="text-align:justify">
												{!! ucfirst($notes) !!}</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>

									
								</header>
								<div class="card-body">

								@if(session('success'))
				<div class="alert alert-success">
												<strong><i class="far fa-thumbs-up"></i> Well done!</strong> 
{{session('success')}}
    </div>
@endif
									<form class="form-horizontal form-bordered"  method="post">

									{{ csrf_field() }} 

                                    @foreach($fields as $field)

										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault"><?php echo ucwords(str_replace('_', ' ',$field->fields)) ;?> </label>
											<div class="col-lg-6">
                                            <?php echo UserController::verifyField2(str_replace('_', ' ',$field->fields),$field->type,$users) ?>
   
											</div>
										</div>

                                   
										
										@endforeach

                                        <div class="form-group row">

                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault"> </label>
											<div class="col-lg-6">
                                            <button class="btn btn-lg btn-sm btn-success" >Submit</button>
									
											</div>
                                       
                                        </div>
										
									</form>
								</div>
							</section>
						</div>
					</div>

					

				

					


					
				</div>

			</div>

			<footer id="footer" class="footer-texts-more-lighten">
				<div class="container">
					
				</div>
				<div class="container">
					<div class="footer-copyright footer-copyright-style-2 pt-4 pb-5">
						<div class="row">
							<div class="col-12 text-center">
								<p class="mb-0">Porto Template © 2021. All Rights Reserved</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src=" {{ asset('form/vendor/jquery/jquery.min.js') }}"></script>
		<script src=" {{ asset('form/vendor/jquery.appear/jquery.appear.min.js') }}"></script>
		<script src="{{ asset('form/vendor/jquery.easing/jquery.easing.min.js ') }}"></script>
		<script src="{{ asset('form/vendor/jquery.cookie/jquery.cookie.min.js  ') }}"></script>
		<script src=" {{ asset('form/vendor/popper/umd/popper.min.js ') }}"></script>
		<script src=" {{ asset('form/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('form/vendor/jquery.validation/jquery.validate.min.js ') }}"></script>
		<script src=" {{ asset('form/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js ') }}"></script>
		<script src=" {{ asset('form/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>
		<script src=" {{ asset('form/vendor/lazysizes/lazysizes.min.js') }}"></script>
		<script src=" {{ asset('form/vendor/isotope/jquery.isotope.min.js') }}"></script>
		<script src=" {{ asset('form/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
		<script src=" {{ asset('form/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ asset('form/vendor/vide/jquery.vide.min.js ') }}"></script>
		<script src="{{ asset('form/vendor/vivus/vivus.min.js ') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src=" {{ asset('form/js/theme.js ') }}"></script>

		

		<!-- Admin Extension Specific Page Vendor -->
		<script src="admin/vendor/autosize/autosize.js"></script>
		<script src="admin/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>

		<!-- Admin Extension -->
		<script src="admin/js/theme.admin.extension.js"></script>
		<!-- Theme Custom -->
		<script src=" {{ asset('form/js/custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ asset('form/js/theme.init.js  ') }}"></script>

	</body>
</html>
