@extends('admin.layouts.layout')
@section('content')
    @include('admin.layouts.menu')
    <div class="admin-team">
        <h1 class="login__caption">Команда</h1>
        <h6 class="login__subcaption">Добавление администраторов ресурса и управление ролями</h6>
        <div class="divider"></div>
        <table class="table">
            <tr>
                <th>Логин</th>
                <th>Пароль</th>
                <th>Управление</th>
                <th>Последнее действие</th>
            </tr>
            <tr>
                <td>petr</td>
                <td>12345@Owner</td>
                <td><button class="btn-change">Изменить</button></td>
                <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>
            </tr>
            <tr>
                <td>oleg</td>
                <td>12345@Autor</td>
                <td><button class="btn-change">Изменить</button></td>
                <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>
            </tr>
            <tr>
                <td>grigorii</td>
                <td>12345@Support</td>
                <td><button class="btn-change">Изменить</button></td>
                <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>
            </tr>
        </table>
        <div class="add-admin">
            <h3 class="add-admin__caption">Новый администратор</h3>
            <div class="form-group-block ">
                <div class="form-group">
                    <label class="form-group__label">Логин</label>
                    <input class="form-group__input" type="text" name="login">
                </div>
                <div class="form-group">
                    <label class="form-group__label">Пароль</label>
                    <input class="form-group__input" type="text" name="password">
                </div>
                <div class="form-group">
                    <label class="form-group__label">Роль</label>
                    <select class="form-group__select" name="role">
                        <option class="select__option" value="support">Поддержка</option>
                        <option class="select__option" value="author">Автор записей</option>
                        <option class="select__option" value="superadmin">&lt;span&gt;Superadmin&lt;/span&gt;</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-group__label">Управление</label>
                    <select class="form-group__select" name="managment">
                        <option class="select__option" value="logindata">Войти с данными</option>
                        <option class="select__option" value="block" disabled>Заблокировать</option>
                        <option class="select__option" value="banish" disabled>&lt;span&gt;Изгнать&lt;/span&gt;</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="change-admin">
            <h3 class="change-admin__caption">Изменить запись об администраторе</h3>
            <div class="form-group-block ">
                <div class="form-group">
                    <label class="form-group__label">Логин</label>
                    <input class="form-group__input" type="text" name="login">
                </div>
                <div class="form-group">
                    <label class="form-group__label">Пароль</label>
                    <input class="form-group__input" type="text" name="password">
                </div>
                <div class="form-group">
                    <label class="form-group__label">Роль</label>
                    <select class="form-group__select" name="role">
                        <option class="select__option" value="support">Поддержка</option>
                        <option class="select__option" value="author">Автор записей</option>
                        <option class="select__option" value="superadmin">&lt;span&gt;Superadmin&lt;/span&gt;</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-group__label">Управление</label>
                    <select class="form-group__select" name="managment">
                        <option class="select__option" value="logindata">Войти с данными</option>
                        <option class="select__option" value="block" disabled>Заблокировать</option>
                        <option class="select__option" value="banish" disabled>&lt;span&gt;Изгнать&lt;/span&gt;</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="button-container">
            <button class="btn-control-save btn-reset btn-reset_add">Отменить</button>
            <button class="btn-control-save btn-save">Сохранить</button>
            <button class="btn-add btn-add-admin">Добавить администратора</button>
        </div>
    </div>
@endsection