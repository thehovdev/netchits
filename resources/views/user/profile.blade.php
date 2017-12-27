@extends('start.init')

@section('content')
    <page class="profilePage"></page>

    <section class="nav-container">
        <nav class="navbar">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="#">NetChits</a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li><a class="pointer"><span>{{ $user->email}}</span></a></li>
                    <li><a class="pointer" id="signout-button"><span>Sign Out</span></a></li>
                    <!-- <li><a id="signin-button" style="cursor:pointer;"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li> -->
                </ul>

            </div>
        </nav>
    </section>


    <section class="chits-container">

        <div class="container">

            <div class="row chits-add-row">
                <div class="col-lg-2 col-md-2 col-sm-2 chits-add-column">
                    <button type="button" class="btn btn-success" id="chits-add-button">Add New</button>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="form-group">
                      <input type="text" class="form-control" id="chits-address-input" placeholder="https://netchits.com">
                    </div>
                </div>

                <div class="chits-category">
                    <div class="col-lg-2 col-md-2 col-sm-2 chits-add-column">
                        <button type="button" class="btn btn-primary" id="chits-add-button">Add Category</button>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <div class="form-group">
                          <input type="text" class="form-control" id="chits-address-input" placeholder="https://netchits.com">
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel panel-default category-parent">
              <div class="panel-body">
                  <div class="category-block">Default Category</div>
              </div>
            </div>


            <div class="row chits-row">
                <div class="chits-list">
                    @include("user.chits.chits-list")
                </div>


                {{-- <div class="chits-list">
                    @foreach ($userChits as $userChit)
                        <div class="chits-column bg-primary col-lg-3 col-md-3 col-sm-3">
                                <a class="chits-child" href="{{ $userChit->address }}">{{ $userChit->address }}</a>
                        </div>
                    @endforeach
                </div> --}}

            </div>
        </div>
    </section>
@endsection
