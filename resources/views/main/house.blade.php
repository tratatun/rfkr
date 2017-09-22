@extends('main.layout')

@section('title')
    Найти дом
@endsection

@section('content')
    <div class="page-content">
        <div class="headers-container">
            @include('main.parts.search')
            @include('main.parts.topbar')
            @include('main.parts.topmenu')
        </div>
        <iframe src="http://cr.ro.eisgkh.ru/regprogframe/fkr91/index.htm" frameborder="0" width="100%" height="600px"></iframe>
    </div>
@endsection