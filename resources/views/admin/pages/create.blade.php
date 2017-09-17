@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.pages')])
    <div class="admin-pages-control">
        <h1 class="admin-pages-control__caption">Управление страницей</h1>
        <h6 class="admin-pages-control__subcaption">Изменение свойств и/или содержимого страницы</h6>
        <div class="divider"></div>
        <h3 class="admin-pages-control__title">Новая страница</h3>
        <form action="{{ route('admin.pages.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="parent_id" value="{{ request('parent_id') }}">
            <div class="form-group-block ">
                <div class="form-group">
                    <label class="form-group__label">Название</label>
                    <input class="form-group__input" type="text" name="title" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <span class="error-message">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-group__label">URL</label>
                    <input class="form-group__input" type="text" name="url" value="{{ old('url') }}"
                           placeholder="/example-of-url">
                    @if ($errors->has('url'))
                        <span class="error-message">{{ $errors->first('url') }}</span>
                    @endif
                </div>
                {{--<div class="form-group">--}}
                    {{--<label class="form-group__label">Порядковый номер</label>--}}
                    {{--<select class="form-group__select" name="number">--}}
                        {{--<option class="select__option" value="1">1</option>--}}
                        {{--<option class="select__option" value="2">2</option>--}}
                        {{--<option class="select__option" value="3">3</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label class="form-group__label">Управление</label>--}}
                    {{--<select class="form-group__select" name="management">--}}
                        {{--<option class="select__option" value="show">Отображать</option>--}}
                        {{--<option class="select__option" value="hide">Скрыть</option>--}}
                        {{--<option class="select__option" value="delete">&lt;span&gt;Удалить&lt;/span&gt;</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label class="form-group__label">Последнее изменение</label>--}}
                    {{--<div class="form-group__last-visit"><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></div>--}}
                {{--</div>--}}
            </div>
            <div class="admin-pages-control__subtitle">Содержимое</div>
            <div>
                <textarea name="text" id="editor"></textarea>
                @if ($errors->has('text'))
                    <span class="error-message">{{ $errors->first('text') }}</span>
                @endif
            </div>
            <br>
            <div class="divider"></div>
            <div class="button-container">
                <a href="{{ route('admin.pages') }}" class="btn-reset">Отменить</a>
                <button class="btn-save" type="submit">Создать</button>
            </div>
        </form>

    </div>
@endsection