@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.gov-resources')])
    <div class="admin-pages-control">
        <h1 class="admin-pages-control__caption">Управление ссылками на смежные ресурсы</h1>
        <h6 class="admin-pages-control__subcaption">Изменение свойств ссылки</h6>
        <div class="divider"></div>
        <h3 class="admin-pages-control__title">Редактирование ссылки</h3>
        <form method="POST" action="{{ route('admin.gov-resources.update', ['news' => $govResource->id]) }}" >
            {{ csrf_field() }}
            <div class="form-group-block ">
                <div class="form-row">
                    <div class="form-group col-2">
                        <label class="form-group__label">Название</label>
                        <input class="form-group__input" type="text" name="title" value="{{ $govResource->title }}">
                        @if ($errors->has('title'))
                            <span class="error-message">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-2">
                        <label class="form-group__label">URL</label>
                        <input class="form-group__input" type="text" name="url" value="{{ $govResource->url }}"
                               placeholder="example-of-url">
                        @if ($errors->has('url'))
                            <span class="error-message">{{ $errors->first('url') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-2">
                        <label class="form-group__label">Управление</label>
                        <select class="form-group__select" name="management" onchange="confirm('Пожалуйста подтвердите действие') && document.getElementById(this.value).submit();">
                            <option class="select__option" value="show">Отображать</option>
                            <option class="select__option" value="hide">Скрыть</option>
                            <option class="select__option" value="delete">&lt;span&gt;Удалить&lt;/span&gt;</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="button-container">
                <a href="{{ route('admin.gov-resources') }}" class="btn-reset">Отменить</a>
                <button class="btn-save" type="submit">Сохранить</button>
            </div>
        </form>

    </div>
    <form id="delete" action="{{ route('admin.gov-resources.delete', ['page' => $govResource->id]) }}" method="POST"
          style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
    </form>
    <form id="show" action="{{ route('admin.gov-resources.change-status', ['page' => $govResource->id]) }}" method="POST"
          style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="status" value="shown">
    </form>
    <form id="hide" action="{{ route('admin.gov-resources.change-status', ['page' => $govResource->id]) }}" method="POST"
          style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="status" value="hidden">
    </form>
@endsection