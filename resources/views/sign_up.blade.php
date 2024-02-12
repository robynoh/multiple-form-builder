<?php   use \App\Http\Controllers\UserController;
		use Illuminate\Support\Facades\Auth;
		use Illuminate\Support\Str;

		$brand="";
		$aboutBusiness="";
		$img="";

?>


<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>{{UserController::pull_business($tableid)}} - {{$optin->title}}</title>	

	   <meta name='robots' content='max-image-preview:large' />

<meta name="description" content="{{$optin->description}}" />
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
<link rel="canonical" href="https://www.watawazi.com/interface/optin/{{$tableid}}/{{UserController::encrypt_decrypt($optin->id,true)}}/{{$userid}}" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{$optin->title}}" />
<meta property="og:description" content="{{$optin->description}}" />
<meta property="og:url" content="https://www.watawazi.com/interface/optin/{{$tableid}}/{{UserController::encrypt_decrypt($optin->id,true)}}/{{$userid}}" />
<meta property="og:site_name" content="Watawazi" />
<meta property="article:section" content="Sign up" />
<meta property="og:image" content="{{$optin->img}}" />
<meta property="og:image:secure_url" content="{{$optin->img}}" />
<meta property="og:image:width" content="1024" />
<meta property="og:image:height" content="512" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="{{$optin->description}}" />
<meta name="twitter:title" content="{{$optin->title}}" />
<meta name="twitter:image" content="{{$optin->img}}" />




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

		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		 <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bfc05fd108f497b"></script>

	</head>
	<body data-plugin-page-transition>
		<div class="body">
			
			<div role="main" class="main">
			<?php if(Auth::check()) {?>
			<?php if(Usercontroller::encrypt_decrypt($userid,false)==Auth::user()->id){?>
			<?php echo $submsg; ?>
						
		<?php } } ?>
		
				<section class="section section-overlay-opacity section-overlay-opacity-scale-7 border-0 m-0" style="background-image: url('{{asset($optin->img)}}'); background-size: cover; background-position: center;">
					<div class="container py-5" style="margin-top:-70px">
						<div class="row align-items-center justify-content-center" >
