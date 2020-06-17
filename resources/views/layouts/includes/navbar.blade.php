@section('navbar')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
	<div class="container">
	    <a class="navbar-brand" href="{{ url('/') }}">
		{{ config('app.name', 'Laravel') }}
	    </a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
		<span class="navbar-toggler-icon"></span>
	    </button>

	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<!-- Left Side Of Navbar -->
		<ul class="navbar-nav mr-auto">

		</ul>

		<!-- Right Side Of Navbar -->
		<ul class="navbar-nav ml-auto">
		    <!-- Authentication Links -->
		    @guest
		    <li class="nav-item">
			<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
		    </li>
		    @if (Route::has('register'))
			<li class="nav-item">
			    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
			</li>
		    @endif
        @else
		    <div class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2 friend-search" type="search" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0 search" type="submit"><i class="fas fa-search"></i></button>
		    </div>
		    <li class="nav-item dropdown">
			<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
			    {{ Auth::user()->name }} <span class="caret"></span>
			</a>

			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			    <a class="dropdown-item" href="{{ route('settings') }}">Settings</a>
			    <a class="dropdown-item" href="{{ route('logout') }}"
			       onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
				{{ __('Logout') }}
			    </a>

			    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			    </form>
			</div>
		    </li>
		    @endguest
		</ul>
	    </div>
	</div>
    </nav>
@show
<div class="progress" id="process-chits" style="display: none;">
    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
</div>
