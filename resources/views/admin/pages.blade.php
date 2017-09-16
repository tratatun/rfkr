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
                <div class="toogle__body__top-row">
                    <div class="top-row__title">Новости</div>
                    <div class="top-row__add-btn">Добавить</div>
                </div>
                <table class="news-table table">
                    <tr>
                        <td>Последняя новость</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Предпоследняя новость</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Пред-предпоследняя новость</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                </table>
                <div class="toogle__body__top-row">
                    <div class="top-row__title">Ссылки на смежные ресурсы</div>
                    <div class="top-row__add-btn">Добавить</div>
                </div>
                <table class="table">
                    <tr>
                        <td>Ссылка один</td>
                        <td>1</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Ссылка два</td>
                        <td>2</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Ссылка три</td>
                        <td>3</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="divider"></div>
        <div class="toogle">
            <div class="toogle__header"><a href="#admin-section-two" data-role="toogle">Имя раздела два</a></div>
            <div class="toogle__body" id="admin-section-two">
                <table class="table">
                    <tr>
                        <th>Название</th>
                        <th>Порядковый номер</th>
                        <th>Управление</th>
                        <th>Последнее изменение</th>
                    </tr>
                    <tr>
                        <td>Страница один</td>
                        <td>1</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница два</td>
                        <td>2</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница три</td>
                        <td>3</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница четыре</td>
                        <td>4</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница пять</td>
                        <td>5</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница шесть</td>
                        <td>6</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница семь</td>
                        <td>7</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="divider"></div>
        <div class="toogle">
            <div class="toogle__header"><a href="#admin-section-three" data-role="toogle">Имя раздела три</a></div>
            <div class="toogle__body" id="admin-section-three">
                <table class="table">
                    <tr>
                        <th>Название</th>
                        <th>Порядковый номер</th>
                        <th>Управление</th>
                        <th>Последнее изменение</th>
                    </tr>
                    <tr>
                        <td>Страница один</td>
                        <td>1</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница два</td>
                        <td>2</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница три</td>
                        <td>3</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница четыре</td>
                        <td>4</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница пять</td>
                        <td>5</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница шесть</td>
                        <td>6</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница семь</td>
                        <td>7</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="divider"></div>
        <div class="toogle">
            <div class="toogle__header"><a href="#admin-section-four" data-role="toogle">Имя раздела четыре</a></div>
            <div class="toogle__body" id="admin-section-four">
                <table class="table">
                    <tr>
                        <th>Название</th>
                        <th>Порядковый номер</th>
                        <th>Управление</th>
                        <th>Последнее изменение</th>
                    </tr>
                    <tr>
                        <td>Страница один</td>
                        <td>1</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница два</td>
                        <td>2</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница три</td>
                        <td>3</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница четыре</td>
                        <td>4</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница пять</td>
                        <td>5</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница шесть</td>
                        <td>6</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница семь</td>
                        <td>7</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="divider"></div>
        <div class="toogle">
            <div class="toogle__header"><a href="#admin-section-five" data-role="toogle">Имя раздела пять</a></div>
            <div class="toogle__body" id="admin-section-five">
                <table class="table">
                    <tr>
                        <th>Название</th>
                        <th>Порядковый номер</th>
                        <th>Управление</th>
                        <th>Последнее изменение</th>
                    </tr>
                    <tr>
                        <td>Страница один</td>
                        <td>1</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница два</td>
                        <td>2</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница три</td>
                        <td>3</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница четыре</td>
                        <td>4</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница пять</td>
                        <td>5</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница шесть</td>
                        <td>6</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                    <tr>
                        <td>Страница семь</td>
                        <td>7</td>
                        <td><a href="" class="link-change">Изменить</a></td>
                        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="divider"></div>
        <a href="{{ url('/admin/pages/add') }}" class="btn-add-section">Добавить раздел</a>
    </div>
@endsection