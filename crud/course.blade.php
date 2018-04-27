@extends('layouts.admin')
@section('style')
<style>

#snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}
</style>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="col_1" id="page-wrapper" style="background-color: white;">
	<div class="form-group row add col_1">
			<div class="col-md-6">
				<input type="text" class="form-control" id="course" name="course"
					placeholder="Enter Course" required>
				<p class="error text-center alert alert-danger hidden"></p>
			</div>

            <div class="col-md-2">
                <input type="text" class="form-control" id="duration" name="duration"
                    placeholder="Enter Course Duration" required>
                <p class="error text-center alert alert-danger hidden"></p>
            </div>

			<div class="col-md-4">
				<button class="btn btn-primary" type="submit" id="add">
					<span class="glyphicon glyphicon-plus"></span> ADD
				</button>
			</div>
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="table-responsive text-center">
			<table class="table table-borderless" id="table">
				<thead >
					<tr>
						<th style="text-align: center;">ID</th>
						<th style="text-align: center;">Course Name</th>
                        <th style="text-align: center;">Course Duration</th>
						<th style="text-align: center;">Actions</th>
					</tr>
				</thead>
				@foreach($course_data as $data)	
					<tr class="item{{$data->id}}">
						<td>{{$data->id}}</td>
						<td>{{$data->course}}</td>
                        <td>{{$data->duration}}</td>
						<td><button class="edit-modal btn btn-info" data-id="{{$data->id}}" data-course="{{$data->course}}" data-duration="{{$data->duration}}">
							<span class="glyphicon glyphicon-edit"></span> Edit
							</button>
							<button class="delete-modal btn btn-danger" data-id="{{$data->id}}" data-course="{{$data->course}}" data-duration="{{$data->duration}}">
								<span class="glyphicon glyphicon-trash"></span> Delete
							</button>
						</td>
				</tr>
				@endforeach	
			</table>
		</div>

		<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="fid" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="course">Course:</label>
							<div class="col-sm-10">
								<input type="course" class="form-control" id="n">
							</div>
						</div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="duration">Duration:</label>
                            <div class="col-sm-10">
                                <input type="duration" class="form-control" id="d">
                            </div>
                        </div>
					</form>
					<div class="deleteContent">
						Are you Sure you want to delete <span class="dname"></span> ? <span
							class="hidden did"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class='glyphicon'> </span>
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class='glyphicon glyphicon-remove'></span> Close
						</button>
					</div>
				</div>
			</div>
		</div>
		</div>
</div>
<div id="snackbar">Course Deleted Successfully..</div>
	
@endsection

@push('script')

	<script>
    $(document).ready(function() {
            $('#table').DataTable();
        });




    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.actionBtn').removeClass('delete');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#n').val($(this).data('course'));
        $('#d').val($(this).data('duration'));
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.actionBtn').removeClass('edit');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('course'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {

        $.ajax({
            type: 'POST',
            url: '/editCourse',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'course': $('#n').val(),
                'duration':$('#d').val()
            },
            success: function(data) {
            	console.log(data);
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.course +"</td><td>"+data.duration+"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-course='" + data.course+ "' data-duration='"+data.duration+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-course='" + data.course + "'data-duration='"+data.duration+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            }
        });
    });
    $("#add").click(function() {
        $.ajax({
            type: 'post',
            url: '/addCourse',
            data: {
                '_token': $('input[name=_token]').val(),
                'course': $('input[name=course]').val(),
                'duration':$('input[name=duration]').val()
            },
            success: function(data) {
                if ((data.errors)){
                	$('.error').removeClass('hidden');
                    $('.error').text(data.errors.course);
                    $('.error').text(data.errors.duration);
                    console.log("asd");
                }
                else {
                	console.log(data);
                    $('.error').addClass('hidden');
                    $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.course +"</td><td>"+data.duration+"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-course='" + data.course + "'data-duration='"+data.duration+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-course='" + data.course + "'data-duration='"+data.duration+"'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");


                }
            },
        });
        $('#course').val('');
        $('#duration').val('');
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteCourse',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                console.log(data);
                if(data==200){
                    (function () {
                        $('.item' + $('.did').text()).remove();
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }else{
                    (function () {
                        var x = document.getElementById("snackbar");
                        $("#snackbar").text("The Selected Course that you want to delete, is already in use.");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }
                setInterval(myTimer, 2000);
                function myTimer(){
                    
                    // window.location="{{route('course')}}";
                }







                
            }
        });
    });
</script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js
"></script>
@endpush