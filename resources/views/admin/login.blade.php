@extends('admin.layout')

@section('content')
    <div class="admin-login">
        <h1 class="login__caption">Войти</h1>
        <h6 class="login__subcaption">Управление веб-системой НО РФ КРМД РК</h6>
        <form class="admin-login__form" method="POST" action="{{ route('login-admin') }}">
            {{ csrf_field() }}
            <div class="form-group-block ">
                <div class="form-group {{ $errors->has('email') ? ' error' : '' }}">
                    <label class="form-group__label required">Электронная почта</label>
                    <input class="form-group__input" type="text" name="email">
                    @if ($errors->has('email'))
                        <span class="error-message">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' error' : '' }}">
                    <label class="form-group__label required">Пароль</label>
                    <input class="form-group__input" type="password" name="password" minlength="2">
                    @if ($errors->has('password'))
                        <span class="error-message">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="divider"></div>
            <div class="button-container">
                <button class="btn-reset">Отменить</button>
                <button class="btn-login" type="submit">Войти</button>
            </div>
        </form>
    </div>
@endsection