@extends('main.layouts.layout')

@section('content')
    <div class="search-results" id="top">
        <div class="search-container">
            <div class="search">
                <div class="search__top-row">
                    <div class="top-row__caption">Найти на сайте</div>
                    <a href="/" class="top-row__close"><img class="close__icon" src="./assets/images/icons/close.svg" alt=""></a>
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
        <div class="results"><a class="link" href="/" target="_blank">
                <h3 class="link__caption">Часть текста в котором <span>123</span> содержится поисковый запрос</h3>
                <div class="link__row">
                    <p class="row__link-text">Название страницы, где находится текст содержащий писковый запрос</p>
                    <svg class="row__icon" role="img">
                        <use xlink:href="./assets/images/svg-sprite.svg#shape-link"></use>
                    </svg>
                </div></a><a class="link" href="/" target="_blank">
                <h3 class="link__caption">В начале отображаются новости <span>123</span> затем отображаются страницы</h3>
                <div class="link__row">
                    <p class="row__link-text">Название страницы, где находится текст содержащий писковый запрос</p>
                    <svg class="row__icon" role="img">
                        <use xlink:href="./assets/images/svg-sprite.svg#shape-link"></use>
                    </svg>
                </div></a><a class="link" href="/" target="_blank">
                <h3 class="link__caption">Результаты сортируются по соответствию поисковому запросу <span>123</span></h3>
                <div class="link__row">
                    <p class="row__link-text">Название страницы, где находится текст содержащий писковый запрос</p>
                    <svg class="row__icon" role="img">
                        <use xlink:href="./assets/images/svg-sprite.svg#shape-link"></use>
                    </svg>
                </div></a>
            <div class="results__rul">Для уточнения поиска введите<span> более точную формулировку</span> или вы можете<a href=""> обратиться в поддержку</a></div>
        </div>
    </div>
@endsection