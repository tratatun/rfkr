@extends('admin.layout')

@section('content')
    @include('admin.parts.menu')
    <div class="admin-pages">
        <h1 class="admin-pages__caption">Страницы</h1>
        <h6 class="admin-pages__subcaption">Управление разделами и страницами веб-системы</h6>
        <div class="divider"></div>
        <div class="toogle">
            <div class="toogle__header"><a href="#admin-main-page" data-role="toogle">Главная страница</a></div>
            <div class="toogle__body" id="admin-main-page">
                <div class="toogle__body__top-row">
                    <div class="top-row__title">Обложка</div>
                    <div class="top-row__add-btn">Добавить</div>
                </div>
                <table class="table">
                    <tr>
                        <th>Название</th>
                        <th>Порядковый номер</th>
                        <th>Управление</th>
                        <th>Последнее изменение</th>
                    </tr>
                    <tr>
                        <td>Обложка один</td>
                        <td>1</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Обложка два</td>
                        <td>2</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                </table>
                <div class="toogle__body__top-row">
                    <div class="top-row__title">Слайдер</div>
                    <div class="top-row__add-btn">Добавить</div>
                </div>
                <table class="table">
                    <tr>
                        <td>Слайд один</td>
                        <td>1</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Слайд два</td>
                        <td>2</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                </table>
                <div class="toogle__body__top-row">
                    <div class="top-row__title">Рекламные записи (SEO)</div>
                    <div class="top-row__add-btn">Добавить</div>
                </div>
                <table class="table">
                    <tr>
                        <td>Рекламная запись один</td>
                        <td>1</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Рекламная запись два</td>
                        <td>2</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Рекламная запись три</td>
                        <td>3</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                </table>
                @include('admin.default.news-section')
                @include('admin.default.gov-resources-section')
            </div>
        </div>
        @foreach ($sections as $section)
            @include('admin.default.pages-section', ['section' => $section, 'index' => $loop->index])
        @endforeach
        <div class="divider"></div>
        <a href="{{ route('admin.pages.create') }}" class="btn-add-section">Добавить раздел</a>
    </div>
@endsection