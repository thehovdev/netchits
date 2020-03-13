@extends('layouts.app')
@section('navbar')
@show
@section('content')
    <div class="container">
	<section class="mainPage">
            <div class="col-sm-12">
		<div class="row">
                    <div class="col-sm-6">
                        <a href="/" class="bname">
                            {{ config('app.name') }}
                        </a>
			<div class="description">Follow, Share, Listen with friends</div>
			<button class="button-trydemo trydemo btn btn-default">
                            Continue
			</button>
			<div class="todo-list">
                            <div class="todo-item vcenter">
				<i class="fa fa-fw fa-users fa-todo-icon fa-fw" aria-hidden="true"></i>
				<span class="todo-description">Follow your friends</span>
                            </div>
                            <div class="todo-item vcenter">
				<i class="fa fa-fw fa-newspaper-o fa-todo-icon fa-fw" aria-hidden="true"></i>
				<span class="todo-description">Share Posts and Notes</span>
                            </div>
                            <div class="todo-item vcenter">
				<i class="fa fa-fw fa-volume-up fa-todo-icon fa-fw" aria-hidden="true"></i>
				<span class="todo-description">Listen favorite Music</span>
                            </div>
                            <div class="todo-item vcenter">
				<i class="fa fa-fw fa-play-circle fa-todo-icon fa-fw" aria-hidden="true"></i>
				<span class="todo-description">Create you Playlists</span>
                            </div>
			</div>
                    </div>
                    <div class="col-sm-4 col-sm-offset-2">
			<div class="oneclick-signup-container">
                            <h1>Use without signup</h1>
                            <button class="button-trydemo trydemo-min btn btn-default">
				Continue
                            </button>
			</div>
			<div class="signin-container">
                            <h1>Log in</h1>
                            <div class="form-group">
				<input type="email" class="form-control enter-handle" id="signin-email" placeholder="e-mail">
                            </div>
                            <div class="form-group">
				<input type="password" class="form-control enter-handle" id="signin-password" placeholder="password">
                            </div>
                            <button type="submit" class="btn btn-default btn-start" id="signin-submit-button">Log in</button>
                            <button type="submit" class="btn btn-default btn-start" id="button-forgotpass">Forgot Password</button>
                            <div class="alert alert-danger alert-password-incorrect" style="display:none;">
				<strong>Password is incorrect..
                            </div>
                        </div>
			<div class="forgotpass-container" style="display:none;">
                            <div class="form-group form-sendcode">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" id="forgotpass-email">
                            </div>
                            <button style="display:none;" type="submit" class="btn btn-default" id="button-sendcode">
				Send Code
                            </button>
                            <div class="form-resetpass" style="display:none;">
				<div class="form-group">
                                    <label for="pwd">Insert Code</label>
                                    <input type="password" class="form-control" id="forgotpass-code">
				</div>
				<div class="form-group">
                                    <label for="pwd">New Password</label>
                                    <input type="password" class="form-control" id="forgotpass-newpass">
				</div>
				<div class="form-group">
                                    <label for="pwd">Retry Password</label>
                                    <input type="password" class="form-control" id="forgotpass-repass">
				</div>
                            </div>

                            <button style="display:none;" type="submit" class="btn btn-default" id="button-resetpass">Reset Pass</button>


                            <div class="alert alert-success resetpass-success" style="display:none;margin-top:10px;">
				<strong>Success!</strong> Password Changed, Login to your Account
                            </div>
                            <div class="alert alert-danger resetpass-error" style="display:none;margin-top:10px;">
				<strong>Success!</strong> Password Changed, Login to your Account
                            </div>

			</div>
			<div class="signup-container">
                            <h1>Sign Up</h1>
                            <form method="POST" action="{{ route('register') }}">
				@csrf

				<div class="form-group row">
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" autofocus>

						   @error('name')
						   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
				</div>

				<div class="form-group row">
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail" required autocomplete="email">

						   @error('email')
						   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
				</div>

				<div class="form-group row">
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

						   @error('password')
						   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
				</div>

				<div class="form-group row">
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
				    </div>
				</div>

				<div class="form-group row mb-0">
				    <div class="col-md-6 offset-md-2">
					<button type="submit" class="btn btn-default btn-start" id="signup-submit-button">@lang('main.signup')</button>
				    </div>
				</div>
			    </form>
			</div>
		    </div>
		</div>
	</section>
    </div>
@endsection
