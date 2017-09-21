@extends('main.layout')

@section('content')
    @include('main.parts.header-close')
    <div class="message-send" id="top">
        <h1 class="message-send__caption">Оставить обращение</h1>
        <h6 class="message-send__subcaption">Добавить обращение</h6>
        <form method="post" action="{{ route('treatments.store') }}" enctype="multipart/form-data"
              class="message-send__form">
            {{csrf_field()}}
            <div class="form-group-block form-group-block_type">
                <div class="form-group">
                    <label class="form-group__label required">Тип обращения</label>
                    <select class="form-group__select" name="type">
                        <option class="select__option" value=""></option>
                        <option class="select__option" value="proposal" {{old('type') === 'proposal' ? 'selected' : ''}}>Предложение</option>
                        <option class="select__option" value="statement" {{old('type') === 'statement' ? 'selected' : ''}}>Заявление</option>
                        <option class="select__option" value="complaint" {{old('type') === 'complaint' ? 'selected' : ''}}>Жалоба</option>
                    </select>
                    <span class="form-group__tip">Обязательное поле. Поля помеченные звёздочкой «<span class="required">*</span>» обязательные</span>
                    @if ($errors->has('type'))
                        <span class="error-message">{{ $errors->first('type') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group-block form-group-block_user">
                <div class="form-row">
                    <div class="form-group col-3">
                        <label class="form-group__label required">Фамилия</label>
                        <input class="form-group__input" type="text" name="lastname" value="{{ old('lastname') }}">
                        <span class="form-group__tip">Используйте настоящее имя</span>
                        @if ($errors->has('lastname'))
                            <span class="error-message">{{ $errors->first('lastname') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-3">
                        <label class="form-group__label required">Имя</label>
                        <input class="form-group__input" type="text" name="firstname" value="{{ old('firstname') }}">
                        @if ($errors->has('firstname'))
                            <span class="error-message">{{ $errors->first('firstname') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-3">
                        <label class="form-group__label">Отчество</label>
                        <input class="form-group__input" type="text" name="patronymic" value="{{ old('patronymic') }}">
                        @if ($errors->has('patronymic'))
                            <span class="error-message">{{ $errors->first('patronymic') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-3">
                        <label class="form-group__label">Пол</label>
                        <select class="form-group__select" name="gender">
                            <option class="select__option" value=""></option>
                            <option class="select__option" value="male" {{old('gender') === 'male' ? 'selected' : ''}}>Мужской</option>
                            <option class="select__option" value="female" {{old('gender') === 'female' ? 'selected' : ''}}>Женский</option>
                        </select>
                        @if ($errors->has('gender'))
                            <span class="error-message">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group-block form-group-block_address">
                <div class="form-group">
                    <label class="form-group__label required">Адрес дома</label>
                    <input class="form-group__input" type="text" placeholder="Например: г. Симферополь, пр. Кирова 1" name="address" value="{{ old('address') }}">
                    <span class="form-group__tip">Порядок заполнения: Город, дом, корпус</span>
                    @if ($errors->has('address'))
                        <span class="error-message">{{ $errors->first('address') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group-block form-group-block_email">
                <div class="form-group">
                    <label class="form-group__label required">Электронная почта</label>
                    <input class="form-group__input" type="text" name="email" value="{{ old('email') }}">
                    <span class="form-group__tip">Срок ответа составляет до 3-х рабочих дней</span>
                    @if ($errors->has('email'))
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group-block toogle form-group-block_additionally">
                <div class="toogle__header"><a data-role="toogle" href="#additionally-data">Дополнительные контактные данные</a></div>
                <div class="toogle__body" id="additionally-data">
                    <div class="form-group">
                        <label class="form-group__label">Почтовый адрес</label>
                        <input class="form-group__input" type="text" name="post_address" value="{{ old('post_address') }}">
                        <span class="form-group__tip">Индекс, Страна, Край/округ/республика, город, дом, корпус, квартира</span>
                        @if ($errors->has('post_address'))
                            <span class="error-message">{{ $errors->first('post_address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Телефон</label>
                        <input class="form-group__input" type="text" name="phone" value="{{ old('phone') }}">
                        <span class="form-group__tip">+7(123) 45-67-89</span>
                        @if ($errors->has('phone'))
                            <span class="error-message">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group-block form-group-block_thematics">
                <div class="form-group">
                    <label class="form-group__label required">Тематика</label>
                    <select class="form-group__select" name="thematic">
                        <option class="select__option" value=""></option>
                        <option class="select__option" value="payment-contributions"  {{old('thematic') === 'payment-contributions' ? 'selected' : ''}}>Уплата взносов на капитальный ремонт</option>
                        <option class="select__option" value="capital-repair"  {{old('thematic') === 'capital-repair' ? 'selected' : ''}}>Проведение капитального ремонта</option>
                    </select>
                    <span class="form-group__tip">Выбирайте основную тему обращения</span>
                    @if ($errors->has('thematic'))
                        <span class="error-message">{{ $errors->first('thematic') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group-block form-group-block_treatment">
                <div class="form-group">
                    <label class="form-group__label required">Обращение</label>
                    <textarea class="form-group__textarea" minlength="5" maxlength="440" name="message">{{ old('message') }}</textarea>
                    <span class="form-group__tip">Количество символов ограничено. Осталось: <span>440</span></span>
                    @if ($errors->has('message'))
                        <span class="error-message">{{ $errors->first('message') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group-block toogle form-group-block_attach">
                <div class="toogle__header"><a data-role="toogle" href="#attach-file">Прикрепить файл</a></div>
                <div class="toogle__body" id="attach-file">
                    <div class="form-group">
                        <label class="form-group__label">Файл с компьютера</label>
                        <div class="attach-block">
                            <div class="attach-block__left-col">
                                <input type="file" accept="image/jpeg, image/png, text/plain, .doc, .docx, .pdf" id="attach-input" name="file">
                                <button class="form-group__button" type="button" id="attach-btn">Выбрать файл</button>
                            </div>
                            <div class="attach-block__right-col"></div>
                        </div>
                        <div class="attach-error">Размер файла должен быть не более 10МВ</div><span class="form-group__tip">До 10 Мб. Формат: txt, doc, docx, pdf, img, png</span>
                        @if ($errors->has('file'))
                            <span class="error-message">{{ $errors->first('file') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Указать ссылку на облачное хранилище</label>
                        <input class="form-group__input" type="text" name="file_url" value="{{ old('file_url') }}">
                        <span class="form-group__tip">Допустимы: Yandex Disk, Google Drive, Dropbox, Облако Mail.Ru, iCloud, OneDrive</span>
                        @if ($errors->has('file_url'))
                            <span class="error-message">{{ $errors->first('file_url') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group-block form-group-block_captcha">
                <div class="form-group">
                    <label class="form-group__label required">Защита от спама</label>
                    {!! app('captcha')->display(); !!}
                    <span class="form-group__tip">Поставьте флажок</span>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="error-message">{{ $errors->first('g-recaptcha-response') }}</span>
                    @endif
                </div>
            </div>
            <div class="divider"></div>
            <div class="form__footer">
                <a href="{{ url('/') }}" class="message-send__reset" type="reset">Отменить</a>
                <button type="submit" class="message-send__submit" type="submit">Отправить</button>
            </div>
        </form>
    </div>
@endsection