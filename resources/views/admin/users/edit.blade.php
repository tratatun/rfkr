@extends('admin.layout')
@section('content')
    @include('admin.parts.menu', ['back' => route('admin.users')])
    <div class="admin-team">
        <h1 class="login__caption">Администратор</h1>
        <h6 class="login__subcaption">Редактирование администратора</h6>
        <div class="divider"></div>
        <br>
        <br>
        <div class="add-admin" style="display: block">
            <div class="form-group-block ">
                <form id="createUserForm" method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="form-group__label">Имя</label>
                        <input class="form-group__input" type="text" name="name" value="{{ $user->name }}">
                        @if ($errors->has('name'))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Электронная почта</label>
                        <input class="form-group__input" type="text" name="email" value="{{ $user->email }}">
                        @if ($errors->has('email'))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Пароль</label>
                        <input title="@lang('admin.change_pswd_if_exists')" class="form-group__input" type="password" name="password" value="">
                        @if ($errors->has('password'))
                            <span class="error-message">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Роль</label>
                        <select class="form-group__select" name="role" value="{{ $user->role }}">
                            <option class="select__option" value=""></option>
                            <option class="select__option" value="support" {{$user->role === 'support' ? 'selected' : ''}}>Поддержка</option>
                            <option class="select__option" value="author" {{$user->role === 'author' ? 'selected' : ''}}>Автор записей</option>
                            <option class="select__option" value="superadmin" {{$user->role === 'superadmin' ? 'selected' : ''}}><span>Супер администратор</span></option>
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
                            <option class="select__option" value="block" disabled>Заблокировать</option>
                            <option class="select__option" value="banish" disabled><span>Изгнать</span></option>
                        </select>
                    </div>
            </form>
            </div>
        </div>
        <div class="divider"></div>
        <div class="button-container">
            <a href="{{ route('admin.users') }}" class="btn-control-save btn-reset btn-reset_add">Отменить</a>
            <button form="createUserForm" type="submit" class="btn-control-save btn-save">Сохранить</button>
        </div>
    </div>
@endsection