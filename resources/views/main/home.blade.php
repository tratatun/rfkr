@extends('main.layout')

@section('content')
    <div class="headers-container">
        @include('main.parts.search')
        @include('main.parts.topbar')
        @include('main.parts.topmenu')
    </div>
    <section class="main-block" id="top">
        @include('main.parts.covers')
    </section>
    <section class="news-block">
        @include('main.parts.sliders')
        @include('main.parts.seo-records')
    </section>
    @include('main.parts.news')
    @include('main.parts.gov-resources')
@endsection