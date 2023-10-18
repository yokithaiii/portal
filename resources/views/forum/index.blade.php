@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0;">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('forum.index') }}">perddit</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="">
                        <a href="{{ route('forum.create') }}" class="btn btn-primary">Новое обсуждение</a>
                    </div>

                    @foreach($forums as $forum)
                        <div class="card text-white bg-dark mt-3">
                            <div class="card-header">
                                Создан пользователем: {{ $forum->user->name }}
                            </div>
                            <div class="card-body">
                                <a class="text-white text-decoration-none" href="{{ route('forum.show', $forum->id) }}">
                                    <h5 class="card-title">{{ $forum->title }}</h5>
                                    <p class="card-text">{{ $forum->content }}</p>
                                    <div class="d-flex mt-3">
                                        <img class="rounded" src="/storage/{{ $forum->image }}" alt="" style="width: 100%;">
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
