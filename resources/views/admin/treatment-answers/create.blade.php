@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.treatments')])
    <div class="treatments-reply">
        <h1 class="treatments-reply__caption">Обращение</h1>
        <h6 class="treatments-reply__subcaption">Ответ на обращение</h6>
        @include('admin.treatment-answers.treatment', ['treatment' => $treatment])
        <div class="treatments-reply__title">Ответ на обращение</div>
        <textarea name="editor" id="editor"></textarea>
        <div class="divider"></div>
        <div class="button-container">
            <button class="btn-spam">Спам</button>
            <button class="btn-reply">Ответить</button>
        </div>
    </div>
@endsection