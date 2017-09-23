<label class="form-group__label">Управление</label>
<select class="form-group__select" name="management"
        onchange="confirm('Пожалуйста подтвердите действие') && document.getElementById(this.value).submit();">
    <option value=""></option>
    @if ($entity->status === 'hidden')
        <option class="select__option" value="show">Отображать</option>
    @else
        <option class="select__option" value="hide">Скрыть</option>
    @endif
        <option class="select__option" value="delete"><span>Удалить</span></option>
</select>