<?php if($no_visibility->count()<1){?>
						<div class="col-lg-3" >
							
						<span class="thumb-info thumb-info-side-image thumb-info-no-zoom " >
												<span class="thumb-info-side-image-wrapper" style="padding-left:30px;padding-top:10px">
													<img src="{{asset($businesslogo->logo)}}" class="img-fluid rounded-circle mb-4" alt="" style="width:150px;">
												</span>

												

											

												<span class="thumb-info-caption" >
													<span class="thumb-info-caption-text" style="padding-left:10px">
													<?php $brand=$business->brand_name; $aboutBusiness=$business->about_business; $img=$businesslogo->logo; ?>
													<table>
														<tr>
															<td style="padding-right:10px">
														<h5 class="text-uppercase mb-1"><a data-toggle="modal" data-target="#largeModal2" href="javascript:void(0)">{{$business->brand_name}}</a></h5>
														{{$business->business_area}}
														
														<br/><br/>

													
</td>
</tr>
<tr>
														
<td>
	<h5 class="text-uppercase mb-1">share this</h5>

														<div class="addthis_inline_share_toolbox"></div>
														
														
</td>
</tr>


</table>
													</span>
												</span>	
											

												<?php if(Auth::check()) {?>
												<div class="col-lg-12">

												<?php if(Usercontroller::encrypt_decrypt($userid,false)!=Auth::user()->id){?>


													<a  class="btn btn-outline btn-gradient mb-2" href="http://www.watawazi.com/admin/interface/{{$tableid}}/{{Usercontroller::encrypt_decrypt($userid,false)}}" style="color:black;width:100%"> Go back </a>
												

	<?php }else{?>

											

												<a  class="btn btn-outline btn-gradient mb-2" href="http://www.watawazi.com/users/interface/{{$tableid}}" style="color:black;width:100%"> Go back to Niche Board </a>
												
												<?php }?>


												<?php if($optin->redirect_link==""){?>
<a class="btn btn-outline btn-gradient mb-2" data-toggle="modal" data-target="#largeModal" href="javascript:void(0)" style="padding-right:20px;;color:#000;width:100%"> Copy embed HTML</a>
<?php }?>

												<form action="/users/no-profile" method="GET" >
	<input name="table_id" type="hidden" value="{{$style->table_id}}" />
	<?php if(Usercontroller::encrypt_decrypt($userid,false)==Auth::user()->id){?>
<button type="submit" class="btn btn-success btn-block mb-2" style="width:100%">Hide this panel from public</button>
<?php }?>
</form>


</div>

<?php }?>
									
											</span>

											
							
						</div>
<?php } ?>


						<div class="col-lg-6" >
							<?php if(Auth::check()) {?>

						<?php if($no_visibility->count()>0){?>
							<div style="padding:10px"><span >
<?php if(Usercontroller::encrypt_decrypt($userid,false)!=Auth::user()->id){?>
	<a  class="btn btn-outline btn-gradient mb-2" href="http://www.watawazi.com/admin/interface/{{$tableid}}/{{Usercontroller::encrypt_decrypt($userid,false)}}" style="color:black;width:100%"> Go back </a>
												

	<?php }else{?>
							<a  class="btn btn-outline btn-gradient mb-2" href="http://www.watawazi.com/users/interface/{{$tableid}}" style="color:#fff;width:100%"> Go back to niche board</a>

<?php }?>
						</span>

						<?php if(Usercontroller::encrypt_decrypt($userid,false)==Auth::user()->id){?>

<span  style="color:greenyellow"><a class="btn btn-outline btn-gradient mb-2"  href="/users/bringprofile/{{$tableid}}" style="padding-right:20px;;color:#fff;width:100%"> Show profile panel</a></span>
<?php }?>

<?php if($optin->redirect_link==""){?>
<span  style="color:greenyellow"><a class="btn btn-outline btn-gradient mb-2"  data-toggle="modal" data-target="#largeModal" href="javascript:void(0)" style="padding-right:20px;;color:#fff;width:100%"> Copy Link</a></span>
<?php }?>
</div>
							<?php }?>	
							<?php }?>
							<br/>
							<div style="background:{{$style->bgcolor}};font-family:{{$style->font_type}}" class="slider-contact-form-wrapper rounded p-5 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="" data-appear-animation-duration="1s">
									<div class="row">
										<div class="col">
											<h2 class="font-weight-semi-bold mb-2" style="color:{{$style->title_color}};font-size:{{$style->title_size}}px">{{$optin->title}}</h2>
											<p class=" opacity-7 font-weight-light mb-4 " style="color:{{$style->description_color}};font-size:{{$style->description_size}}px">{!!$optin->description!!}</p>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<form class="contact-form form-style-2" method="POST">

											{{ csrf_field() }} 
											<input type="hidden" name="tableid" value="{{Usercontroller::encrypt_decrypt($tableid,false)}}" />
                                            <input type="hidden" name="usrid" value="{{Usercontroller::encrypt_decrypt($userid,false)}}" />

								
													@foreach($fields as $field)
												
												<div class="form-row">

												<label class="" for="inputDefault" style="padding-left:5px;color:{{$style->title_color}}"><?php echo ucwords(str_replace('_', ' ',$field->fields)) ;?> <span style="color:#ff0000"><?php if($field->required_type=='yes'){echo"*";} ?></span></label>
													<div class="form-group col-lg-12">

													<?php echo UserController::verifyField2(str_replace('_', ' ',$field->fields),$field->required_type,$field->type,$userid,$tableid,$field->description,$style->tfcolor) ?>
   
														</div>
													
												</div>

												@endforeach
												
												<div class="form-row">
													<div class="form-group col text-center">

													<button class="btn px-4 py-3" style="width:100%;background:{{$style->bcolor}};color:{{$style->btcolor}}" >{{$style->buttonText}}</button>
									
														</div>
												</div>
												<br/>
												
												<?php if($no_visibility->count()>0){?>
												<h5 class="text-uppercase mb-1" style="color:{{$style->title_color}}">share this</h5>

														<div class="addthis_inline_share_toolbox"></div>
											<?php } ?>
													</form>
										</div>
									</div>
								</div>
							</div>




						</div>
					</div>

					
					<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="largeModalLabel" style="text-align:center">Copy page link</h4>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												</div>
												<div class="modal-body" style="text-align:justify;color:#000">
												<blockquote id="embed" style="background-color:lightgrey;">
												
												<?php echo URL::current();?>
												</blockquote>

												
											</div>
												<div class="modal-footer">
												<!--<button onclick="copyToClipboard('#embed')" class="btn btn-success" >Copy code</button> -->
												
													<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>



									<div class="modal fade" id="largeModal2" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
											<div class="modal-header">
											<span class="thumb-info-side-image-wrapper" >
													<img src="{{asset($img)}}" class="img-fluid rounded-circle" alt="" style="width:50px;padding-right:5px">
												</span>		<h4 class="modal-title" id="largeModalLabel" style="text-align:center"><?php echo $brand;?></h4>
												
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												</div>
												<div class="modal-body" style="text-align:justify;color:#000">
												<?php echo $aboutBusiness?>

												
											</div>
												<div class="modal-footer">
												<!--<button onclick="copyToClipboard('#embed')" class="btn btn-success" >Copy code</button> -->
												
													<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
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
								
							<?php if(UserController::userpackagebrand(Usercontroller::encrypt_decrypt($userid,false))=="free"){?>
								<P style="font-size:14px">This signup form was created with watawazi <b  ><a href="http://www.watawazi.com" style="color:#006600">Create Sign up form</a></b></P>
								<ul class="footer-social-icons social-icons social-icons-clean social-icons-icon-light mb-3">
									<li class="social-icons-facebook"><a href="https://www.facebook.com/watawazitips" target="_blank" title="Facebook"><i class="fab fa-facebook-f text-2"></i></a></li>
									<li class="social-icons-twitter"><a href="https://twitter.com/watawazi" target="_blank" title="Twitter"><i class="fab fa-twitter text-2"></i></a></li>
									</ul>
									<?php }?>
								<p><strong><a href="http://www.watawazi.com"> <?php if(UserController::userpackagebrand(Usercontroller::encrypt_decrypt($userid,false))=="free"){?>WATAWAZI <?php }else{?> {{$brand}}<?php }?></a></strong> - © Copyright 2021. All Rights Reserved.</p>
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



function copyToClipboard(element) {
  /* Get the text field */
  var $temp =$("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  alert("Code copied!");
}


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
