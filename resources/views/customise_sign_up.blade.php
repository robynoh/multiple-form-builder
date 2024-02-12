<?php   use \App\Http\Controllers\UserController;
		use Illuminate\Support\Facades\Auth;

?>


<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>User | Customize optin form </title> 	

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
			@if($errors->any())
<div class="alert alert-warning"> 
    
   
        <Ol>
      <li>  {{$errors->first()}}</li>
        </Ol>
    </div>

@endif





			<div role="main" class="main">

			@if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-7" style="text-align:center;font-weight:bold;font-size:20px;color:darkgreen"> 
{{session('success')}}
    </div>
@endif

				<section class="section section-overlay-opacity section-overlay-opacity-scale-7 border-0 m-0" style="background-image: url('{{asset('dist/images/customise_bg.png')}}'); background-size: cover; background-position: center;">
					<div class="container py-5">
						<div class="row align-items-center justify-content-center">
						

						<div class="col-lg-6 text-center mb-5 mb-lg-0" style="margin-top:-100px">
							<div class="row">
										<div class="col text-center">
											<h2 class="font-weight-semi-bold text-color-light text-6 mb-2">Edit Theme</h2>
											<p class="text-color-light opacity-7 font-weight-light mb-4 px-xl-5">Change form, Title and description color, font type and size here <br/><a href="/users/user_settings/{{ UserController::encrypt_decrypt($tableid,true)}}" style="color:greenyellow">Go back to board settings</a></p>
										</div>
									</div>
								<div class="d-flex flex-column align-items-center justify-content-center">
								<div class="col">
											<form class="contact-form form-style-2" action="" method="POST">
											{{ csrf_field() }} 
												
											<table>	
												<tr>
													<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">Background Color</td><td>
												<div class="form-row" style="padding-top:10px">													<div class="form-group col-lg-12">
 
													<input type="color"  name="bgcolor"  value="{{$style->bgcolor}}">
														</div>
													
												</div>
</td>
</tr>


<tr>
													<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">Title/Text Color</td><td>
												<div class="form-row" style="padding-top:10px">													<div class="form-group col-lg-12">
 
													<input type="color"  name="tcolor"  value="{{$style->title_color}}">
														</div>
													
												</div>
</td>
</tr>


<tr>
													<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">Description Color </td><td>
												<div class="form-row" style="padding-top:10px">													<div class="form-group col-lg-12">
 
													<input type="color"  name="dcolor"  value="{{$style->description_color}}">
														</div>
													
												</div>
</td>
</tr>

<tr>
													<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">Button Color</td><td>
												<div class="form-row" style="padding-top:10px">													<div class="form-group col-lg-12">
 
													<input type="color"  name="bcolor"  value="{{$style->bcolor}}">
														</div>
													
												</div>
</td>
</tr>

<tr>
													<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">Button Text Color</td><td>
												<div class="form-row" style="padding-top:10px">													<div class="form-group col-lg-12">
 
													<input type="color"  name="btcolor"  value="{{$style->btcolor}}">
														</div>
													
												</div>
</td>
</tr>


<tr>
													<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">Title Font size</td><td>
												<div class="form-row" style="padding-top:10px">													<div class="form-group col-lg-12">
 
													<select name="titleftsize">
													<option>{{$style->title_size}}</option>
													<option>13</option>
													<option>14</option>
													<option>15</option>
													<option>16</option>
													<option>17</option>
													<option>18</option>
													<option>19</option>
													<option>20</option>
													<option>21</option>
													<option>22</option>
													<option>23</option>
													<option>24</option>
													<option>25</option>
													<option>26</option>
													<option>27</option>
													</select>
														</div>
													
												</div>
</td>
</tr>


<tr>
													<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">Description Font size</td><td>
												<div class="form-row" style="padding-top:10px">													<div class="form-group col-lg-12">
 
													<select name="desFtsize">
													<option>{{$style->description_size}}</option>
													<option>13</option>
													<option>14</option>
													<option>15</option>
													<option>16</option>
													<option>17</option>
													<option>18</option>
													<option>19</option>
													<option>20</option>
													<option>21</option>
													<option>22</option>
													<option>23</option>
													<option>24</option>
													<option>25</option>
													<option>26</option>
													<option>27</option>
													</select>
														</div>
													
												</div>
