@extends('layouts.admin')

@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="col_1" id="page-wrapper" style="background-color: white;">
	<div class="form-group row add">
			<div class="col-md-6">
				<input type="text" class="form-control" id="department" name="department"
					placeholder="Enter Course" required>
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
						<th style="text-align: center;">Department Name</th>
						<th style="text-align: center;">Actions</th>
					</tr>
				</thead>
				@foreach($department_data as $data)	
					<tr class="item{{$data->id}}">
						<td>{{$data->id}}</td>
						<td>{{$data->department}}</td>
						<td><button class="edit-modal btn btn-info" data-id="{{$data->id}}" data-department="{{$data->department}}">
							<span class="glyphicon glyphicon-edit"></span> Edit
							</button>
							<button class="delete-modal btn btn-danger" data-id="{{$data->id}}" data-department="{{$data->department}}">
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
							<label class="control-label col-sm-2" for="department">Department Name:</label>
							<div class="col-sm-10">
								<input type="department" class="form-control" id="n">
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
        $('#n').val($(this).data('department'));
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
        $('.dname').html($(this).data('department'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {

        $.ajax({
            type: 'POST',
            url: '/editDepartment',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'department': $('#n').val()
            },
            success: function(data) {
            	console.log(data);
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.department+"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-department='" + data.department+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-department='" + data.department + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            }
        });
    });
    $("#add").click(function() {
        $.ajax({
            type: 'post',
            url: '/addDepartment',
            data: {
                '_token': $('input[name=_token]').val(),
                'department': $('input[name=department]').val(),
                
            },
            success: function(data) {
                if ((data.errors)){
                	$('.error').removeClass('hidden');
                    $('.error').text(data.errors.department);
                    
                }
                else {
                	console.log(data);
                    $('.error').addClass('hidden');
                    $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.department +"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-department='" + data.department +"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-department='" + data.department +"'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");


                }
            },
        });
        $('#department').val('');
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteDepartment',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
</script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js
"></script>
@endpush