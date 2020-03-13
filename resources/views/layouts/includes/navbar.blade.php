<section class="nav-container">
    <nav class="navbar navbar-default navbar-fixed-top navbar-netchits">
        <div class="container-fluid">

            <div class="navbar-header">
                <a class="navbar-brand" href="/">NetChits</a>
            </div>

            <ul class="nav navbar-nav navbar-right first-navbar-ul">
                @if(!is_null(@$user))
                    <li>
                        <a class="pointer" href="/user/{{ $user->id }}" target="_blank">
                            <img src="/storage/user-profile-images/{{ $user->image_id }}" class="img-circle" width="30px" height="30px"/>
                        </a>
                    </li>
                    <li>
                        <a class="pointer" href="/user/{{ $user->id }}" target="_blank">
                            <span>{{ @$user->email}}</span>
                        </a>
                    </li>

                    <li>
			<a class="pointer" id="signout-button">
                            <span>@lang('main.signout')</span>
			</a>
                    </li>
                @else
                    <li>
			<a class="pointer" id="signin-button" data-option="noauth">
                            <span>@lang('main.login')</span>
			</a>
                    </li>
                    <li>
			<a class="pointer" id="signout-button">
                            <span>@lang('main.signup')</span>
			</a>
                    </li>
                @endif
            </ul>

            <div class="input-group navbar-search">
                <input type="text" class="form-control" placeholder="follow by typing #hovdev" id="input-navbar-search">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
			<i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
            @if(!is_null(@$user))
                <a class="pointer hidden-user-image" href="/user/{{ $user->id }}" target="_blank">
                    <img src="/storage/user-profile-images/{{ $user->image_id }}" class="img-circle" width="30px" height="30px"/>
                </a>
            @endif
        </div>
    </nav>
</section>
