@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.covers')])
    <div class="admin-pages-control">
        <h1 class="admin-pages-control__caption">Управление обложкой</h1>
        <h6 class="admin-pages-control__subcaption">Изменение свойств и/или содержимого обложки</h6>
        <div class="divider"></div>
        <h3 class="admin-pages-control__title">Редактирование обложки</h3>
        <form method="POST" action="{{ route('admin.covers.update', ['page' => $cover->id]) }}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group-block ">
                <div class="form-row">
                    <div class="form-group col-2">
                        <label class="form-group__label">Название</label>
                        <input class="form-group__input" type="text" name="title" value="{{ $cover->title }}">
                        @if ($errors->has('title'))
                            <span class="error-message">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    @include('admin.covers.image-field')
                </div>
                <div class="form-row">
                    <div class="form-group col-2">
                        @include('admin.parts.manage-input', ['entity' => $cover])
                    </div>
                </div>
            </div>
            <div class="admin-pages-control__subtitle">Содержимое</div>
            <div>
                <textarea name="text" id="editor">
                    {{ $cover->text }}
                </textarea>
                @if ($errors->has('text'))
                    <span class="error-message">{{ $errors->first('text') }}</span>
                @endif
            </div>
            <br>
            <div class="divider"></div>
            <div class="button-container">
                <a href="{{ route('admin.covers') }}" class="btn-reset">Отменить</a>
                <button class="btn-save" type="submit">Сохранить</button>
            </div>
        </form>

    </div>
    <form id="delete" action="{{ route('admin.covers.delete', ['page' => $cover->id]) }}" method="POST"
          style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
    </form>
    <form id="show" action="{{ route('admin.covers.change-status', ['page' => $cover->id]) }}" method="POST"
          style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="status" value="shown">
    </form>
    <form id="hide" action="{{ route('admin.covers.change-status', ['page' => $cover->id]) }}" method="POST"
          style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="status" value="hidden">
    </form>
@endsection