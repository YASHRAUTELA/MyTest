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
					@foreach($data as $faculty)
					<div class="row">
						<div class="col-md-1 col-sm-1">{{$faculty->id}}</div>
						<div class="col-md-2 col-sm-3">{{$faculty->name}}</div>
						<div class="col-md-3 col-sm-5">{{$faculty->email}}</div>
						<div class="col-md-2 col-sm-3">{{$faculty->dob}}</div>
						<div class="col-md-4 col-sm-3">
							<a href="#" class="btn btn-success">Show</a>
							<a href="#" class="btn btn-warning">Update</a>
							<a href="#" class="btn btn-danger">Remove</a>
						</div>
					</div>
					@endforeach

@endsection
