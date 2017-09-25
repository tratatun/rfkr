@extends('main.layout')

@section('content')
    <div id="top" class="page-content">
        <div class="headers-container">
            @include('main.parts.search')
            @include('main.parts.topbar')
            @include('main.parts.topmenu')
        </div>
        <h1>{{ $page->title }}</h1>
        <br>
        {!! $page->text !!}
    </div>
@endsection