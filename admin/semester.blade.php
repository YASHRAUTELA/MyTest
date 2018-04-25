@extends('layouts.admin')

@section('content')

<div id="page-wrapper" style="background-color: white;">
<div class="main-page" >
	<div class="col_4">
			<div class="row" style="height: 100px;">
				<div class="col-md-8">
					<h1 style="text-align: center;">Semester</h1>	
				</div>
				<div class="col-md-4">
					<div>
						@if (session('success'))
						<div class="row" id="flash">
							<div class="col-md-8 col-md-offset-2  alert alert-success">
								{{ session('success') }}
							</div>	
						</div>
						@endif

						@if (session('error'))
						<div class="row" id="flash">
							<div class="col-md-8 col-md-offset-2  alert alert-danger">
								{{ session('error') }}
							</div>	
						</div>
						@endif
					</div>
				</div>
				
	    	</div>

	    	<div class="row">
	    		<div class="col-md-12" style="margin-left: 100px;">
	    			<div class="row">
			    		<form method="post" action="{{route('addSemester')}}">
			    		{{csrf_field()}}
			    			<div class="col-md-6">
				    			<select class="form-control" name="course" id="add_course">
				    				<option>Select Course</option>
				    			</select>
				    		</div>
				    		<div class="col-md-4">
				    			<button type="submit" class="btn btn-primary">Add Semester</button>
				    		</div>
			    		</form>	
			    	</div>

			    	<div class="row">
			    		<form method="post" action="{{route('deleteSemester')}}">
			    		{{csrf_field()}}
			    			<div class="col-md-6">
				    			<select class="form-control" name="course" id="del_course">
				    				<option>Select Course</option>
				    			</select>
				    		</div>
				    		<div class="col-md-4">
				    			<button type="submit" class="btn btn-danger">Delete Semester</button>
				    		</div>
			    		</form>	
			    	</div>
	    		</div>
	    			
	    		
	    	</div>
	    	<div class="row">
	    		<div class="clearfix"></div>

					<div class="col-md-12" style="padding: 0px 200px 0px 100px;">
						<div class="row">
							<div class="col-md-2 col-sm-2">ID</div>
							<div class="col-md-5 col-sm-5">SEMESTER</div>
							<div class="col-md-5 col-sm-5">COURSE</div>

						</div>
						@foreach($data as $semester)
							<div class="row alert alert-info">
								<div class="col-md-2 col-sm-2">{{$semester->id}}</div>
								<div class="col-md-5 col-sm-5">{{$semester->semester}}</div>
								<div class="col-md-5 col-sm-5">{{$semester->course}}</div>
							</div>
							<div class="clearfix"></div>
						@endforeach
						{{ $data->links() }}
					</div>
	    	</div>		
	    <div  style="padding: 0px 200px;">
	    	
		</div>
		
	</div>
</div>
</div>
@endsection

@push('script')

<script type="text/javascript">
	function myFunction(){
		$.ajax({
                type:'GET',
                url:'/getCourseForSemester',
                success:function(data){
                    console.log(data);
                    $("#add_course").empty();
                    $("#add_course").append("<option value=''>Select Course</option>");
                    $.each(data,function(key,value){
                    	$("#add_course").append("<option value='"+value.id+"'>"+value.course+"</option>");
                    	
                    });
                    
                }
            });

		$.ajax({
                type:'GET',
                url:'/getDeleteCourseForSemester',
                success:function(data){
                    console.log(data);
                    $("#del_course").empty();
                    $("#del_course").append("<option value=''>Select Course</option>");
                    $.each(data,function(key,value){
                    	$("#del_course").append("<option value='"+value.id+"'>"+value.course+"</option>");
                    	
                    });
                    
                }
            });
	}

	$(function(){
        $('#flash').delay(500).fadeIn('normal',function(){
            $(this).delay(2000).fadeOut();
        });
    });
</script>

@endpush
