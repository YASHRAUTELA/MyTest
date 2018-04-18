@extends('layouts.admin')

@section('content')

<div id="page-wrapper">
<div class="main-page">
	<div class="col_4">
		<div class="row">
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                	<a href="{{url('/smsStudent')}}" style="text-decoration: none;">
                		<i class="pull-left fa fa-user user1 icon-rounded"></i>
                    	<div class="stats">
                      		<h5><strong>Students</strong></h5>
                      		<span> Information</span>
                    	</div>
                	</a>
                </div>
        	</div>
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
        		<a href="{{url('/smsFaculty')}}" style="text-decoration: none;">
                    <i class="pull-left fa fa-user user2 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>Faculties</strong></h5>
                      <span>Information</span>
                    </div>
                </a>
                </div>
        	</div>
        	<div class="col-md-3 widget widget1">
	        	<div class="r3_counter_box">
	        		<a href="{{url('/smsAdmin')}}" style="text-decoration: none;">
	                    <i class="pull-left fa fa-user dollar1 icon-rounded"></i>
	                    <div class="stats">
	                      <h5><strong>Admin</strong></h5>
	                      <span>Information</span>
	                    </div>
	                </a>
	            </div>
        	</div>
    	</div>	
        	
		</div>
		<div class="clearfix"> </div>
		
		<div class="charts row-one widgettable">
        <div class="clearfix"> </div>		
			<div class="mid-content-top charts-grids">
				<div class="middle-content">
					
					@yield('others')

				</div>
					
			</div>
		</div>
</div>
</div>


@endsection