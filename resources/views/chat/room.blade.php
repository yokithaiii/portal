@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            Комната с <a href="{{ route('users.show', $room['receiver']->id) }}">{{ $room['receiver']->name }}</a>
                        </div>
                        <a href="{{ route('chat.index') }}">Назад</a>
                    </div>
                    <div class="card-body">
                        <my-vue-component
                            :messages="{{ json_encode($messages) }}"
                            :room="{{ json_encode($room) }}"
                        ></my-vue-component>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
