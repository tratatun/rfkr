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
                    <a class="item__link {{ request()->is('admin/pages*') ? 'active' : '' }}" href="{{ route('admin.pages') }}">Страницы</a>
                </li>
                <li class="navigation__item">
                    <a class="item__link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">Команда</a>
                </li>
                <li class="navigation__item">
                    <a class="item__link {{ request()->is('admin/treatments*') ? 'active' : '' }}" href="{{ route('admin.treatments') }}">Обращения</a>
                </li>
            </ul>
        @endif
        <ul class="account-block">
            <li class="account-block__item">
                <a href="{{ route('admin.logout') }}" class="logout">Привет, {{ Auth::user()->name }}</a>
            </li>
            <li class="account-block__item">
                <a href="{{ route('admin.logout') }}" class="logout">Выйти</a>
            </li>
        </ul>

    </header>
</div>