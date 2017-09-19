<div class="main-block__carousel">
    @foreach($covers as $cover)
        <div class="carousel__slide">
            <div class="slide__image" style="background-image: url({{ $cover->img }});"></div>
            <div class="slide__info-wrapper">
                <div class="slide__info">
                    <h3 class="info__caption">{{ $cover->title }}</h3>
                    <div class="info__description">{!! $cover->text !!}</div>
                    <a class="info__link" href="/">найти дом</a>
                </div>
            </div>
        </div>
    @endforeach
</div>