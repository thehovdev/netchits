@extends('start.init')

@section('content')

<div class="parent">

    <!-- @include('layouts.includes.navbar') -->

    <section class="mainPage">

        <div class="col-sm-8 col-sm-offset-4">

            <div class="row">
                <div class="col-sm-12">
                        <a href="/" class="bname">
                            {{ config('app.name') }}
                        </a>

                    <div class="description">
                        Follow, Share, Listen with friends <br />
                        Coming Soon with changes
                    </div>

                    <div class="todo-list">
                        <div class="todo-item vcenter">
                            <i class="fa fa-fw fa-users fa-todo-icon fa-fw" aria-hidden="true"></i>
                            <span class="todo-description">Follow your friends</span>
                        </div>
                        <div class="todo-item vcenter">
                            <i class="fa fa-fw fa-newspaper-o fa-todo-icon fa-fw" aria-hidden="true"></i>
                            <span class="todo-description">Share Posts and Notes</span>
                        </div>
                        <div class="todo-item vcenter">
                            <i class="fa fa-fw fa-volume-up fa-todo-icon fa-fw" aria-hidden="true"></i>
                            <span class="todo-description">Listen favorite Music</span>
                        </div>
                        <div class="todo-item vcenter">
                            <i class="fa fa-fw fa-play-circle fa-todo-icon fa-fw" aria-hidden="true"></i>
                            <span class="todo-description">Create you Playlists</span>
                        </div>
                    </div>
                </div>






            </div>

        </div>

    </section>

    </div>

@endsection

<div class="author">
    &copy;NetChits @php echo date("Y"); @endphp
</div>
