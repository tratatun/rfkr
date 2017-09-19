@extends('main.layout')

@section('content')
    <div class="page-content">
        <div class="headers-container">
            @include('main.parts.search')
            @include('main.parts.topbar')
            @include('main.parts.topmenu')
        </div>
        <h1>{{ $news->title }}</h1>
        <br>
        <p>{{ $news->created_at->diffForHumans() }}</p>
        <br>
        {!! $news->text !!}
    </div>
@endsection