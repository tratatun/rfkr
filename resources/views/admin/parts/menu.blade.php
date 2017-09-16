<div class="header-admin-container">
    <header class="header-admin">
        @if(isset($back))
            <div class="come-back"><a href="{{ url($back) }}">
                <svg role="img">
                    <use xlink:href="/assets/images/svg-sprite.svg#shape-arrow-carousel"></use>
                </svg>
                <span>Назад к списку</span></a>
            </div>
        @else
            <ul class="navigation">
                <li class="navigation__item"><a class="item__link" href="{{ url('/admin/pages') }}">Страницы</a></li>
                <li class="navigation__item"><a class="item__link" href="{{ url('/admin/team') }}">Команда</a></li>
                <li class="navigation__item"><a class="item__link" href="{{ url('/admin/treatments') }}">Обращения</a></li>
                <li class="navigation__item" style="margin-left: 460px; color: #fff;">Привет, {{ Auth::user()->name }}</li>
            </ul>
        @endif
        <a href="{{ route('logout-admin') }}" class="logout">Выйти</a>
    </header>
</div>