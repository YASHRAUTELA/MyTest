@extends('layouts.admin')
@section('style')
<style type="text/css">
	
</style>
@endsection
@section('content')

<div id="page-wrapper" style="background-color: white;">
<div class="main-page">

			<div class="col_3">
                <div class="col-md-4 widget widget1">
                    <div class="r3_counter_box">
                    <a href="{{url('smsStudent')}}" style="text-decoration: none;">
                        <i class="pull-left fa fa-user user1 icon-rounded"></i>
                            <div class="stats">
                              <h5><strong>Students</strong></h5>
                      		<span> Information</span>
                            </div>
                    </a>
                    </div>
                </div>
                <div class="col-md-4 widget widget1">
                    <div class="r3_counter_box">
                    	<a href="{{url('smsFaculty')}}" style="text-decoration: none;">
                            <i class="pull-left fa fa-user user2 icon-rounded"></i>
                            <div class="stats">
                             	<h5><strong>Faculties</strong></h5>
                      			<span>Information</span>
                            </div>
                        </a>
                    </div>
                </div>
                    
                <div class="col-md-4 widget">
                    <div class="r3_counter_box">
                        <a href="{{url('/smsAdmin')}}" style="text-decoration: none;">
                            <i class="pull-left fa fa-user dollar2 icon-rounded"></i>
                            <div class="stats">
                              	<h5><strong>Admin</strong></h5>
	                      		<span>Information</span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="clearfix"> </div>
            </div>
		
		
		<div class="charts row-one widgettable">
        <div class="clearfix"> </div>		
			<div class="mid-content-top charts-grids">
				<div class="middle-content">
						<h4 class="title">Image Gallary</h4>
					<!-- start content_slider -->
					<div id="owl-demo" class="owl-carousel text-center">
						<div class="item">
							<img class="lazyOwl img-responsive" style="height: 280px; width:500px;" data-src="slider/1.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" style="height: 280px; width:500px;" data-src="slider/2.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" style="height: 280px; width:500px;" data-src="slider/3.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" style="height: 280px; width:500px;" data-src="slider/4.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" style="height: 280px; width:500px;" data-src="slider/5.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" style="height: 280px; width:500px;" data-src="slider/6.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" style="height: 280px; width:500px;" data-src="slider/7.jpg" alt="name">
						</div>
					</div>
				</div>
					<!--//sreen-gallery-cursual---->
			</div>
		</div>


		<div class="container" style="height: 500px; width: 800px;">
  
  <center>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img  src="{{asset('slider/1.jpg')}}" alt="Los Angeles" style="width:100%;">
        <div class="carousel-caption">
          <h3>Los Angeles</h3>
          <p>LA is always so much fun!</p>
        </div>
      </div>

      <div class="item">
        <img  src="{{asset('slider/2.jpg')}}" alt="Chicago" style="width:100%;">
        <div class="carousel-caption">
          <h3>Chicago</h3>
          <p>Thank you, Chicago!</p>
        </div>
      </div>
    
      <div class="item">
        <img  src="{{asset('slider/3.jpg')}}" style="height: 500px; width: 800px;" alt="New York" style="width:100%;">
        <div class="carousel-caption">
          <h3>New York</h3>
          <p>We love the Big Apple!</p>
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </center>
</div>



</div>
</div>


@endsection