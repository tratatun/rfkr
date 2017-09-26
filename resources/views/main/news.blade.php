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
        <section class="last-news">
            <header class="last-news__header">
                <h4 class="header__caption">Все Новости</h4>
            </header>
            <div class="last-news__content">
                <div class="content-block">
                    @foreach ($news as $newsOne)
                        <div class="last-new">
                            <div class="last-new__data">{{ $newsOne->created_at->diffForHumans() }}</div>
                            <a href="{{ url($newsOne->url()) }}" class="last-new__description">{{ $newsOne->title }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection