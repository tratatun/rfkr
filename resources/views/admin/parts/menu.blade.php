<div class="header-admin-container">
    <header class="header-admin">
        @if(isset($back))
            <div class="come-back"><a href="{{ $back }}">
                <svg role="img">
                    <use xlink:href="/assets/images/svg-sprite.svg#shape-arrow-carousel"></use>
                </svg>
                <span>Назад к списку</span></a>
            </div>
        @else
            <ul class="navigation">
                <li class="navigation__item ">
                    <a class="item__link {{ request()->is('admin/pages*') || request()->is('admin') ? 'active' : '' }}" href="{{ route('admin.pages') }}">Страницы</a>
                </li>
                <li class="navigation__item">
                    <a class="item__link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">Команда</a>
                </li>
                <li class="navigation__item">
                    <a class="item__link {{ request()->is('admin/treatments*') ? 'active' : '' }}" href="{{ route('admin.treatments') }}">Обращения</a>
                </li>
                <li class="navigation__item">
                    <a class="item__link" href="{{ route('home') }}">Перейти на сайт</a>
                </li>
            </ul>
        @endif
        <ul class="account-block">
            <li class="account-block__item">
                <a href="{{ route('admin.logout') }}" style="opacity: 0.6">{{ Auth::user()->name }}</a>
            </li>
            <li class="account-block__item">
                <a href="{{ route('admin.logout') }}" class="logout">Выйти</a>
            </li>
        </ul>

    </header>
</div>