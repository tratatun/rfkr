<div class="main-block__carousel">
    @foreach($covers as $cover)
        <div class="carousel__slide">
            <div class="slide__image" style="background-image: url({{ asset('storage/' . $cover->img) }});"></div>
            <div class="slide__info-wrapper">
                <div class="slide__info">
                    <h3 class="info__caption">{{ $cover->title }}</h3>
                    <div class="info__description">{!! $cover->text !!}</div>
                    <a class="info__link" href="{{ url('/house') }}">найти дом</a>
                </div>
            </div>
        </div>
    @endforeach
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