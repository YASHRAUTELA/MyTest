@extends('layouts.admin')

@section('content')

<div id="page-wrapper" style="background-color: white;">
<div class="main-page" >
	<div class="col_4">
				@if (session('success'))
					<div class="row" id="flash">
						<div class="col-md-8 col-md-offset-2  alert alert-success">
							{{ session('success') }}
						</div>	
					</div>
				@endif
			<div class="row">
				<h1 style="text-align: center;">Student Marks</h1>
	    	</div>		
	    <div style="padding: 0px 200px;">
	    	<div class="row">
	    		<form method="post" action="{{route('addSubject')}}">
	    		{{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
                            <select class="form-control" name="student" id="student">
                                <option>Select Student</option>
                            </select>
                            @if ($errors->has('student'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('student') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
                            <select class="form-control" name="course" id="course">
                                <option>Select Course</option>
                            </select>
                            @if ($errors->has('course'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('course') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
                        <select class="form-control" name="semester" id="semester" readonly>
                            <option>Select Semester</option>
                        </select>
                        @if ($errors->has('semester'))
                            <span class="help-block">
                                <strong>{{ $errors->first('semester') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                        <select class="form-control" name="subject" id="subject" readonly>
                            <option>Select Subject</option>
                        </select>
                        @if ($errors->has('subject'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                </div>
		    		
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('marks_obtained') ? ' has-error' : '' }}">
                        <input type="number" min="0" class="form-control" name="marks_obtained" id="marks_obtained">
                        @if ($errors->has('marks_obtained'))
                            <span class="help-block">
                                <strong>{{ $errors->first('marks_obtained') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('total_marks') ? ' has-error' : '' }}">
                        <input type="number" min="0" class="form-control" name="total_marks" id="total_marks">
                        @if ($errors->has('total_marks'))
                            <span class="help-block">
                                <strong>{{ $errors->first('total_marks') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Add Marks</button>
                    </div>
                </div>

		    		
	    		</form>	
	    	</div>
		</div>
		<div class="clearfix"></div>
		<div class="table-responsive text-center">
		<table class="table table-borderless" id="table">
			<thead>
				<tr>
					<th style="text-align: center;">ID</th>
					<th style="text-align: center;">STUDENT</th>
					<th style="text-align: center;">COURSE</th>
					<th style="text-align: center;">SEMESTER</th>
					<th style="text-align: center;">SUBJECT</th>
                    <th style="text-align: center;">OBTAINED MARKS</th>
                    <th style="text-align: center;">TOTAL MARKS</th>
                    <th style="text-align: center;">ACTION</th>

				</tr>
			</thead>
			
		</table>
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="myDeleteModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Admin</h4>
        </div>
        <div class="modal-body">
          	<div class="row">
          		<div class="alert alert-danger">
					<strong>Do you really want to delete this Subject <span id="user_name" style="font-weight: bold; font-size: 14px;"></span>?</strong>
				</div>
          	</div>
          	<div class="row">
          		<div class="col-md-12" id="confirm_delete">
          			
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
	
	function myFunction(){
		$.ajax({
                type:'GET',
                url:'/getCourse',
                success:function(data){
                    console.log(data);
                    $("#course").empty();
                    $("#course").append("<option value=''>Select Course</option>");
                    $.each(data,function(key,value){
                    	$("#course").append("<option value='"+value.id+"'>"+value.course+"</option>");
                    });
                    
                }
            });
	}



	$(document).ready(function(){
      $('#course').change(function(){
        $.ajax({
          type:'POST',
          url:'/getSemester',
          data:{
            '_token':$('input[name="_token"]').val(),
            'course_id':$("#course").val()
          },
          success:function(data){
            console.log(data);
            $("#semester").empty();
            $("#semester").append("<option value=''>Select Semester</option>");
            $.each(data,function(key,value){
            	$("#semester").append("<option value='"+value.id+"'>"+value.semester+"</option>");
                $("#semester").removeAttr("readonly");
            });
          }
        });
      });
    });



    $(function(){
        $('#flash').delay(500).fadeIn('normal',function(){
            $(this).delay(2000).fadeOut();
        });
    });

    function deleteInfo(id){
		console.log(id);
		$("#confirm_delete").html("<a class='btn btn-danger' onclick='deleteSubject("+id+")'>Confirm Delete</a>");
		$('#myDeleteModal').modal('show');
	}

	function deleteSubject(id){
		$.ajax({
            type: 'POST',
            url: '/deleteSubject',
            data: {
            	'_token': $('input[name=_token]').val(),
                'id':id
            },
            success: function(data) {
            	console.log(data);
            	
            	if(data==200){
            		(function () {
					    var x = document.getElementById("snackbar");
					    x.className = "show";
					    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
					})();
            	}else{
            		(function () {
					    var x = document.getElementById("snackbar2");
					    $("#snackbar").text("data cannot be deleted due to some foreign key constraint");
					    x.className = "show";
					    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
					})();
            	}
            	setInterval(myTimer, 2000);
            	function myTimer(){
            		window.location="{{route('subject')}}";
            	}

            }
        });
	}


    </script>
	

@endpush
