@extends('start.init')

@section('content')

@include('layouts.includes.navbar')

<div class="margin-top80"></div>

<div class="container superuser-container">
    <div class="row">
        <div class="col-sm-12">
            <h3>Total Users <span class="label label-success">{{ $allUsers->count() }}</span></h3>
            <div class="table-responsive">
                <table class="table table-users">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>E-mail</th>
                            <th>Hashtag</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach($allUsers as $singleUser)
                        @php $i++; @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <th>{{ $singleUser->id }}</th>
                            <td>{{ $singleUser->email }}</td>
                            <td>{{ $singleUser->hashtag }}</td>
                            <td>{{ $singleUser->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
