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
  .vl {
    border-left: 2px solid green;
    height: 400px;
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
			  <h3 class="">CONTACT US</h3><br><br>
			  <div class="row">
			    <div class="col-sm-6">

			      <div class="row">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d440.1443308042998!2d79.01342185059369!3d21.03709110413559!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4c772d0488d0b%3A0xe3a6693e3acc8f82!2ssmartData+Enterprises+(I)+Ltd.!5e1!3m2!1sen!2sin!4v1525262189031" width="400" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
			    </div>
			    <div class="col-sm-6 vl" style="padding: 100px;"> 
			      <div class="row" >
              <div class="col-md-2">
                <i class="fa fa-phone" style="font-size: 1.2em;">&nbsp;&nbsp;<b>Contacts:</b></i>
              </div>

              <div class="col-md-6 col-md-offset-4" >
                +91 8877667788
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                
              </div>
              <div class="col-md-6 col-md-offset-4" >
                +91 8899776655
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                <i class="fa fa-envelope">&nbsp;&nbsp;<b>Email:</b></i>
              </div>
              <div class="col-md-6 col-md-offset-4" >
                smartData@inc.in
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-2">
                <a href="#">
                  <i class="fa fa-facebook-official" style="font-size: 1.2em;"></i>
                </a>
              </div>
              <div class="col-md-2">
                <a href="#">
                  <i class="fa fa-twitter" style="font-size: 1.2em;"></i>  
                </a>
              </div>
              <div class="col-md-2">
              <a href="#">
                <i class="fa fa-github" style="font-size: 1.2em;"></i>
              </a>
              </div>
              
            </div>
			    </div>
			    </div>
			  </div>
			</div>
		</div>
</div>
@endsection
