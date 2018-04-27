<!DOCTYPE HTML>
<html>
<head>
<title>Glance Design Dashboard an Admin Panel Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@yield('style')
<!-- <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 -->
<!-- Bootstrap Core CSS -->
<link href="{{asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

<!-- side nav css file -->
<link href='{{asset("css/SidebarNav.min.css")}}' media='all' rel='stylesheet' type='text/css'/>
<!-- //side nav css file -->
 
 <!-- js-->
<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/modernizr.custom.js')}}"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 

<!-- chart -->
<script src="{{asset('js/Chart.js')}}"></script>
<!-- //chart -->

<!-- Metis Menu -->
<script src="{{asset('js/metisMenu.min.js')}}"></script>
<!-- <script src="{{asset('js/custom.js')}}"></script> -->
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
<!--//Metis Menu -->
<style>
#chartdiv {
  width: 100%;
  height: 295px;
}
</style>
<!-- requried-jsfiles-for owl -->
					<link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet">
					<script src="{{asset('js/owl.carousel.js')}}"></script>
						<script>
							$(document).ready(function() {
								$("#owl-demo").owlCarousel({
									items : 3,
									lazyLoad : true,
									autoPlay : true,
									pagination : true,
									nav:true,
								});
							});
						</script>
					<!-- //requried-jsfiles-for owl -->
</head> 
<body class="cbp-spmenu-push" onload="myFunction()">
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left" style="height:800px; overflow-y: auto;">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="{{route('home')}}"><span class="fa fa-graduation-cap"></span> SMS<span class="dashboard_text">Interaction Portal</span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">MAIN NAVIGATION</li>
              
			  @guest
			  		<li class="treeview">
		                <a href="#">
		                <i class="fa fa-edit"></i> <span>Login/Register</span>
		                <i class="fa fa-angle-left pull-right"></i>
		                </a>
		                <ul class="treeview-menu">
		                  <li><a href="{{route('login')}}"><i class="fa fa-angle-right"></i>Login</a></li>
		                  <li><a href="{{route('register')}}"><i class="fa fa-angle-right"></i> Register</a></li>
		                </ul>
		              </li>
			  @else
					<li class="treeview">
		                <a href="#">
		                <i class="fa fa-envelope"></i> <span>Mailbox </span>
		                <i class="fa fa-angle-left pull-right"></i><small class="label pull-right label-info1">08</small><span class="label label-primary1 pull-right">02</span></a>
		                <ul class="treeview-menu">
		                  <li><a href="{{route('myMails')}}"><i class="fa fa-angle-right"></i> Mail Inbox </a></li>
		                  <li><a href="{{route('compose')}}"><i class="fa fa-angle-right"></i> Compose Mail </a></li>
		                  <li><a href="{{route('sentMails')}}"><i class="fa fa-angle-right"></i> Mail Sent </a></li>
		                </ul>
		              </li>
		              @if(Auth::user()->role_id==3)
		              <li class="treeview">
		                <a href="{{route('myMarks')}}">
		                <i class="fa fa-table"></i> <span>My Marks </span>
		                </a>
		              </li>
		              @endif
		        @if(Auth::user()->role_id==1)      
		              <li class="treeview">
		                <a href="{{route('course')}}">
		                <i class="fa fa-graduation-cap"></i> <span>Course </span>
		                </a>
		              </li>

		              <li class="treeview">
		                <a href="{{route('department')}}">
		                <i class="fa fa-building"></i> <span>Department </span>
		                </a>
		              </li>

		              <li class="treeview">
		                <a href="{{route('state')}}">
		                <i class="fa fa-flag"></i> <span>State </span>
		                </a>
		              </li>

		              <li class="treeview">
		                <a href="{{route('city')}}">
		                <i class="fa fa-map-marker"></i> <span>City </span>
		                </a>
		              </li>

		              <li class="treeview">
		                <a href="#">
		                <span class="fa fa-user-plus"></span> <span>Add Student Information </span>
		                <i class="fa fa-angle-left pull-right"></i>
		                </a>
		                <ul class="treeview-menu">
		                  <li><a href="{{route('studentInfo')}}"><i class="fa fa-angle-right"></i>  Manually(One by One)</a></li>
		                  <li><a href="#"><i class="fa fa-angle-right"></i> Using Excel Sheet </a></li>
		                  <li><a href="#"><i class="fa fa-angle-right"></i> Display All </a></li>
		                </ul>
		              </li>

		              <li class="treeview">
		                <a href="{{route('semester')}}">
		                <i class="fa fa-university"></i> <span>Semester </span>
		                </a>
		              </li>

		              <li class="treeview">
		                <a href="{{route('subject')}}">
		                <i class="fa fa-book"></i> <span>Subjects </span>
		                </a>
		              </li>

		              <li class="treeview">
		                <a href="{{route('exams')}}">
		                <i class="fa fa-book"></i> <span>Exams </span>
		                </a>
		              </li>

		              <li class="treeview">
		                <a href="{{route('marks')}}">
		                <i class="fa fa-table"></i> <span>Marks </span>
		                </a>
		              </li>
		              <li class="treeview">
		                <a href="#">
		                <i class="fa fa-user"></i> <span>Users</span>
		                <i class="fa fa-angle-left pull-right"></i>
		                </a>
		                <ul class="treeview-menu">
		                  <li><a href="{{route('smsStudent')}}"><i class="fa fa-angle-right"></i>Student</a></li>
		                  <li><a href="{{route('smsFaculty')}}"><i class="fa fa-angle-right"></i>Faculty</a></li>
		                  <li><a href="{{route('smsAdmin')}}"><i class="fa fa-angle-right"></i>Admin</a></li>
		                </ul>
		              </li>
		       	@endif
			  @endguest



              
              <li class="treeview">
                <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{route('404')}}"><i class="fa fa-angle-right"></i> 404 Error</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i> 500 Error</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i> Blank Page</a></li>
                </ul>
              </li>
              
            </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush" data-toggle="tooltip" title="menu bar" data-placement="right"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="profile_details_left"><!--notifications of menu start -->
					
					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
					
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									
									
									@guest
									<span class="fa fa-user" style="font-size: 3em;" ></span>
									<div class="user-name">
										<h5>Guest</h5>
									@else
									<img height="50" width="50" class="img-circle" src="{{asset('images/'.Auth::user()->image_title)}}"Admin>
									<div class="user-name">
										<p>{{ Auth::user()->name }}</p>
										<span>{{Session::get('role')}}</span>
									@endguest
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								@guest
		                            <li><a href="{{ route('login') }}">Login</a></li>
		                            <li><a href="{{ route('register') }}">Register</a></li>
		                        @else
		                        	<li> <a href="{{route('changePassword')}}"><i class="fa fa-cog"></i> Change Password</a> </li>
									<li> 
										<a href="{{route('myProfile')}}">
											<i class="fa fa-suitcase"></i> Profile
										</a> 
									</li> 
		                            <li class="dropdown">

		                            	<a href="{{ route('logout') }}"
		                                            onclick="event.preventDefault();
		                                                     document.getElementById('logout-form').submit();">
		                                            <i class="fa fa-sign-out"></i>
		                                            Logout
		                                </a>

		                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                            {{ csrf_field() }}
		                                </form>
		                                
		                            </li>
		                        @endguest
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		@yield('content')
		<br>