</td>
</tr>

<tr>
													<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">Font Type</td><td>
												<div class="form-row" style="padding-top:10px">													<div class="form-group col-lg-12">
 
												<select name="font_type" style="height:30px">
													<option>Times New Roman", Times, serif</option>
													<option>Arial, Helvetica, sans-serif</option>
													<option>Lucida Console", "Courier New", monospace</option>
													<option> "Amstelvar Alpha", serif</option>
													<option> "Dhyana", sans-serif</option>
													</select>
														</div>
													
												</div>
</td>
</tr>

<tr>
<td style="padding:5px;color:#FFF;float:left;padding-top:10px"><a id="show" href="javascript:void(0)" onclick="showMore();" style="color:greenyellow">VIEW MORE >></a>
<a style="display:none;color:greenyellow" id="close" href="javascript:void(0)" onclick="hideMore();" >HIDE <<</a>
</td>
<td></td>
</tr>

<tr class="tfield" style="display:none">
<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px;">Text Field Color</td>
<td><input type="color"  name="tfcolor" value="{{$style->tfcolor}}" />
													 </td>
</tr>

<tr class="bttext"  style="display:none">
<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">Submit Button Text</td>
<td><input type="text"  name="buttonTxt" style="width:100%" value="{{$style->buttonText}}" /></td>
</tr>

<tr>
													<td style="padding:5px;color:blanchedalmond;float:left;padding-top:10px">
													<button name="customize"  value="save" class="btn btn-success px-4 py-3" style="width:100%" >SAVE SETTINGS</button>
									</td>
													
													<td>
													<button name="customize" value="default"  class="btn btn-primary px-4 py-3" style="width:100%" >RETURN TO DEFAULT</button>
									
</td>
</tr>
				
												
											
</table>
											</form>
										</div>
								
								</div>
							</div>
							<br/>
							<div class="col-lg-6">
								<div style="background:{{$style->bgcolor}};font-family:{{$style->font_type}}" class="slider-contact-form-wrapper rounded p-5 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="" data-appear-animation-duration="1s">
									<div class="row">
										<div class="col text-center">
											<h2 class="font-weight-semi-bold mb-2" style="color:{{$style->title_color}};font-size:{{$style->title_size}}px">Optin Form title placeholder</h2>
											<p class=" opacity-7 font-weight-light mb-4 px-xl-5" style="color:{{$style->description_color}};font-size:{{$style->description_size}}px">Optin Form description placeholder</p>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<form class="contact-form form-style-2" method="POST">
											{{ csrf_field() }} 
													@foreach($fields as $field)
												
												<div class="form-row">

												<label class="" for="inputDefault" style="padding-left:5px;color:{{$style->title_color}}"><?php echo ucwords(str_replace('_', ' ',$field->fields)) ;?> <span style="color:#ff0000"><?php if($field->required_type=='yes'){echo"*";} ?></span></label>
													<div class="form-group col-lg-12">

													<?php echo UserController::verifyField2(str_replace('_', ' ',$field->fields),$field->required_type,$field->type,auth()->user()->id,$tableid,$field->description,$style->tfcolor) ?>
   
														</div>
													
												</div>

												@endforeach
												
												<div class="form-row">
													<div class="form-group col text-center">

													<button class="btn px-4 py-3" style="width:100%;background:{{$style->bcolor}};color:{{$style->btcolor}}" >{{$style->buttonText}}</button>
									
														</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>


							
						</div>
					</div>
				</section>

				

				

				

			
			</div>

			<footer id="footer" class="mt-0">
				<div class="footer-copyright">
					<div class="container py-2">
						<div class="row py-4">
							<div class="col text-center">
								<ul class="footer-social-icons social-icons social-icons-clean social-icons-icon-light mb-3">
									<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f text-2"></i></a></li>
									<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter text-2"></i></a></li>
									<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in text-2"></i></a></li>
								</ul>
								<p><strong>WATAWAZI</strong> - © Copyright 2021. All Rights Reserved.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
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

			function showMore(){

				$('.tfield').show();
				$('.bttext').show();
				$('#show').hide();
				$('#close').show();
			}

			function hideMore(){

$('.tfield').hide();
$('.bttext').hide();
$('#show').show();
$('#close').hide();
}
		</script>

	</body>
</html>
