<title>NetChits</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
<script src="{{ asset('/js/app.js') }}"></script>

<nav class="navbar">
    <div class="container-fluid">


        <div class="navbar-header">
            <a class="navbar-brand" href="#">NetChits</a>
        </div>


        <ul class="nav navbar-nav">
            <!-- <li class="active"><a href="#">Home</a></li> -->
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user" id="header-username"></span></a></li>
            <li><a href="#signup" id="signup-button"><span class="glyphicon glyphicon-new-window"></span> Sign Up</a></li>
            <li><a href="#signin" id="signin-button"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
        </ul>


    </div>
</nav>
