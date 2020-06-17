@php
$user = auth()->user();
@endphp
<div class="user-sidebar-parent">
    <nav class="nav-user-sidebar">

	<a href="/user/{{ $user->id }}" target="_blank">
	    <div class="user-sidebar-image">
		<img src="{{ asset('images/' . $user->profile_picture) }}" class="image img-responsive rounded pointer" width="100" height="100" />
		<span class="user-sidebar-hashtag">{{ $user->hashtag }}</span>
	    </div>
	</a>
	<ul class="nav">
	    <li class="nav-divider"></li>
	    <li>
		<a href="/">Playlist</a>
	    </li>
	    <li>
		<a href="/">Notes</a>
	    </li>
	    <li class="nav-divider"></li>
	    <li>
		<a href="{{ route('user', $user->id) }}" target="_blank" class="pointer">
		    @lang('main.ifollow')
		    <span class="follow-count">{{ $user->followings()->count() }}</span>
		</a>
	    </li>
	    <li>
		<a href="{{ route('user', $user->id) }}" target="_blank" class="pointer">
		    @lang('main.followers')
		    <span class="follow-count">{{ $user->followers()->count() }}</span>
		</a>
	    </li>
	    <li class="nav-divider"></li>
	    @foreach($user->followings as $following)
	    <li>
		<a href="{{ route('user', $following->id) }}" target="_blank">
		    <img src="{{ asset('images/' . $following->profile_picture) }}" class="img-circle" width="30px" height="30px"/>
		    <span class="user-sidebar-hashtag">{{ $following->hashtag }}</span>
		</a>
	    </li>
	    @endforeach
	</ul>
    </nav>
</div>
