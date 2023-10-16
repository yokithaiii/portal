@extends('layouts.app')

@section('content')
    <div class="row">
        <a href="{{ route('post.create') }}" class="btn btn-success">Создать новый пост</a>
    </div>
    <div class="mt-3">
        <div class="row row-cols-1">
            @foreach($posts->sortByDesc('created_at') as $post)
                <div class="col card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center" style="gap: 10px;">
                                <img src="/storage/{{ $post->user->photo }}" alt="mdo" width="40" height="40" class="rounded-circle">
                                <a href="{{ route('users.index') }}/{{ $post->user->id }}" class="text-primary text-decoration-none">{{ $post->user->name }}</a>
                            </div>
                            <div>
                                <small class="text-muted">{{ $post->created_at->format('H:i d.m.y') }}</small>
                            </div>
                        </div>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <div class="d-flex mb-3">
                            <img class="rounded" src="/storage/{{ $post->image }}" alt="" style="width: 100%;">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
