@extends('admin.layout')


@section('content')
    @include('admin.parts.menu', ['back' => route('admin.gov-resources')])
    <div class="admin-pages-control">
        <h1 class="admin-pages-control__caption">Управление ссылками на смежные ресурсы</h1>
        <h6 class="admin-pages-control__subcaption">Изменение свойств ссылки</h6>
        <div class="divider"></div>
        <h3 class="admin-pages-control__title">Новая ссылка</h3>
        <form method="POST"
              action="{{ route('admin.gov-resources.store') }}" >
            {{ csrf_field() }}
            <div class="form-group-block ">
                <div class="form-row">
                    <div class="form-group col-2">
                        <label class="form-group__label">Название</label>
                        <input class="form-group__input" type="text" name="title" value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="error-message">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-2">
                        <label class="form-group__label">URL</label>
                        <input class="form-group__input" type="text" name="url" value="{{ old('url') }}"
                               placeholder="http://site.com или https://site.com">
                        @if ($errors->has('url'))
                            <span class="error-message">{{ $errors->first('url') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <div class="divider"></div>
            <div class="button-container">
                <a href="{{ route('admin.gov-resources') }}" class="btn-reset">Отменить</a>
                <button class="btn-save" type="submit">Создать</button>
            </div>
        </form>

    </div>
@endsection