@extends('start.init')

@section('content')

<div class="parent">

    <section class="mainPage">

        <div class="col-sm-12">
            <div class="alpha-container">
                <div class="alpha-block">
                    <div class="brand-div">
                        <h1><span class="brand-name">NetChits</span></h1>
                    </div>
                    <div class="welcome-div">
                        <h1>
                            <span class="welcome-text">
                                @lang('main.startwelcome')
                            </span>
                        </h1>
                        <div class="form-group text-center" style="margin-top:5px;">
                            <label for="locale" class="text-center block lang-label">@lang('main.setlocale')</label>
                            <a href="/user/setlocale/en" class="btn btn-default btn-lang">EN</a>
                            <a href="/user/setlocale/ru" class="btn btn-default btn-lang">RU</a>
                            <a href="/user/setlocale/az" class="btn btn-default btn-lang">AZ</a>
                        </div>
                    </div>

                    <div class="actions">
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
                                        <div class="alpha-key pointer" id="signin-button">
                                            <span class="alpha-text">
                                                @lang('main.login')
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <div class="register pointer" id="signup-button">
                                            <span class="register-text">@lang('main.signup')</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="signin-container">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control enter-handle" id="signin-email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control enter-handle" id="signin-password">
                        </div>

                        <button type="submit" class="btn btn-default btn-start" id="signin-submit-button">Log In</button>
                        <button type="submit" class="btn btn-default btn-start back-submit-button">Back</button>
                        <button type="submit" class="btn btn-default btn-start" id="button-forgotpass">Forgot Password</button>

                        <div class="alert alert-danger alert-password-incorrect" style="display:none;">
                            <strong>Password is incorrect..
                            </div>
                        </div>
                    <div class="signup-container">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control enter-handle" id="signup-email">
                        </div>
                        <div class="form-group">
                            <label for="signup-hashtag">#hashtag:</label>
                            <input type="text" class="form-control enter-handle" id="signup-hashtag">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control enter-handle" id="signup-password">
                        </div>
                        <div class="checkbox" style="font-family:arial;font-size:0.9em;">
                            <label><input id="age" type="checkbox" value="">@lang('main.iam14')</label>
                        </div>

                        <div class="alert alert-danger alert-signup-error" style="display:none;">
                        </div>

                        <button type="submit" class="btn btn-default btn-start" id="signup-submit-button">Sign Up</button>
                        <button type="submit" class="btn btn-default btn-start back-submit-button">Back</button>
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
                </div>
            </div>

            <div style="display:block;height:100px;"></div>

        </div>

    </section>

    </div>

@endsection

<div class="author">
    &copy;NetChits |
    CEO & Founder - <a style="color:white;" href="https://www.facebook.com/thehovdev">Afgan Khalilov</a>
</div>
