@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="card-header" style="padding-bottom: 0;">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('users.index') }}">Пользователи</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.subs') }}">Подписки</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills flex-column mb-auto">
                        @foreach($users as $user)
                            @if($user->id != Auth::user()->id)
                                <li class="nav-item mb-4">
                                    <a href="{{ route('users.show', $user->id) }}" class="text-primary text-decoration-none d-flex align-items-center" style="gap: 10px;">
                                        <img src="/storage/{{ $user->photo }}" alt="mdo" width="60" height="60" class="rounded-circle">
                                        {{ $user->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
