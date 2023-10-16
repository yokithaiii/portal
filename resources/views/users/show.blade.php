@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Users inside</div>
                    <div class="card-body">
                        <div class="d-flex flex-md-column align-items-center">
                            <div class="mb-3 text-dark">
                                <img style="width: 18rem; height: 18rem;" class="rounded-circle mx-auto d-block" src="/storage/{{ $user->photo }}" alt="">
                            </div>
                            <div class="mb-2 text-dark">
                                <h3>
                                    {{ $user->name }}
                                </h3>
                            </div>
                            <div class="mb-2 text-dark">
                                <span>
                                    {{ $user->email }}
                                </span>
                            </div>
                            @if($user->id != auth()->id())
                                <div class="mb-2 text-dark">
                                    <a href="{{ route('users.store', $user->id) }}" class="btn btn-primary">Подписаться</a>
                                    <a href="{{ route('chat.create', $user->id) }}" class="btn btn-primary" style="margin-left: 5px;">Написать сообщение</a>
                                </div>
                                <div class="mb-2 text-dark">
                                    <a href="{{ route('users.index') }}" class="btn btn-danger">Назад</a>
                                </div>
                            @else
                                <div class="mb-2 text-dark">
                                    <span class="text-info">Это вы</span>
                                </div>
                                <div class="mb-2 text-dark">
                                    <a href="{{ route('users.index') }}" class="btn btn-danger">Назад</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
