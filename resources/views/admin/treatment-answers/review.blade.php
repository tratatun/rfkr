@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.treatments')])
    <div class="treatments-parsed">
        <h1 class="treatments-parsed__caption">Отвеченное обращение</h1>
        <h6 class="treatments-parsed__subcaption">Проверить ответ на обращение</h6>
        <div class="divider"></div>
        <div class="toogle">
            <div class="toogle__header"><a href="#treatments-text" data-role="toogle">Обращение</a></div>
            <div class="toogle__body" id="treatments-text">
                @include('admin.treatment-answers.treatment', ['treatment' => $treatment])
            </div>
        </div>
        <div class="divider"></div>
        <div class="toogle toogle_second">
            <div class="toogle__header"><a href="#treatments-reply-text" data-role="toogle">Ответ</a></div>
            <div class="toogle__body" id="treatments-reply-text">
                @foreach($treatment->answers as $answer)
                    @include('admin.treatment-answers.answer', ['answer' => $answer])
                @endforeach
                <div class="reply-again-text">Сформировать повторный ответ</div>
                @include('admin.treatment-answers.form', ['treatment' => $treatment])
            </div>
        </div>
        <div class="divider"></div>
@endsection