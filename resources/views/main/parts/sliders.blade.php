<div class="news-block__carousel">
    <div class="carousel-news-image">
        @foreach($sliders as $slider)
            <div class="carousel__slide">
                <div class="slide__img" style="background-image: url({{ asset('storage/' . $slider->img) }});"></div>
            </div>
        @endforeach
    </div>
    <div class="carousel-news">
        @foreach($sliders as $slider)
            <div class="carousel-slide">
                <h3 class="carousel-slide__caption">{{ $slider->title }}</h3>
                <div class="carousel-slide__description">
                    <span class="description__text">{!! $slider->text !!}</span>
                    {{--<a class="description__link">Подробнее</a>--}}
                </div>
            </div>
        @endforeach
    </div>
</div>