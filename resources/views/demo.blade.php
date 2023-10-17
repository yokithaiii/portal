@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Просмотр API</div>

                    <div class="card-body">
                        <div class="list-group">
                            <a href="/api/users" class="list-group-item list-group-item-action">Users</a>
                            <a href="/api/users/3" class="list-group-item list-group-item-action">User/3</a>
                            <a href="/api/posts" class="list-group-item list-group-item-action">Posts</a>
                            <a href="/api/posts/4" class="list-group-item list-group-item-action">Post/4</a>
                            <a href="/api/forums" class="list-group-item list-group-item-action">Forums</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
