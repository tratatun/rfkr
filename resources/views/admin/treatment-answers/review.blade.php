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
                <div class="text-container">Даже если учесть разреженный газ, заполняющий пространство между звездами, то все равно солнечное затмение однократно. Южный Треугольник, и это следует подчеркнуть, изменяем.<a class="text-container__link-attach" href="">Приложенный_файл.doc</a>Ионный хвост, сублимиpуя с повеpхности ядpа кометы, сложен. Тукан ничтожно притягивает непреложный популяционный индекс.<a class="text-container__link" href="">Ссылка на сторонний ресурс</a></div>
                <div class="reply-again-text">Сформировать повторный ответ</div>
                <textarea name="editor" id="editor"></textarea>
            </div>
        </div>
        <div class="divider"></div>
        <div class="button-container">
            <btn class="btn-reset">Отменить</btn>
            <btn class="btn-reply">Ответить</btn>
        </div>
    </div>
@endsection