@extends('layouts.admin')

@section('content')
        <div id="page-wrapper">
                    @if (session('active_status'))
                        <div style="text-align: center;" class="alert alert-success">
                            {{ session('active_status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div style="text-align: center;" class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
            <div class="main-page login-page ">
                <h2 class="title1">Login</h2>
                <div class="widget-shadow">
                    <div class="login-body">
                        <form action="{{ route('userLogin') }}" method="post">
                        {{ csrf_field() }}
                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <input id="email" type="email" class="user" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>  

                         <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>  
                            <input id="password" type="password" name="password" class="lock" placeholder="Password" required="">
                             @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                            <div class="forgot-grid">
                                <label class="checkbox"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><i></i>Remember me</label>
                                <div class="forgot">
                                    <a href="{{ route('password.request') }}">forgot password?</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <input type="submit" name="Sign In" value="Sign In">
                            <div class="registration">
                                Don't have an account ?
                                <a class="" href="{{route('register')}}">
                                    Create an account
                                </a>
                            </div>
                        </form>
                        @if(Session::has('error'))
                            <div class="alert alert-warning" style="margin-bottom: 0px;">
                                
                                    <h4>{{Session::get('error')}}</h4>
                                    {{Session::forget('error')}}
                             </div>
                         @endif
                    </div>
                </div>
         
@endsection

