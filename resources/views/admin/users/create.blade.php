@extends('admin.layout')
@section('content')
    @include('admin.parts.menu', ['back' => route('admin.users')])
    <div class="admin-team">
        <h1 class="login__caption">Администратор</h1>
        <h6 class="login__subcaption">Добавление администратора</h6>
        <div class="divider"></div>
        <br>
        <br>
        <div class="add-admin" style="display: block">
            <div class="form-group-block ">
                <form id="createUserForm" method="POST" action="{{ route('admin.users') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="form-group__label">Имя</label>
                        <input class="form-group__input" type="text" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Электронная почта</label>
                        <input class="form-group__input" type="text" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-group__label">Пароль</label>
                        <input class="form-group__input" type="password" name="password" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <span class="error-message">{{ $errors->first('password') }}</span>
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
                            <span class="error-message">{{ $errors->first('role') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Управление</label>
                        <select class="form-group__select" name="managment">
                            <option class="select__option" value=""></option>
                            <option class="select__option" value="logindata">Войти с данными</option>
                        </select>
                    </div>
            </form>
            </div>
        </div>
        <div class="divider"></div>
        <div class="button-container">
            <a href="{{ route('admin.users') }}" class="btn-control-save btn-reset btn-reset_add">Отменить</a>
            <button form="createUserForm" type="submit" class="btn-control-save btn-save">Создать</button>
        </div>
    </div>
@endsection