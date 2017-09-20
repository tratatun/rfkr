<div class="form-group col-2">
    <label class="form-group__label">Изображение</label>
    <div class="attach-block">
        <div class="attach-block__left-col">
            <input type="file" accept="image/jpeg, image/jpg, image/png" id="attach-input" name="img">
            <button class="form-group__button" type="button" id="attach-btn">Выбрать файл</button>
        </div>
        <div class="attach-block__right-col"></div>
    </div>
    <div class="attach-error">Размер файла должен быть не более 10МВ</div><span class="form-group__tip">До 10 Мб. Формат: jpg, jpeg, png</span>
    @if ($errors->has('img'))
        <span class="error-message">{{ $errors->first('img') }}</span>
    @endif
</div>