<!DOCTYPE HTML>
<html>
<head>
<title>Glance Design Dashboard an Admin Panel Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

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
<body class="cbp-spmenu-push">
    <div class="main-content">
    <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
        <!--left-fixed -navigation-->
        <aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="{{route('welcome')}}"><span class="fa fa-area-chart"></span> SMS<span class="dashboard_text">Management</span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">MAIN NAVIGATION</li>
              <li class="treeview">
                <a href="{{route('welcome')}}">
                <i class="fa fa-home"></i> <span>Home</span>
                </a>
              </li>
              
              
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
                                    <!-- <span class="prfil-img"><img src="images/2.jpg" alt=""> </span>  -->
                                    <span class="fa fa-user" style="font-size: 3em;" ></span>
                                    <div class="user-name">
                                        <h5>Guest</h5>
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
                                    <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                                    <li> <a href="#"><i class="fa fa-user"></i> My Account</a> </li> 
                                    <li> <a href="#"><i class="fa fa-suitcase"></i> Profile</a> </li> 
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
        <!-- //header-ends -->
        <!-- main content start-->
       



<!-- default content -->
    <div id="page-wrapper">
        <div class="main-page">
            <div class="col_3">
                    <div class="col-md-4 widget widget1">
                        <a href="{{route('aboutUs')}}">
                            <div class="r3_counter_box">
                            <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                                <div class="stats">
                                  <h5><strong>About Us</strong></h5>
                                  
                                </div>
                            </div>    
                        </a>
                        
                    </div>
                    <div class="col-md-4 widget widget1">
                        <a href="{{route('default')}}">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-money user2 icon-rounded"></i>
                                <div class="stats">
                                  <h5><strong>Photo Gallary</strong></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-4 widget">
                        <a href="{{route('contactUs')}}">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                                <div class="stats">
                                  <h5><strong>Contact Us</strong></h5>
                                </div>
                            </div>
                        </a>
                     </div>
                    <div class="clearfix"> </div>
                </div>
                
                <div class="charts row-one widgettable">
                <div class="clearfix"> </div>       
                    <div class="mid-content-top charts-grids">
                        <div class="middle-content">
                                <h4 class="title">Carousel Slider</h4>
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
        </div>
    </div>
<!-- default content -->

    <!--footer-->
    <div class="footer" style="position: fixed; bottom: 0;">
       <p>&copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a> | Modified by Yashwant Rautela</p>        
    </div>
    <!--//footer-->
    </div>
        
    <!-- new added graphs chart js-->
    
    <script src="{{asset('js/Chart.bundle.js')}}"></script>
    <script src="{{asset('js/utils.js')}}"></script>
    
    
    <!-- new added graphs chart js-->
    
    <!-- Classie --><!-- for toggle left push menu script -->
        <script src="js/classie.js"></script>
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
    <script src='{{asset("js/SidebarNav.min.js")}}' type='text/javascript'></script>
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
    
</body>
</html>
