@extends('admin.adminDefault')

@section('others')
					<h4 class="title">Students</h4>
					
					<div class="row">
						<div class="col-md-1 col-sm-1"><label>ID</label></div>
						<div class="col-md-2 col-sm-3"><label>Name</label></div>
						<div class="col-md-3 col-sm-5"><label>Email</label></div>
						<div class="col-md-2 col-sm-3"><label>DOB</label></div>
						<div class="col-md-4 col-sm-3"><label>ACTION</label></div>
					</div>
					@foreach($data as $student)
					<div class="row">
						<div class="col-md-1 col-sm-1">{{$student->id}}</div>
						<div class="col-md-2 col-sm-3">{{$student->name}}</div>
						<div class="col-md-3 col-sm-5">{{$student->email}}</div>
						<div class="col-md-2 col-sm-3">{{$student->dob}}</div>
						<div class="col-md-4 col-sm-3">
							<a href="#" data-toggle="modal" onclick="studentInfo({{$student->id}})"  class="btn btn-success">Show</a>
							<a href="#" class="btn btn-warning">Update</a>
							<a href="#" class="btn btn-danger">Remove</a>
						</div>
					</div>
					@endforeach

	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog" style="width: 800px;">
	      	<!-- Modal content-->
	      	<div class="modal-content">
	        	<div class="modal-header">
	         	 	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	</div>
		        <div class="modal-body">
		        	<div class="container" style="width: 600px;" >
			        	<div class="row">
			        		<div class="col-md-6">
			        			<label>ID:</label>&nbsp;&nbsp;&nbsp;
			        			<p id="id"></p>
			        		</div>
			        		<div class="col-md-6">
			        			<label>Name:</label>&nbsp;&nbsp;&nbsp;
			        			<p id="name"></p>
			        		</div>
			        	</div>

			        	<div class="row">
			        		<div class="col-md-6">
			        			<label>Email:</label>&nbsp;&nbsp;&nbsp;
			        			<p id="email"></p>
			        		</div>
			        		
			        		<div class="col-md-6">
			        			<label>DOB:</label>&nbsp;&nbsp;&nbsp;
			        			<p id="dob"></p>
			        		</div>
			        	</div>

			        	<div class="row">
			        		<div class="col-md-12" id="image">
			        			
			        		</div>
			        	</div>

			        	<div class="row">
			        		<div class="col-md-6">
			        			<label>Status:</label>&nbsp;&nbsp;&nbsp;	
			        			<p id="status"></p>
			        		</div>
			        		<div class="clearfix"></div>
			        	</div>
		        	</div>
		        </div>
		        <div class="modal-footer">
		         	 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
	      	</div>
	    </div>
	</div>

@endsection

@push('script')

<script type="text/javascript">
	function studentInfo(id){
		console.log(id);

		$.ajax({
            type: 'POST',
            url: '/getUserInfo',
            data: {
            	'_token': $('input[name=_token]').val(),
                'id':id
            },
            success: function(data) {
            	if(data.status==1){
            		$("#status").text("Active");	
            	}
            	else{
            		$("#status").text("Not active");
            	}
            	console.log(data);
            	$("#id").text(data.id);
            	$("#name").text(data.name);
            	$("#email").text(data.email);
            	$("#dob").text(data.dob);
            	
            	$("#image").html("<img style='height:100px; width:100px;'src={{asset('images')}}"+'/'+data.image_title+">");
		   		$('#myModal').modal('show');
            }
        });
	}
</script>

@endpush