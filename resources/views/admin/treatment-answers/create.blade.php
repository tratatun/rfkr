@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.treatments')])
    <div class="treatments-reply">
        <h1 class="treatments-reply__caption">Обращение</h1>
        <h6 class="treatments-reply__subcaption">Ответ на обращение</h6>
        @include('admin.treatment-answers.treatment', ['treatment' => $treatment])
        <div class="treatments-reply__title">Ответ на обращение</div>
        @include('admin.treatment-answers.form', ['treatment' => $treatment, 'spam' => true])
    </div>
@endsection