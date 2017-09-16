@extends('admin.layout')
@section('content')
    @include('admin.parts.menu')
    <div class="admin-team">
        <h1 class="login__caption">Команда</h1>
        <h6 class="login__subcaption">Добавление администраторов ресурса и управление ролями</h6>
        <div class="divider"></div>
        <table class="table">
            <tr>
                <th>Имя</th>
                <th>Почтовый ящик</th>
                <th>Управление</th>
                <th>Последнее действие</th>
            </tr>
            <tr>
                <td>Petr Petr</td>
                <td>12345@Owner.com</td>
                <td><button class="btn-change">Изменить</button></td>
                <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>
            </tr>
            <tr>
                <td>Oleg Oleg</td>
                <td>12345@Owner.com</td>
                <td><button class="btn-change">Изменить</button></td>
                <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>
            </tr>
            <tr>
                <td>Maksim Maksim</td>
                <td>12345@Owner.com</td>
                <td><button class="btn-change">Изменить</button></td>
                <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>
            </tr>
        </table>
        <div class="add-admin">
            <h3 class="add-admin__caption">Новый администратор</h3>
            <div class="form-group-block ">
                <form id="teamCreateUserForm" method="POST" action="{{ route('register-admin') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="form-group__label">Имя</label>
                        <input class="form-group__input" type="text" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="error-message">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Электронная почта</label>
                        <input class="form-group__input" type="text" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="error-message">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-group__label">Пароль</label>
                        <input class="form-group__input" type="password" name="password" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <span class="error-message">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Роль</label>
                        <select class="form-group__select" name="role">
                            <option class="select__option" value=""></option>
                            <option class="select__option" value="support">Поддержка</option>
                            <option class="select__option" value="author">Автор записей</option>
                            <option class="select__option" value="superadmin"><span>Супер администратор</span></option>
                        </select>
                        @if ($errors->has('role'))
                            <span class="error-message">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Управление</label>
                        <select class="form-group__select" name="managment">
                            <option class="select__option" value=""></option>
                            <option class="select__option" value="logindata">Войти с данными</option>
                            <option class="select__option" value="block" disabled>Заблокировать</option>
                            <option class="select__option" value="banish" disabled><span>Изгнать</span></option>
                        </select>
                    </div>
            </form>
            </div>
        </div>
        <div class="change-admin">
            <h3 class="change-admin__caption">Изменить запись об администраторе</h3>
            <div class="form-group-block">
                <div class="form-group">
                    <label class="form-group__label">Электронная почта</label>
                    <input class="form-group__input" type="text" name="email">
                </div>
                <div class="form-group">
                    <label class="form-group__label">Пароль</label>
                    <input class="form-group__input" type="text" name="password" >
                </div>
                <div class="form-group">
                    <label class="form-group__label">Роль</label>
                    <select class="form-group__select" name="role" alue="{{ old('role') }}">
                        <option class="select__option" value="support">Поддержка</option>
                        <option class="select__option" value="author">Автор записей</option>
                        <option class="select__option" value="superadmin"><span>Супер администратор</span></option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-group__label">Управление</label>
                    <select class="form-group__select" name="managment">
                        <option class="select__option" value="logindata">Войти с данными</option>
                        <option class="select__option" value="block" disabled>Заблокировать</option>
                        <option class="select__option" value="banish" disabled><span>Изгнать</span></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="button-container">
            <button class="btn-control-save btn-reset btn-reset_add">Отменить</button>
            <button form="teamCreateUserForm" type="submit" class="btn-control-save btn-save">Сохранить</button>
            <button class="btn-add btn-add-admin">Добавить администратора</button>
        </div>
    </div>
@endsection