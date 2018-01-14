@extends('start.init')

@section('content')
<div class="parent">

    <section class="mainPage">

        <nav class="navbar navbar-default navbar-fixed-top navbar-netchits">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="/">NetChits</a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li><a id="signup-button" style="cursor:pointer;"><span class="glyphicon glyphicon-new-window"></span> Sign Up</a></li>
                    <li><a id="signin-button" style="cursor:pointer;"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
                </ul>

            </div>
        </nav>



        <!-- <nav class="navbar">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="#">NetChits</a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li><a id="signup-button" style="cursor:pointer;"><span class="glyphicon glyphicon-new-window"></span> Sign Up</a></li>
                    <li><a id="signin-button" style="cursor:pointer;"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
                </ul>

            </div>
        </nav> -->

        <div class="container signin-container">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="signin-email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="signin-password">
                </div>

                <button type="submit" class="btn btn-default" id="signin-submit-button">Sign In</button>
        </div>

        <div class="container signup-container">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="signup-email">
                </div>
                <div class="form-group">
                    <label for="signup-hashtag">#hashtag:</label>
                    <input type="text" class="form-control" id="signup-hashtag">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="signup-password">
                </div>
                <button type="submit" class="btn btn-default" id="signup-submit-button">Sign Up</button>
        </div>

    </section>

</div>

@endsection