<br>
<br>
<br>
		<!-- for amcharts js -->
			<!-- <script src="{{asset('js/amcharts.js')}}"></script>
			<script src="{{asset('js/serial.js')}}"></script>
			<script src="{{asset('js/export.min.js')}}"></script>
			<link rel="stylesheet" href="{{asset('css/export.css')}}" type="text/css" media="all" />
			<script src="{{asset('js/light.js')}}"></script> -->
	<!-- for amcharts js -->

   <!--  <script  src="{{asset('js/index1.js')}}"></script> -->
	<!--footer-->
	<div class="footer" style="position: fixed; bottom: 0; left:0;">
	   <p>&copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a> | Modified by Yashwant Rautela</p>		
	</div>
    <!--//footer-->
	</div>
		
	<!-- new added graphs chart js-->
	
    <script src="{{asset('js/Chart.bundle.js')}}"></script>
    <script src="{{asset('js/utils.js')}}"></script>
	
	
	<!-- new added graphs chart js-->
	
	<!-- Classie --><!-- for toggle left push menu script -->
		<script src="{{asset('js/classie.js')}}"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->
		
	<!--scrolling js-->
	<script src="{{asset('js/jquery.nicescroll.js')}}"></script>
	<script src="{{asset('js/scripts.js')}}"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src="{{asset('js/SidebarNav.min.js')}}" type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!-- for index page weekly sales java script -->
	<script src="{{asset('js/SimpleChart.js')}}"></script>
	
	<!-- Bootstrap Core JavaScript -->
   <script src="{{asset('js/bootstrap.js')}}"> </script>

	<!-- //Bootstrap Core JavaScript -->

	<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
	
@stack('script')
</body>
</html>