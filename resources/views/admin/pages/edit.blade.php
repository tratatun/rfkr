@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.pages')])
    <div class="admin-pages-control">
        <h1 class="admin-pages-control__caption">Управление страницей</h1>
        <h6 class="admin-pages-control__subcaption">Изменение свойств и/или содержимого страницы</h6>
        <div class="divider"></div>
        @if ($page->page_id)
            <h3 class="admin-pages-control__title">Редактирование станицы</h3>
        @else
            <h3 class="admin-pages-control__title">Редактирование раздела</h3>
        @endif
        <form method="POST" action="{{ route('admin.pages.update', ['page' => $page->id]) }}" >
            {{ csrf_field() }}
            <div class="form-group-block ">
                <div class="form-row">
                    <div class="form-group col-2">
                        <label class="form-group__label">Название</label>
                        <input class="form-group__input" type="text" name="title" value="{{ $page->title }}">
                        @if ($errors->has('title'))
                            <span class="error-message">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-2">
                        <label class="form-group__label">URL</label>
                        <input class="form-group__input" type="text" name="url" value="{{ $page->url }}"
                               placeholder="example-of-url">
                        @if ($errors->has('url'))
                            <span class="error-message">{{ $errors->first('url') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-2">
                        @include('admin.parts.manage-input', ['entity' => $page])
                    </div>
                </div>
            </div>
            <div class="admin-pages-control__subtitle">Содержимое</div>
            <div>
                <textarea name="text" id="editor">
                    {{ $page->text }}
                </textarea>
                @if ($errors->has('text'))
                    <span class="error-message">{{ $errors->first('text') }}</span>
                @endif
            </div>
            <br>
            <div class="divider"></div>
            <div class="button-container">
                <a href="{{ route('admin.pages') }}" class="btn-reset">Отменить</a>
                <button class="btn-save" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
    <form id="delete" action="{{ route('admin.pages.delete', ['page' => $page->id]) }}" method="POST"
          style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
    </form>
    <form id="show" action="{{ route('admin.pages.change-status', ['page' => $page->id]) }}" method="POST"
          style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="status" value="shown">
    </form>
    <form id="hide" action="{{ route('admin.pages.change-status', ['page' => $page->id]) }}" method="POST"
          style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="status" value="hidden">
    </form>
@endsection