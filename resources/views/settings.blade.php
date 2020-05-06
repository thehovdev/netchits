@extends('layouts.app')
@section('content')
    <div class="container">
	<div class="col-sm-10 offset-sm-2">
		<div class="row row-user-profile">
		    @if (session()->has('message'))
		    <div class="container">
			<div class="alert alert-success">
			    {{ session('message') }}
			</div>
		    </div>
		    @endif
		    <div class="col-sm-12 col-user-profile-image">
			<div class="div-user-image">
			    <img src="{{ asset('images/' . $user->profile_picture) }}" class="user-image img-circle btn-upload-img pointer" id="btn-upload-img" data-toggle="tooltip" title="@lang('main.updatephoto')"/>
				      </div>
				      </div>
				      <div class="col-sm-12">
			    <div class="div-upload-image">
				<!-- hidden form -->
				<form name="uploader" action="{{ route('update.picture') }}" enctype="multipart/form-data" method="post" hidden>
				    @csrf
				    <input type="file" name="image" id="upload-me">
				    <input type="submit" id="upload-picture" value="Send">
				</form>
			    </div>
			    <div class="div-user-info">
				@if(!Str::contains($user->hashtag, 'guest'))
				    <form name="update-info" action="{{ route('update.settings') }}" method="post">
					@csrf
					
					<!-- name -->
					<div class="form-group">
					    <label for="name" class="text-center block">Name</label>
					    <input type="text" name="name" class="form-control enter-handle" value="{{ $user->name }}">
					    
					    <!-- hashtag -->
					    <div class="form-group">
						<label for="hashtag" class="text-center block">#hashtag</label>
						<input type="text" name="hashtag" class="form-control enter-handle" value="{{ $user->hashtag ?? '' }}">
					    </div>
					    <!-- email -->
					    <div class="form-group">
						<label for="email" class="text-center block">E-Mail</label>
						<input type="text" name="email" class="form-control enter-handle" value="{{ $user->email }}">
					    </div>
					    <!-- password -->
					    <div class="form-group">
						<label for="password" class="text-center block">Current Password</label>
						<input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror enter-handle" placeholder="Current password">
							     @error('current_password')
							     <span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
                                </span>
                                @enderror
					    </div>
					    <div class="form-group">
						<label for="password" class="text-center block">New Password</label>
						<input type="password" name="password" class="form-control @error('password') is-invalid @enderror enter-handle" placeholder="New password">
							     @error('password')
							     <span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
							     </span>
							     @enderror
					    </div>
					    <div class="form-group">
						<label for="password" class="text-center block">Confirm New Password</label>
						<input type="password" name="password_confirmation" class="form-control enter-handle" placeholder="Confirm password">
					    </div>


					    <button class="btn btn-primary button-update-profile">@lang('main.updateinfo')</button>

				    </form>
				@else
				    <div class="container mt-5">
					<ul class="list-group">
					    <li class="list-group-item">{{ $user->name }}</li>
					    <li class="list-group-item">{{ $user->email }}</li>
					    <li class="list-group-item">{{ $user->hashtag }}</li>
					</ul>
				    </div>
				@endif
				<div class="form-group text-center mt-5">
					<label for="locale" class="text-center block">@lang('main.setlocale')</label>
					    <a href="{{ route('locale', 'en') }}" class="btn btn-outline-primary">EN</a>
					    <a href="{{ route('locale', 'ru') }}" class="btn btn-outline-primary">RU</a>
					    <a href="{{ route('locale', 'az') }}" class="btn btn-outline-primary">AZ</a>
				</div>
					</div>
			    </div>
			</div>

		    </div>
@endsection
