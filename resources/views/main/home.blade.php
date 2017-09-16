@extends('main.layout')

@section('content')
    <div class="headers-container">
        @include('main.parts.search')
        @include('main.parts.topbar')
        @include('main.parts.topmenu')
    </div>
    <section class="main-block" id="top">
        <div class="main-block__carousel">
            <div class="carousel__slide">
                <div class="slide__image" style="background-image: url(/assets/images/main-carousel/slide-01.jpg);"></div>
                <div class="slide__info-wrapper">
                    <div class="slide__info">
                        <h3 class="info__caption">Программа капитального ремонта</h3>
                        <div class="info__description">Вы можете узнать, участвует ли Ваш дом в программе капитального
                            ремонта<br>Проверить начисления<br>Узнать сроки и направления капитального ремонта
                        </div>
                        <a class="info__link" href="/">найти дом</a>
                    </div>
                </div>
            </div>
            <div class="carousel__slide">
                <div class="slide__image" style="background-image: url(/assets/images/main-carousel/slide-02.jpg);"></div>
                <div class="slide__info-wrapper">
                    <div class="slide__info">
                        <h3 class="info__caption">Программа капитального ремонта</h3>
                        <div class="info__description">Вы можете узнать, участвует ли Ваш дом в программе капитального
                            ремонта<br>Проверить начисления<br>Узнать сроки и направления капитального ремонта
                        </div>
                        <a class="info__link" href="/">найти дом</a>
                    </div>
                </div>
            </div>
        </div>
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
        <div class="news-block__carousel">
            <div class="carousel-news-image">
                <div class="carousel__slide">
                    <div class="slide__img" style="background-image: url(/assets/images/news/new-01.jpg);"></div>
                </div>
                <div class="carousel__slide">
                    <div class="slide__img" style="background-image: url(/assets/images/news/new-01.jpg);"></div>
                </div>
                <div class="carousel__slide">
                    <div class="slide__img" style="background-image: url(/assets/images/news/new-01.jpg);"></div>
                </div>
                <div class="carousel__slide">
                    <div class="slide__img" style="background-image: url(/assets/images/news/new-01.jpg);"></div>
                </div>
            </div>
            <div class="carousel-news">
                <div class="carousel-slide">
                    <h3 class="carousel-slide__caption">Завершен ремонт фасада строений по улице пр. Кирова</h3>
                    <div class="carousel-slide__description"><span class="description__text">Если для простоты пренебречь потерями на теплопроводность, то видно, что темная материя едва ли квантуема. Вселенная заряжает внутримолекулярный газ, в итоге возможно появление обратной связи и самовозбуждение системы.</span><a
                                class="description__link">Подробнее</a></div>
                </div>
                <div class="carousel-slide">
                    <h3 class="carousel-slide__caption">Завершен ремонт фасада строений по улице пр. Кирова</h3>
                    <div class="carousel-slide__description"><span class="description__text">Если для простоты пренебречь потерями на теплопроводность, то видно, что темная материя едва ли квантуема. Вселенная заряжает внутримолекулярный газ, в итоге возможно появление обратной связи и самовозбуждение системы.</span><a
                                class="description__link">Подробнее</a></div>
                </div>
                <div class="carousel-slide">
                    <h3 class="carousel-slide__caption">Завершен ремонт фасада строений по улице пр. Кирова</h3>
                    <div class="carousel-slide__description"><span class="description__text">Если для простоты пренебречь потерями на теплопроводность, то видно, что темная материя едва ли квантуема. Вселенная заряжает внутримолекулярный газ, в итоге возможно появление обратной связи и самовозбуждение системы.</span><a
                                class="description__link">Подробнее</a></div>
                </div>
                <div class="carousel-slide">
                    <h3 class="carousel-slide__caption">Завершен ремонт фасада строений по улице пр. Кирова</h3>
                    <div class="carousel-slide__description"><span class="description__text">Если для простоты пренебречь потерями на теплопроводность, то видно, что темная материя едва ли квантуема. Вселенная заряжает внутримолекулярный газ, в итоге возможно появление обратной связи и самовозбуждение системы.</span><a
                                class="description__link">Подробнее</a></div>
                </div>
            </div>
        </div>
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
    <div class="last-news-wrapper">
        <section class="last-news">
            <header class="last-news__header">
                <h4 class="header__caption">Последние новости</h4>
                <button class="header__btn">Все Новости</button>
            </header>
            <div class="last-news__content">
                <div class="content-block">
                    <div class="last-new">
                        <div class="last-new__data">31 марта 2017</div>
                        <a class="last-new__description">«ЗВЕЗДА»: Вовремя платить за капремонт выгодно. На должников будут
                            подавать в суд</a>
                    </div>
                    <div class="last-new">
                        <div class="last-new__data">29 марта 2017</div>
                        <a class="last-new__description">Застрахована ответственность подрядчиков в случае ущерба,
                            нанесенного жизни, здоровью и имуществу жителей многоквартирных домов</a>
                    </div>
                    <div class="last-new">
                        <div class="last-new__data">27 марта 2017</div>
                        <a class="last-new__description">Разработано приложение «Помощник ЭКР» – для расчета прогнозируемого
                            экономического эффекта при проведении капитального ремонта</a>
                    </div>
                    <div class="last-new">
                        <div class="last-new__data">24 марта 2017</div>
                        <a class="last-new__description">«Ольховатский вестник»: Капитальный вопрос. Ольховатцы расспросили
                            о взносах по капремонту</a>
                    </div>
                    <div class="last-new">
                        <div class="last-new__data">23 марта 2017</div>
                        <a class="last-new__description">В Фонде капитального ремонта многоквартирных домов Воронежской
                            области прошел «День открытых дверей»</a>
                    </div>
                    <div class="last-new">
                        <div class="last-new__data">20 марта 2017</div>
                        <a class="last-new__description">«Наш край»: Строители закончат ремонт досрочно</a>
                    </div>
                    <div class="last-new">
                        <div class="last-new__data">20 марта 2017</div>
                        <a class="last-new__description">«Борисоглебский вестник»: 19 многоэтажек «претендуют» на
                            капремонт</a>
                    </div>
                    <div class="last-new">
                        <div class="last-new__data">20 марта 2017</div>
                        <a class="last-new__description">«Знамя труда»: В Грибановке отремонтируют 15 многоэтажек</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="adjacent-links-wrapper">
        <section class="adjacent-links">
            <h4 class="adjacent-links__caption">Смежные правительственные ресурсы</h4>
            <div class="adjacent-links__content"><a class="link" href="/" target="_blank">
                    <h3 class="link__caption">Минстрой Российской Федераци</h3>
                    <div class="link__row">
                        <p class="row__link-text">minstroyrf.ru</p>
                        <svg class="row__icon" role="img">
                            <use xlink:href="{{ asset('assets/images/svg-sprite.svg#shape-link') }}"></use>
                        </svg>
                    </div>
                </a><a class="link" href="/" target="_blank">
                    <h3 class="link__caption">Правительство Республики Крым</h3>
                    <div class="link__row">
                        <p class="row__link-text">http://rk.gov.ru/</p>
                        <svg class="row__icon" role="img">
                            <use xlink:href="{{ asset('assets/images/svg-sprite.svg#shape-link') }}"></use>
                        </svg>
                    </div>
                </a><a class="link" href="/" target="_blank">
                    <h3 class="link__caption">Министерство Жилищно-Коммунального Хозяйства Республики Крым</h3>
                    <div class="link__row">
                        <p class="row__link-text">minstroyrf.ru</p>
                        <svg class="row__icon" role="img">
                            <use xlink:href="{{ asset('assets/images/svg-sprite.svg#shape-link') }}"></use>
                        </svg>
                    </div>
                </a><a class="link" href="/" target="_blank">
                    <h3 class="link__caption">Государственная корпорация – Фонд Содействия Реформированию ЖКХ</h3>
                    <div class="link__row">
                        <p class="row__link-text">minstroyrf.ru</p>
                        <svg class="row__icon" role="img">
                            <use xlink:href="{{ asset('assets/images/svg-sprite.svg#shape-link') }}"></use>
                        </svg>
                    </div>
                </a>
            </div>
        </section>
    </div>
@endsection