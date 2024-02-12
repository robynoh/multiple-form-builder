@extends('layouts.guest')

@section('title')
    <title> Blog | Watawazi  </title>
@endsection
@section('content')

						

<section id="team" class="section section-with-shape-divider border-0 m-0" style="background:#fff">

<br/><br/><br/>


<div style="text-align:center"><h2 class="font-weight-bold text-10 mb-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">Watawazi Blog</h2>
	</div>
<div class="container container-lg-custom">
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
													<div class="thumb-info-show-more-content">
														<p class="mb-0 text-1 line-height-9 mb-1 mt-2 text-light opacity-5">{!! substr($blog->content, 0,100) !!}</p>
													</div>
												</div>
											</div>
										</div>
									</article>
								</a>
							</div>
							@endforeach

						</div>
						
						<div style="margin:auto" style="text-align:center" >{{$blogs->links('pagination::bootstrap-4')}}</div>
					
							</div>
		

				


				

<section>	
	

@endsection