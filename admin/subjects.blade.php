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
            
            <div class="row" style="height: 100px;">
                <div class="col-md-8">
                    <h1 style="text-align: center;">Subject</h1>    
                </div>

                <div class="col-md-4">
                    @if (session('success'))
                    <div class="row" id="flash">
                        <div class="col-md-8 col-md-offset-2  alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif
                </div>
                
            </div>
            <div>
                <div class="row">
                    <form method="post" action="{{route('addSubject')}}">
                        {{csrf_field()}}
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
                                <select class="form-control" name="course" id="course" autofocus>
                                    <option>Select Course</option>
                                </select>
                                @if ($errors->has('course'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('course') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                <input class="form-control" type="text" id="subject" name="subject">
                                @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Add Subject</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="table-responsive text-center col-sm-12">
                <table class="table table-borderless" id="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ID</th>
                            <th style="text-align: center;">SUBJECT</th>
                            <th style="text-align: center;">COURSE</th>
                            <th style="text-align: center;">SEMESTER</th>
                            <th style="text-align: center;">ACTION</th>
                        </tr>
                    </thead>
                    @foreach($subject as $data)
                    
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->subject}}</td>
                        <td>{{$data->course}}</td>
                        <td>{{$data->semester}}</td>
                        <td>
                            <a href="{{url('/editSubject',$data->id)}}" class="btn btn-warning"><i class="fa fa-edit"> Edit</i></a>
                            <a href="#" onclick="deleteInfo({{$data->id}})" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash"> Remove</i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <br>
<br>
<br>
<br>
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
    
    $(document).ready(function() {
$('#table').DataTable();
});
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
    $('#myDeleteModal').modal('hide');
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
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
@endpush
