@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            {{ $forum->title }}
                        </div>
                        <a href="{{ route('forum.index') }}">Назад</a>
                    </div>
                    <div class="card-body">
                        <div class="pt-3 pe-3 perfect-scrollbar ps ps--active-y" data-mdb-perfect-scrollbar="true" style="position: relative;">
                            <div class="card">
                                <div class="card-body" style="padding-bottom: 0;">
                                    {{ $forum->content }}
                                </div>
                                <hr>
                                <div class="card-body" style="padding-top: 0;">
                                    <form action="{{ route('forum.comment') }}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Комментарий</label>
                                            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary">Отправить</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="card-body" style="padding-top: 0;">
                                    @foreach($comments as $comment)
                                        <div class="mb-3 rounded-3" style="background-color: rgb(241, 241, 241); padding: 10px;">
                                            <div class="d-flex flex-row justify-content-start align-items-center">
                                                <img class="rounded-circle" src="/storage/{{ $comment['user']->photo }}" alt="avatar 1" style="width: 45px; height: 45px">
                                                <a
                                                    class="text-decoration-none"
                                                    href="{{ route('users.show', $comment['user']->id) }}"
                                                    style="margin-left: 10px;">
                                                    {{ $comment['user']->name }}
                                                </a>
                                            </div>
                                            <div style="margin-left: 55px;">
                                                {{ $comment->comment }}
                                            </div>
                                            <div class="d-flex justify-content-end small">
                                                <span class="text-muted">
                                                    {{ $comment->time }}
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <a class="" data-bs-toggle="collapse" href="#collapseExample-{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    Ответить
                                                </a>
                                                <div class="collapse" id="collapseExample-{{ $comment->id }}">
                                                    <form action="{{ route('forum.reply') }}" method="post"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                        <div class="mb-3">
                                                            <input class="form-control" type="text" name="comment" placeholder="Ответить" id="exampleFormControlTextarea2">
                                                        </div>
                                                        <div class="mt-3">
                                                            <button type="submit" class="btn btn-primary">Отправить</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            @if($comment->replys)
                                                @foreach($comment->replys as $reply)
                                                    <div clas="reply-inner" style="margin-left: 10px; border-left: 1px solid #ccced0; padding: 10px;">
                                                        <div class="d-flex flex-row justify-content-start align-items-center">
                                                            <img class="rounded-circle" src="/storage/{{ $reply['user']->photo }}" alt="avatar 1" style="width: 45px; height: 45px">
                                                            <a
                                                                class="text-decoration-none"
                                                                href="{{ route('users.show', $reply['user']->id) }}"
                                                                style="margin-left: 10px;">
                                                                {{ $reply['user']->name }}
                                                            </a>
                                                        </div>
                                                        <div style="margin-left: 55px;">
                                                            {{ $reply->comment }}
                                                        </div>
                                                        <div class="d-flex justify-content-end small">
                                                        <span class="text-muted">
                                                            {{ $reply->time }}
                                                        </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
