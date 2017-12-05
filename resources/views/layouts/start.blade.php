@extends('start.init')

@section('content')
<section pageId="mainPage">

    <div class="container signin-container">
        <form>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="signin-email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="signin-password">
            </div>
            <!-- <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div> -->
            <button type="submit" class="btn btn-default" id="signin-submit-button">Sign In</button>
        </form>
    </div>

    <div class="container signup-container">
        <form>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="signup-email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="signup-password">
            </div>
            <!-- <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div> -->
            <button type="submit" class="btn btn-default" id="signup-submit-button">Sign Up</button>
        </form>
    </div>

</section>
@endsection
