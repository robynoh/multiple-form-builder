@extends('layouts.guest')

@section('title')
    <title> {{$bdetail->title}} | Watawazi  </title>
@endsection

@section('meta')

<meta name="description" content="{{substr($bdetail->content, 0,100)}}" />
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
<link rel="canonical" href="https://www.watawazi.com/blog/{{$bdetail->seo}}/" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{$bdetail->title}} | Watawazi" />
<meta property="og:description" content="{{substr($bdetail->content, 0,100)}}" />
<meta property="og:url" content="https://www.watawazi.com/blog/{{$bdetail->seo}}/" />
<meta property="og:site_name" content="Watawazi" />
<meta property="article:tag" content="Blog Post" />
<meta property="og:image" content="{{$bdetail->img}}" />
<meta property="og:image:secure_url" content="{{$bdetail->img}}" />
<meta property="og:image:width" content="1024" />
<meta property="og:image:height" content="512" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="{{substr($bdetail->content, 0,100)}}" />
<meta name="twitter:title" content="{{$bdetail->title}} | Watawazi" />
<meta name="twitter:image" content="{{$bdetail->img}}" />
@endsection

@section('content')

			

	
<section id="team" class="section section-with-shape-divider border-0 m-0" style="background:#fff">



					<div class="container pb-1 pb-sm-5 my-5">
						<br/>
					<div style="text-align:center;background-color:bisque;width:140px;margin:auto;border-radius:5px;padding:5px">{{ \Carbon\Carbon::parse($bdetail->date)->diffForHumans() }}</div>


						<div class="row justify-content-center ">
							
								
						
		
	
		<h1 class="font-weight-bold text-10 appear-animation p-3 text-center" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">{{$bdetail->title}}</h1>
	
	
	


						<div class="col-lg-10 text-justify">
								
							<img src="{{asset('dist/images/makingMoney.jpg')}}" class="img-fluid" alt="digital Marketers" />
<br/><br/>
<div class="text-4">
{!! $bdetail->content !!}

</div>
						
							<div style="text-align:left"><h2 class="font-weight-bold text-5 mb-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">Feartured Articles</h2>
	</div>




	

						<div class="row pb-1">

							


						

							

							@foreach($blogs as $blog)

							<div class="col-sm-6 col-lg-4 mb-4 pb-2">
								<a href="/blog/{{$blog->seo}}/">
									<article>
										<div class="thumb-info thumb-info-no-borders thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
											<div class="thumb-info-wrapper thumb-info-wrapper-opacity-6">
												<img src="{{$blog->img}}" width="375px" height="222px" class="img-fluid" alt="{{$blog->title}}">
												<div class="thumb-info-title bg-transparent p-4">
													<div class="thumb-info-type bg-color-primary px-2 mb-1">{{$blog->category}}</div>
													<div class="thumb-info-inner mt-1">
														<h2 class="text-color-light line-height-2 text-4 font-weight-bold mb-0">{{$blog->title}}</h2>
													</div>
													<div class="thumb-info-show-more-content text-quaternary">
														{!! substr($blog->content, 0,100) !!}
													</div>
												</div>
											</div>
										</div>
									</article>
								</a>
							</div>
							@endforeach

						</div>
					</div>
						
						


						



						</div>
						
					</div>




		

				


				

<section>	
	

@endsection