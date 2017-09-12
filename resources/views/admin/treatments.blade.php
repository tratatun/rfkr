@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.menu')
    <div class="admin-treatments">
        <h1 class="login__caption">Обращения</h1>
        <h6 class="login__subcaption">Просмотр обращений и формирование ответов</h6>
        <div class="tabs">
            <ul class="tabs__header">
                <li class="header__item"><a class="tabs-switch active" href="#new-treatments">Новые</a></li>
                <li class="header__item"><a class="tabs-switch" href="#parsed-treatments">Обработанные</a></li>
            </ul>
            <div class="tabs__content">
                <div class="content__pane visible" id="new-treatments">
                    <table class="table">
                        <tr>
                            <th>Тип</th>
                            <th>Тематика</th>
                            <th>Управление</th>
                            <th>Дата добавления</th>
                        </tr>
                        <tr>
                            <td>Предложение</td>
                            <td>Уплата взносов на капитальный ремонт</td>
                            <td><a href="/">Ответить</a></td>
                            <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>
                        </tr>
                        <tr>
                            <td>Заявление</td>
                            <td>Проведение капитального ремонта</td>
                            <td><a href="/">Ответить</a></td>
                            <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>
                        </tr>
                        <tr>
                            <td>Жалоба</td>
                            <td>Проведение капитального ремонта</td>
                            <td><a href="/">Ответить</a></td>
                            <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>
                        </tr>
                    </table>
                </div>
                <div class="content__pane" id="parsed-treatments">
                    <div class="form-group-block ">
                        <div class="form-group">
                            <label class="form-group__label">Специалист</label>
                            <select class="form-group__select" name="specialist">
                                <option class="select__option" value="oleg">oleg</option>
                                <option class="select__option" value="petr">petr</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-group__label">Статус</label>
                            <select class="form-group__select" name="status">
                                <option class="select__option" value="process">В работе</option>
                                <option class="select__option" value="parsed">Обработано</option>
                                <option class="select__option" value="spam">Спам</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-group__label">Период от</label>
                            <select class="form-group__select" name="periodFrom">
                                <option class="select__option" value="january17">янв ‘17</option>
                                <option class="select__option" value="march17">март ‘17</option>
                                <option class="select__option" value="february17">фев ‘17</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-group__label">Период до</label>
                            <select class="form-group__select" name="periodTo">
                                <option class="select__option" value="today">Сегодня</option>
                                <option class="select__option" value="week">Неделя</option>
                                <option class="select__option" value="month">Месяц</option>
                            </select>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="button-container">
                        <button class="btn-filter-clear">очистить фильтр</button>
                        <button class="btn-filter">Отфильтровать</button>
                    </div>
                    <div class="divider"></div>
                    <table class="table">
                        <tr>
                            <th>Тип</th>
                            <th>Тематика</th>
                            <th>Управление</th>
                            <th>Обработано</th>
                        </tr>
                        <tr>
                            <td>Предложение</td>
                            <td>Уплата взносов на капитальный ремонт</td>
                            <td><a href="/" class="reply-again">Ответить повторно</a></td>
                            <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                        </tr>
                        <tr>
                            <td>Заявление</td>
                            <td>Проведение капитального ремонта</td>
                            <td><a href="/" class="reply-again">Ответить повторно</a></td>
                            <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                        </tr>
                        <tr>
                            <td>Жалоба</td>
                            <td>Проведение капитального ремонта</td>
                            <td><a href="/" class="reply-again">Ответить повторно</a></td>
                            <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection