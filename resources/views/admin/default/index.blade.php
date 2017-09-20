@extends('admin.layout')

@section('content')
    @include('admin.parts.menu')
    <div class="admin-pages">
        <h1 class="admin-pages__caption">Страницы</h1>
        <h6 class="admin-pages__subcaption">Управление разделами и страницами веб-системы</h6>
        <div class="divider"></div>
        <div class="toogle">
            <div class="toogle__header"><a href="#admin-main-page" data-role="toogle">Главная страница</a></div>
            <div class="toogle__body" id="admin-main-page">
                @include('admin.default.covers-section')
                @include('admin.default.sliders-section')
                @include('admin.default.seo-records-section')
                @include('admin.default.news-section')
                @include('admin.default.gov-resources-section')
            </div>
        </div>
        @foreach ($sections as $section)
            @include('admin.default.pages-section', ['section' => $section, 'index' => $loop->index])
        @endforeach
        <div class="divider"></div>
        <a href="{{ route('admin.pages.create') }}" class="btn-add-section">Добавить раздел</a>
    </div>
@endsection