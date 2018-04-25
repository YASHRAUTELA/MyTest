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

<div id="page-wrapper" style="background-color: white;">
<div class="main-page" >
	<div class="col_4">
        <div style="height: 100px;">
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
						
	    <div>
	    	<div class="row" style="margin:0px 100px;">
	    		<form method="post" action="{{route('addExam')}}">
	    		{{csrf_field()}}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group{{ $errors->has('exam') ? ' has-error' : '' }}">
                            <input type="text" name="exam" id="exam" class="form-control" placeholder="Enter Exam Name" autofocus>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-primary"><i class="fa fa-edit"></i>Add</button>
                    </div>
                </div>
	    		</form>	
	    	</div>
		</div>
		<div class="table-responsive text-center">
		<table class="table table-borderless display" id="table" style="width:100%">
			<thead>
				<tr>
					<th style="text-align: center;">ID</th>
					<th style="text-align: center;">EXAM</th>
                    <th style="text-align: center;">ACTION</th>
				</tr>
			</thead>
            <tbody>
            @foreach($exams as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->exam_type}}</td>
                    <td>
                        <a href="{{url('/editExam',$data->id)}}" class="btn btn-warning"><i class="fa fa-edit">Edit</i></a>
                        <a href="#" onclick="deleteInfo({{$data->id}})" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash">Delete</i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
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
<div id="snackbar">Data Deleted Successfully..</div>
@endsection

@push('script')

<script type="text/javascript">
	function deleteInfo(id){
        console.log(id);
        $("#confirm_delete").html("<a class='btn btn-danger' onclick='deleteExam("+id+")'>Confirm Delete</a>");
        $('#myDeleteModal').modal('show');
    }

    function deleteExam(id){
        $.ajax({
            type: 'POST',
            url: '/deleteExam',
            data: {
                '_token': $('input[name=_token]').val(),
                'id':id
            },
            success: function(data) {
                console.log(data);
                $('#myDeleteModal').modal('hide');
                if(data==200){
                    (function () {
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }else{
                    (function () {
                        var x = document.getElementById("snackbar");
                        $("#snackbar").text("The Exam that you want to delete, is already in use.");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }
                setInterval(myTimer, 2000);
                function myTimer(){
                    
                    window.location="{{route('exams')}}";
                }

            }
        });
    }
    $(function(){
        $('#flash').delay(500).fadeIn('normal',function(){
            $(this).delay(2000).fadeOut();
        });
    });

    $(document).ready(function() {
            $('#table').DataTable();
        });


    </script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	

@endpush
