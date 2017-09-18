@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => route('admin.treatments')])
    <div class="treatments-reply">
        <h1 class="treatments-reply__caption">Обращение</h1>
        <h6 class="treatments-reply__subcaption">Ответ на обращение</h6>
        @include('admin.treatment-answers.treatment', ['treatment' => $treatment])
        <div class="treatments-reply__title">Ответ на обращение</div>
        <form id="answerTreatment" method="post" action="{{ route('admin.treatment-answers.store', ['treatments' => $treatment->id]) }}">
            {{ csrf_field() }}
            <textarea name="text" id="editor">
                {{ old('text') }}
            </textarea>
            @if ($errors->has('text'))
                <span class="error-message">{{ $errors->first('text') }}</span>
            @endif
        </form>
        <form id="spamTreatment" method="post" action="{{ route('admin.treatments.spam', ['treatments' => $treatment->id]) }}">
            {{ csrf_field() }}
        </form>
        <div class="divider"></div>
        <div class="button-container">
            <button form="spamTreatment" type="submit" class="btn-spam"
                    onclick="return confirm('Вы уверены, что хотите пометить обращение как спам?')">Спам</button>
            <button form="answerTreatment" type="submit" class="btn-reply">Ответить</button>
        </div>
    </div>
@endsection