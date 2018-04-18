@extends('admin.adminDefault')

@section('others')
<a href="{{route('smsStudent')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
			<h4 class="title" style="text-align: center;">Update Student</h4>
					@if (session('update_failure'))
					<div class="row">
						<div class="col-md-8 col-md-offset-2  alert alert-danger">
							{{ session('update_failure') }}
						</div>	
					</div>
					@endif

			
				<form method="POST" action="#">
				{{csrf_field()}}
					<div class="row">
						<div class="col-sm-2">
							<img src="{{asset('images/'.$data->image_title)}}" style="height: 100px; width: 80px;">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>ID</label>
						</div>
						<div class="col-sm-4">
							
								<input type="" class="form-control" id="id" name="id" readonly="true" value="{{$data->id}}" required>
								
						</div>
						<div class="col-sm-2">
							<label>Name</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<input class="form-control" type="text" id="name" name="name" value="{{$data->name}}" required>
								@if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Email</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<input class="form-control" type="email" id="email" name="email" value="{{$data->email}}" required>
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
						<div class="col-sm-2">
							<label>DOB</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
								<input class="form-control" type="date" id="date" name="date" value="" required>
								@if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Father Name</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
								<input class="form-control" type="text" id="father_name" name="father_name" value="{{$data->father_name}}" required>
								@if ($errors->has('father_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('father_name') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
						<div class="col-sm-2">
							<label>Mother Name</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}">
								<input class="form-control" type="text" id="mother_name" name="mother_name" value="{{$data->mother_name}}" required>
								@if ($errors->has('mother_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mother_name') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>City</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="" name="">
							</div>
						</div>
						<div class="col-sm-2">
							<label>State</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="" name="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Contact</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
								<input class="form-control" type="number" min="0" id="contact" name="contact" value="{{$data->contact}}" required>
								@if ($errors->has('contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
						<div class="col-sm-2">
							<label>Course</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="" name="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Registration Date</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('registration_date') ? ' has-error' : '' }}">
								<input class="form-control" type="date" id="registration_date" name="registration_date" value="{{$data->registration_date}}" required>
								@if ($errors->has('registration_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registration_date') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
						<div class="col-sm-2">
							<label>Session</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<input class="form-control" type="text" id="session" name="session" value="" required readonly="true">
								
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Pin</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }}">
								<input class="form-control" type="text" id="pin" name="pin" value="{{$data->pin}}" required>
								@if ($errors->has('pin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
						<div class="col-sm-2">
							
						</div>
						<div class="col-sm-4">
							
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<button type="submit" class="btn btn-warning">Update</button>
						</div>
					</div>
				</form>
@endsection

