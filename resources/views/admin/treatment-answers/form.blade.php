<form id="answerTreatment" method="post" action="{{ route('admin.treatment-answers.store', ['treatments' => $treatment->id]) }}">
    {{ csrf_field() }}
    <textarea name="text" id="editor">
        {{ old('text') }}
    </textarea>
    @if ($errors->has('text'))
        <span class="error-message">{{ $errors->first('text') }}</span>
    @endif
</form>
@if (isset($spam) && $spam === true)
    <form id="spamTreatment" method="post" action="{{ route('admin.treatments.spam', ['treatments' => $treatment->id]) }}">
        {{ csrf_field() }}
    </form>
@endif
<div class="divider"></div>
<div class="button-container">
    @if (isset($spam) && $spam === true)
        <button form="spamTreatment" type="submit" class="btn-spam"
                onclick="return confirm('Вы уверены, что хотите пометить обращение как спам?')">Спам</button>
    @endif
    <button form="answerTreatment" type="submit" class="btn-reply">Ответить</button>
</div>