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
                    <div class="form-row">
                        <div class="form-group col-3">
                            <label class="form-group__label">Имя</label>
                            <input class="form-group__input" type="text" name="name" value="{{ $user->name }}">
                            @if ($errors->has('name'))
                                <span class="error-message">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-3">
                            <label class="form-group__label">Электронная почта</label>
                            <input class="form-group__input" type="text" name="email" value="{{ $user->email }}">
                            @if ($errors->has('email'))
                                <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-3">
                            <label class="form-group__label">Пароль</label>
                            <input title="@lang('admin.change_pswd_if_exists')" class="form-group__input" type="password" name="password" value="">
                            @if ($errors->has('password'))
                                <span class="error-message">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-2">
                            <label class="form-group__label">Роль</label>
                            <select class="form-group__select" name="role">
                                <option class="select__option" value=""></option>
                                @foreach ($roles as $role)
                                    <option class="select__option"
                                            value="{{ $role }}" {{$user->role === $role ? 'selected' : ''}}>
                                        @lang('admin.' . $role)
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <span class="error-message">{{ $errors->first('role') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-2">
                            <label class="form-group__label">Управление</label>
                            <select class="form-group__select" name="managment"
                                    onchange="confirm('Вы уверены?') && document.getElementById(this.value).submit();">
                                <option class="select__option" value=""></option>
                                <option class="select__option" value="login">Войти с данными</option>
                                @if ($user->status === 'active')
                                    <option class="select__option" value="blocked">Заблокировать</option>
                                @else
                                    <option class="select__option" value="unblock">Разблокировать</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    
            </form>
            <form id="login" action="{{ route('admin.users.login-as', ['user' => $user->id]) }}" method="POST"
                  style="display: none">
                {{ csrf_field() }}
            </form>
            <form id="blocked" action="{{ route('admin.users.change-status', ['user' => $user->id]) }}" method="POST"
                  style="display: none">
                {{ csrf_field() }}
                <input type="hidden" name="status" value="blocked">
            </form>
            <form id="unblock" action="{{ route('admin.users.change-status', ['user' => $user->id]) }}" method="POST"
                  style="display: none">
                {{ csrf_field() }}
                <input type="hidden" name="status" value="active">
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