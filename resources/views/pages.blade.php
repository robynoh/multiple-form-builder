<?php   use \App\Http\Controllers\UserController;
		use Illuminate\Support\Facades\Auth;

?>
@extends('layouts.guest')
@section('title')
    <title> Sales Pages | Watawazi  </title>
@endsection
@section('content')

<br/><br/><br/>
<div role="main" class="main" >

				<section class="page-header page-header-modern  page-header-md" style="background:#fff">
					<div class="container">
						<div class="row">
							<div class="col-md-12 align-self-center p-static order-2 text-center">
								<h1 class="text-dark font-weight-bold text-8">List of Top Sales and Landing Pages</h1>
					
							</div>
							<div class="col-md-12 align-self-center order-1">
								<ul class="breadcrumb d-block text-center">
									<li><a href="#">Home</a></li>
									<li class="active">Pages</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container py-4" >

					<div class="row">
						<div class="col-lg-3 order-lg-2">
							<aside class="sidebar">
								<form action="page-search-results" method="get">
									<div class="input-group mb-3 pb-1">
										<input class="form-control text-1" placeholder="Search..." name="search-term" id="s" type="text">
										<button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
									</div>
								</form>
										
								<div class="px-3 mt-4">
										<h3 class="text-color-dark text-capitalize font-weight-bold text-5 m-0 mb-3">Recent Posts</h3>
										<div class="pb-2 mb-1">
											<?php echo UserController::pagefilt()?></div>
									</div>	</aside>
						</div>
						<div class="col-lg-9 order-lg-1">
							<div class="blog-posts">

							@foreach($pages as $page)
								<article class="post post-medium">
									<div class="row mb-3">
										<div class="col-lg-5">
											<div class="post-image">
												<a href="blog-post.html">
													<img src="<?php  echo Usercontroller::blogcoverphoto($page->id) ?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
												</a>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="post-content">
												<h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2"><a href="/{{$page->id}}/{{$page->userID}}/pages/{{Usercontroller::getbusinessnamePage($page->userID)}}/{{str_replace(' ', '-',strtolower($page->page_title))}}" style="color:black">{{$page->page_title}}</a></h2>
												<p class="mb-0">{{$page->page_description}}</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="post-meta">
											<span><i class="far fa-calendar-alt"></i> {{date('j F, Y', strtotime($page->created_at))}} </span>
												<span><i class="far fa-user"></i> By <a href="#">John Doe</a> </span>
												
												<span><i class="far fa-eye"></i>{{$page->visit_count}}<a href="#"> views</a></span>
												<span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="/{{$page->id}}/{{$page->userID}}/pages/{{Usercontroller::getbusinessnamePage($page->userID)}}/{{str_replace(' ', '-',strtolower($page->page_title))}}" class="btn btn-xs btn-light text-1 text-uppercase">View Page</a></span>
											</div>
										</div>
									</div>
								</article>
@endforeach


<br/>
<br/>

                   
								

							

						

								<ul class="pagination float-right">
									
								{!! $pages->links('pagination::bootstrap-4') !!}	</ul>

							</div>
						</div>
					</div>

				</div>

			</div>

				
@endsection