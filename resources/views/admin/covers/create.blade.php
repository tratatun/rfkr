@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.covers')])
    <div class="admin-pages-control">
        <h1 class="admin-pages-control__caption">Управление Обложкой</h1>
        <h6 class="admin-pages-control__subcaption">Изменение свойств и/или содержимого обложки</h6>
        <div class="divider"></div>
        <h3 class="admin-pages-control__title">Новая обложка</h3>
        <form method="POST" action="{{ route('admin.covers.store') }}" >
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
                        <label class="form-group__label">Изображение</label>
                        <input class="form-group__input" type="text" name="img" value="{{ old('img') }}">
                        @if ($errors->has('img'))
                            <span class="error-message">{{ $errors->first('img') }}</span>
                        @endif
                    </div>
                </div>
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
                <a href="{{ route('admin.covers') }}" class="btn-reset">Отменить</a>
                <button class="btn-save" type="submit">Создать</button>
            </div>
        </form>

    </div>
@endsection