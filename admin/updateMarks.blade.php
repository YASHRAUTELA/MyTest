@extends('layouts.admin')

@section('content')

<div id="page-wrapper" style="background-color: white;">
	<div class="main-page" >
		<div class="col_4">
					@if (session('update_failure'))
					<div class="row">
						<div class="col-md-8 col-md-offset-2  alert alert-danger">
							{{ session('update_failure') }}
						</div>	
					</div>
					@endif
			<a href="{{route('marks')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
			

			<div class="container" style="max-width: 800px; max-height: 520px; border: 1px solid #ccc; box-shadow: 10px 10px 10px #ccc;padding: 50px;">
			<h4 class="title" style="text-align: center;">Update Subject</h4>
				<form method="POST" action="{{route('updateSubject')}}">
				{{csrf_field()}}
					<div class="row">
						<div class="col-md-3">
							<label>ID</label>
						</div>
						<div class="col-md-9 ">
							<input type="text" name="id" class="form-control" value="{{$data->id}}" readonly="true">
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>STUDENT</label>
						</div>
						<div class="col-md-9 ">
							<div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
								<input type="hidden" id="student_id" name="student_id" value="{{$data->student_id}}">
								<input type="text" name="student" id="student" class="form-control" value="{{$data->name}}" readonly="true">
								@if ($errors->has('student_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('student_id') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>COURSE</label>
						</div>
						<div class="col-md-9 ">
							<div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
	                            <input type="hidden" name="course_id" id="course_id" value="{{$data->course_id}}">
	                            <input type="text" class="form-control" name="course" id="course" value="{{$data->course}}" readonly="true">
				                @if ($errors->has('course_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_id') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>SEMESTER</label>
						</div>
						<div class="col-md-9 ">
							<div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
		                        <input type="hidden" name="semester_id" class="form-control" id="semester_id" value="{{$data->semester_id}}">
		                        <input type="text" name="semester" class="form-control" id="semester" value="{{$data->semester}}" readonly="true">
				                @if ($errors->has('semester_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('semester_id') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>SUBJECT</label>
						</div>
						<div class="col-md-9 ">
							<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
								
		                        <input type="hidden" name="subject_id" class="form-control" id="subject_id" value="{{$data->subject_id}}">
		                        <input type="text" name="subject" class="form-control" id="subject" value="{{$data->subject}}" readonly="true">
				                @if ($errors->has('subject_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject_id') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>Marks Obtained</label>
						</div>
						<div class="col-md-3">
							<div class="form-group{{ $errors->has('marks_obtained') ? ' has-error' : '' }}">
	                        	<input type="number" min="0" class="form-control" name="marks_obtained" id="marks_obtained" value="{{$data->marks_obtained}}" placeholder="Enter Obtained Marks">
	                        	@if ($errors->has('marks_obtained'))
	                            	<span class="help-block">
	                               		<strong>{{ $errors->first('marks_obtained') }}</strong>
	                            	</span>
	                        	@endif
	                        </div>
						</div>

						<div class="col-md-3">
							<label>Total Marks</label>
						</div>
						<div class="col-md-3">
							<div class="form-group{{ $errors->has('total_marks') ? ' has-error' : '' }}">
	                        <input type="number" min="0" class="form-control" name="total_marks" id="total_marks" placeholder="Enter Total Marks" value="{{$data->total_marks}}">
		                        @if ($errors->has('total_marks'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('total_marks') }}</strong>
		                            </span>
		                        @endif
	                        </div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<button type="submit" class="btn btn-warning">Update</button>
						</div>
					</div>
				</form>
			</div>
				
		</div>
	</div>
</div>
@endsection

@push('script')

<script type="text/javascript">

</script>

@endpush
