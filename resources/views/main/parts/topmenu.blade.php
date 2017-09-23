<div class="header-wrapper">
    <header class="header">
        <a href="{{ url('/') }}">
            <div class="header__logo">
                <svg class="logo logo-default" role="img">
                    <use xlink:href="/assets/images/svg-sprite.svg#shape-logo"></use>
                </svg>
                <svg class="logo logo-hover" role="img">
                    <use xlink:href="/assets/images/svg-sprite.svg#shape-logo-hover"></use>
                </svg>
            </div>
            <div class="header__company">
                <div class="company__type">Некоммерческая организация</div>
                <div class="company__name">«Региональный Фонд Капитального Ремонта Многоквартирных Домов Республики
                    Крым»
                </div>
            </div>
        </a>
        <nav class="header__nav">
            @foreach ($sections as $section)
                <a class="nav__link" href="{{ url($section->url()) }}">{{ $section->title }}</a>
            @endforeach
        </nav>
    </header>
</div>