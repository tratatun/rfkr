<div class="adjacent-links-wrapper">
    <section class="adjacent-links">
        <h4 class="adjacent-links__caption">Смежные правительственные ресурсы</h4>
        <div class="adjacent-links__content">
            @foreach ($govResources as $govResource)
                <a class="link" href="{{ $govResource->url }}" target="_blank">
                    <h3 class="link__caption">{{ $govResource->title }}</h3>
                    <div class="link__row">
                        <p class="row__link-text">{{ $govResource->url }}</p>
                        <svg class="row__icon" role="img">
                            <use xlink:href="{{ asset('assets/images/svg-sprite.svg#shape-link') }}"></use>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</div>