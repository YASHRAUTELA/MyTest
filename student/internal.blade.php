@extends('layouts.admin')

@section('content')
<div >
	<div class="col_1" >
		<div id="page-wrapper" style="background-color:white;">
					
		 	<div class="col-md-8 col-md-offset-2 panel panel-primary">
		    	<div class="panel-heading"><h3>My Internal Marks</h3></div>
		    	<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<select class="form-control">
								<option>Select Exam</option>
							</select>
						</div>
						<div class="col-md-4">
							<select class="form-control">
								<option>Select Semester</option>
							</select>
						</div>
						<div class="col-md-4">
							<button class="btn btn-primary">Get Result&nbsp;<i class="fa fa-hand-o-up"></i></button>
						</div>	
					</div> 
		    	</div>
			</div>
			@yield('others')
		</div>	
	</div>
	<div class="clearfix"></div>
</div>
<br><br><br><br><br>

@endsection
