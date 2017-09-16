<div class="header-admin-container">
    <header class="header-admin">
        @if(isset($back))
            <div class="come-back"><a href="{{$back}}">
                <svg role="img">
                    <use xlink:href="/assets/images/svg-sprite.svg#shape-arrow-carousel"></use>
                </svg>
                <span>Назад к списку</span></a>
            </div>
        @else
            <ul class="navigation">
                <li class="navigation__item"><a class="item__link" href="/admin/pages">Страницы</a></li>
                <li class="navigation__item"><a class="item__link" href="/admin/team">Команда</a></li>
                <li class="navigation__item"><a class="item__link" href="/admin/treatments">Обращения</a></li>
            </ul>
        @endif
        <a href="{{ route('logout-admin') }}" class="logout">Выйти</a>
    </header>
</div>