@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.sliders')])
    <div class="admin-pages-control">
        <h1 class="admin-pages-control__caption">Управление слайдером</h1>
        <h6 class="admin-pages-control__subcaption">Изменение свойств и/или содержимого слайдера</h6>
        <div class="divider"></div>
        <h3 class="admin-pages-control__title">Новый слайдер</h3>
        <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
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
                    @include('admin.covers.image-field')
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
                <a href="{{ route('admin.sliders') }}" class="btn-reset">Отменить</a>
                <button class="btn-save" type="submit">Создать</button>
            </div>
        </form>

    </div>
@endsection