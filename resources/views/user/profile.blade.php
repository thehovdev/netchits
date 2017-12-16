@extends('start.init')

@section('content')

    <section class="profilePage">

        <nav class="navbar">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="#">NetChits</a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li><a class="pointer"><span>{{ $username }}</span></a></li>
                    <li><a class="pointer" id="signout-button"><span>Sign Out</span></a></li>
                    <!-- <li><a id="signin-button" style="cursor:pointer;"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li> -->
                </ul>

            </div>
        </nav>

        User Profile
    </section>

@endsection
