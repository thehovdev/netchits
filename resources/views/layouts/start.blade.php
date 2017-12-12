@extends('start.init')

@section('content')


<section class="mainPage">

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
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="signup-password">
            </div>
            <button type="submit" class="btn btn-default" id="signup-submit-button">Sign Up</button>
    </div>

</section>


<section class="profilePage" hidden>
    User Profile
</section>


@endsection
