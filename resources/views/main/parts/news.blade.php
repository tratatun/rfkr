<div class="last-news-wrapper">
    <section class="last-news">
        <header class="last-news__header">
            <h4 class="header__caption">Последние новости</h4>
            <a href="/news" class="header__btn">Все Новости</a>
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