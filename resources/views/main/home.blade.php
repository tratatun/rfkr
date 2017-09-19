@extends('main.layout')

@section('content')
    <div class="headers-container">
        @include('main.parts.search')
        @include('main.parts.topbar')
        @include('main.parts.topmenu')
    </div>
    <section class="main-block" id="top">
        @include('main.parts.covers')
        <div class="main-block__carousel-arrows">
            <div class="carousel-arrow carousel-arrow_prev">
                <svg class="carousel-arrow_default" role="img">
                    <use xlink:href="{{ asset('assets/images/svg-sprite.svg#shape-arrow-carousel') }}"></use>
                </svg>
                <svg class="carousel-arrow_hover" role="img">
                    <use xlink:href="{{ asset('assets/images/svg-sprite.svg#shape-arrow-carousel-blue') }}"></use>
                </svg>
            </div>
            <div class="carousel-arrow carousel-arrow_next">
                <svg class="carousel-arrow_default" role="img">
                    <use xlink:href="{{ asset('assets/images/svg-sprite.svg#shape-arrow-carousel') }}"></use>
                </svg>
                <svg class="carousel-arrow_hover" role="img">
                    <use xlink:href="{{ asset('assets/images/svg-sprite.svg#shape-arrow-carousel-blue') }}"></use>
                </svg>
            </div>
        </div>
    </section>
    <section class="news-block">
        @include('main.parts.sliders')
        <div class="news-block__scroll">
            <div class="news-container">
                <div class="news">
                    <h3 class="news__caption">Присоединение к ЕИРЦ</h3>
                    <p class="news__description">НО РФ КРМД РК присоединился к системе <a href="/">ЕИРЦ</a>. Появилась
                        возможность контроля платежей с помощью <a href="/">Личного Кабинета</a></p>
                </div>
                <div class="news">
                    <h3 class="news__caption">Эффективная деятельность органов власти</h3>
                    <p class="news__description">С 21 августа 2017 года вы можете ознакоминтся с <a href="/">результатами
                            опроса</a>. Эффективная деятельность органов власти на <a href="/">Портале Правительства
                            Республики Крым</a></p>
                </div>
                <div class="news">
                    <h3 class="news__caption">Оплаты взносов через РНКБ</h3>
                    <p class="news__description">Во всех отделениях РНКБ банка вы можете совершить платеж по минимальным
                        тарифам комисcии. Полные условия на сайте РНКБ. Присутсвует сервис <a href="/">онлайн оплат</a></p>
                </div>
                <div class="news">
                    <h3 class="news__caption">Эффективная деятельность органов власти</h3>
                    <p class="news__description">С 21 августа 2017 года вы можете ознакоминтся с <a href="/">результатами
                            опроса</a>. Эффективная деятельность органов власти на <a href="/">Портале Правительства
                            Республики Крым</a></p>
                </div>
                <div class="news">
                    <h3 class="news__caption">Присоединение к ЕИРЦ</h3>
                    <p class="news__description">НО РФ КРМД РК присоединился к системе <a href="/">ЕИРЦ</a>. Появилась
                        возможность контроля платежей с помощью <a href="/">Личного Кабинета</a></p>
                </div>
                <div class="news">
                    <h3 class="news__caption">Эффективная деятельность органов власти</h3>
                    <p class="news__description">С 21 августа 2017 года вы можете ознакоминтся с <a href="/">результатами
                            опроса</a>. Эффективная деятельность органов власти на <a href="/">Портале Правительства
                            Республики Крым</a></p>
                </div>
                <div class="news">
                    <h3 class="news__caption">Оплаты взносов через РНКБ</h3>
                    <p class="news__description">Во всех отделениях РНКБ банка вы можете совершить платеж по минимальным
                        тарифам комисcии. Полные условия на сайте РНКБ. Присутсвует сервис <a href="/">онлайн оплат</a></p>
                </div>
                <div class="news">
                    <h3 class="news__caption">Эффективная деятельность органов власти</h3>
                    <p class="news__description">С 21 августа 2017 года вы можете ознакоминтся с <a href="/">результатами
                            опроса</a>. Эффективная деятельность органов власти на <a href="/">Портале Правительства
                            Республики Крым</a></p>
                </div>
                <div class="news">
                    <h3 class="news__caption">Оплаты взносов через РНКБ</h3>
                    <p class="news__description">Во всех отделениях РНКБ банка вы можете совершить платеж по минимальным
                        тарифам комисcии. Полные условия на сайте РНКБ. Присутсвует сервис <a href="/">онлайн оплат</a></p>
                </div>
                <div class="news">
                    <h3 class="news__caption">Эффективная деятельность органов власти</h3>
                    <p class="news__description">С 21 августа 2017 года вы можете ознакоминтся с <a href="/">результатами
                            опроса</a>. Эффективная деятельность органов власти на <a href="/">Портале Правительства
                            Республики Крым</a></p>
                </div>
            </div>
        </div>
    </section>
    @include('main.parts.news')
    @include('main.parts.gov-resources')
@endsection