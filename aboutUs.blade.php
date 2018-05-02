@extends('layouts.admin')

@section('style')
  <style>
  
  .font{
  	font-size: 16px;
  }
  .bg-1 { 
      background-color: #1abc9c; /* Green */
      color: #ffffff;
  }
  .bg-2 { 
      background-color: #474e5d; /* Dark Blue */
      color: #ffffff;
  }
  .bg-3 { 
      background-color: #ffffff; /* White */
      color: #555555;
  }
  .bg-4 { 
      background-color: #2f2f2f; /* Black Gray */
      color: #fff;
  }
  .container-fluid {
      padding-top: 70px;
      padding-bottom: 70px;
  }
  </style>

@endsection
@section('content')
<div class="col_1" id="page-wrapper" style="background-color: white;">
<!-- Third Container (Grid) -->
	<div class="main-page">
    	<div class="col_3">
			<div class="col-md-4 widget widget1">
				<a href="{{route('aboutUs')}}">
	            	<div class="r3_counter_box">
	                	<i class="pull-left fa fa-television user1 icon-rounded"></i>
	                    <div class="stats">
	                      <h5><strong>About Us</strong></h5>
	                    </div>
	                </div>
	            </a>
            </div>
            <div class="col-md-4 widget widget1">
                <a href="{{route('default')}}">
	                <div class="r3_counter_box">
	                    <i class="pull-left fa fa-picture-o user2 icon-rounded"></i>
	                    <div class="stats">
	                      <h5><strong>Photo Gallary</strong></h5>
	                      <span>Expenses</span>
	                    </div>
	                </div>	
                </a>
            </div>
            
            <div class="col-md-4 widget">
            <a href="{{route('contactUs')}}">
            	<div class="r3_counter_box">
                    <i class="pull-left fa fa-phone-square dollar2 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>Contact Us</strong></h5>
                      <span>Total Users</span>
                    </div>
                </div>
            </a>
                
            </div>
            <div class="clearfix"></div>
        </div>

			<div class="container-fluid bg-3 text-center">    
			  <h3 class="">ABOUT US</h3><br>
			  <div class="row">
			    <div class="col-sm-4">
			      <p class="font">Best Education Institute</p>
			      <img src="{{asset('images/college1.jpg')}}" class="img-responsive" style="width:100%; min-height: 300px;" alt="Image">
			    </div>
			    <div class="col-sm-4"> 
			      <p class="font">Provides Best Qualification</p>
			      <img src="{{asset('images/college2.jpg')}}" class="img-responsive" style="width:100%; min-height: 300px;" alt="Image">
			    </div>
			    <div class="col-sm-4"> 
			      <p class="font">Best Faculties Available</p>
			      <img src="{{asset('images/college3.jpg')}}" class="img-responsive" style="width:100%; min-height: 300px;" alt="Image">
			    </div>
			  </div>
			</div>
		</div>
</div>
@endsection
