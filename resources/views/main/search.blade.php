@extends('main.layout')

@section('content')
    <div class="search-results" id="top">
        <div class="search-container">
            <div class="search">
                <div class="search__top-row">
                    <div class="top-row__caption">Найти на сайте</div>
                    <a href="/" class="top-row__close"><img class="close__icon" src="/assets/images/icons/close.svg" alt=""></a>
                </div>
                <div class="search__bottom-row">
                    <form action="/search" method="get">
                        <div class="bottom-row__left-col">
                            <label class="left-col__search-label" for="search">Введите запрос для поиска</label>
                            <input class="left-col__search-field" type="text" id="search" name="query" value="{{request('query')}}">
                        </div>
                        <div class="bottom-row__right-col">
                            <button type="submit" class="right-col__search-btn">найти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="results">
            @foreach ($pages as $page)
                <a class="link" href="{{ $page->url() }}" target="_blank">
                    <h3 class="link__caption">{{ $page->searchText() }}</h3>
                    <div class="link__row">
                        <p class="row__link-text">{{ $page->title }}</p>
                        <svg class="row__icon" role="img">
                            <use xlink:href="/assets/images/svg-sprite.svg#shape-link"></use>
                        </svg>
                    </div>
                </a>
            @endforeach
            @foreach ($news as $newsOne)
                <a class="link" href="{{ $newsOne->url() }}" target="_blank">
                    <h3 class="link__caption">{{ $newsOne->searchText() }}</h3>
                    <div class="link__row">
                        <p class="row__link-text">{{ $newsOne->title }}</p>
                        <svg class="row__icon" role="img">
                            <use xlink:href="/assets/images/svg-sprite.svg#shape-link"></use>
                        </svg>
                    </div>
                </a>
            @endforeach
            <div class="results__rul">Для уточнения поиска введите<span> более точную формулировку</span> или вы можете<a href=""> обратиться в поддержку</a></div>
        </div>
    </div>
@endsection