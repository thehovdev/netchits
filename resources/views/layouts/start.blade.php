@extends('start.init')

@section('content')

<style>
    body {
        background: #E8E8E8;
    }
</style>

<div class="parent">

    <section class="mainPage">

        <!-- <nav class="navbar navbar-default navbar-fixed-top navbar-netchits">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="/">NetChits</a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li><a id="signup-button" style="cursor:pointer;"><span class="glyphicon glyphicon-new-window"></span> Sign Up</a></li>
                    <li><a id="signin-button" style="cursor:pointer;"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
                </ul>

            </div>
        </nav> -->


        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="alpha-container">

                        <div class="alpha-block">
                            <div class="brand-div">
                                <h1><span class="brand-name">NetChits</span></h1>
                            </div>
                            <div class="welcome-div">
                                <h1><span class="welcome-text">Welcome To Open Alpha</span></h1>
                            </div>

                            <div class="actions">
                                <div class="row">
                                    <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-md-offset-2">
                                                <div class="alpha-key pointer" id="signin-button">
                                                    <span class="alpha-text">
                                                        Log in
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-4">
                                                <div class="register pointer" id="signup-button">
                                                    <span class="register-text">Sign up</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            </div>
        </div>

        <div class="container signin-container">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="signin-email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="signin-password">
                </div>

                <button type="submit" class="btn btn-default" id="signin-submit-button">Log In</button>
                <button type="submit" class="btn btn-default back-submit-button">Back</button>

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
                <button type="submit" class="btn btn-default back-submit-button">Back</button>
        </div>



    </section>

</div>




@endsection
