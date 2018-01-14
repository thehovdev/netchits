<section class="nav-container">
    <nav class="navbar">
        <div class="container-fluid">

            <div class="navbar-header">
                <a class="navbar-brand" href="#">NetChits</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li><a class="pointer" href="/user/{{ $user->id }}"><span>{{ $user->email}}</span></a></li>
                <li><a class="pointer" id="signout-button"><span>Sign Out</span></a></li>
                <!-- <li><a id="signin-button" style="cursor:pointer;"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li> -->
            </ul>

        </div>
    </nav>
</section>
