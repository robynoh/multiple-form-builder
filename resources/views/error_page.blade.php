<?php   use \App\Http\Controllers\UserController;
		use Illuminate\Support\Facades\Auth;

?>


<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Something went wrong!</title>	

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
			
			<div role="main" class="main">

			<section class="http-error py-0">
					<div class="row justify-content-center py-3">
						<div class="col-6 text-center">
							<div class="http-error-main">
								<div >
									<br/><br/>
								<img alt="Midone Tailwind HTML Admin Template" src="{{ asset('dist/images/error_photo.png') }}" >
</div>
								
<br/>
<span class="text-6 font-weight-bold text-color-dark">PAGE NOT FOUND</span>
								<p class="text-3 my-4 line-height-8">Sorry, this page cannot be reached.</p>
								
							</div>
							<a href="http://watawazi.com" class="btn btn-success btn-rounded btn-xl font-weight-semibold text-2 px-4 py-3 mt-1 mb-4"><i class="fas fa-angle-left pr-3"></i>GO TO HOME PAGE</a>
						</div>
					</div>
				</section>
				

				

				

			
			</div>

		
		</div>

		<!-- Vendor -->
		
		<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>



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


		<script>

			/*
			Map Settings

				Find the Latitude and Longitude of your address:
					- https://www.latlong.net/
					- http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

			*/

			function initializeGoogleMaps() {
				// Map Markers
				var mapMarkers = [{
					address: "New York, NY 10017",
					html: "<strong>New York Office</strong><br>New York, NY 10017",
					icon: {
						image: "img/pin.png",
						iconsize: [26, 46],
						iconanchor: [12, 46]
					},
					popup: true
				}];

				// Map Initial Location
				var initLatitude = 40.75198;
				var initLongitude = -73.96978;

				// Map Extended Settings
				var mapSettings = {
					controls: {
						draggable: (($.browser.mobile) ? false : true),
						panControl: true,
						zoomControl: true,
						mapTypeControl: true,
						scaleControl: true,
						streetViewControl: true,
						overviewMapControl: true
					},
					scrollwheel: false,
					markers: mapMarkers,
					latitude: initLatitude,
					longitude: initLongitude,
					zoom: 16
				};

				var map = $('#googlemaps').gMap(mapSettings),
					mapRef = $('#googlemaps').data('gMap.reference');

				// Styles from https://snazzymaps.com/
				var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];

				var styledMap = new google.maps.StyledMapType(styles, {
					name: 'Styled Map'
				});

				mapRef.mapTypes.set('map_style', styledMap);
				mapRef.setMapTypeId('map_style');
			}

			// Initialize Google Maps when element enter on browser view
			theme.fn.intObs( '.google-map', 'initializeGoogleMaps()', {} );

		</script>

	</body>
</html>
