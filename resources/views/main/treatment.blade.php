@extends('main.layout')

@section('content')
    @include('main.parts.header-close')
    <div class="message-send" id="top">
        <h1 class="message-send__caption">Оставить обращение</h1>
        <h6 class="message-send__subcaption">Добавить обращение</h6>
        <form class="message-send__form">
            <div class="form-group-block form-group-block_type">
                <div class="form-group">
                    <label class="form-group__label required">Тип обращения</label>
                    <select class="form-group__select" placeholder="Не выбрано">
                        <option class="select__option" value="proposal">Предложение</option>
                        <option class="select__option" value="statement">Заявление</option>
                        <option class="select__option" value="complaint">Жалоба</option>
                    </select><span class="form-group__tip">Обязательное поле. Поля помеченные звёздочкой «<span class="required">*</span>» обязательные</span>
                </div>
            </div>
            <div class="form-group-block form-group-block_user">
                <div class="form-group">
                    <label class="form-group__label required">Фамилия</label>
                    <input class="form-group__input" type="text" name="lastname"><span class="form-group__tip">Используйте настоящее имя</span>
                </div>
                <div class="form-group">
                    <label class="form-group__label required">Имя</label>
                    <input class="form-group__input" type="text" name="firstname">
                </div>
                <div class="form-group">
                    <label class="form-group__label">Отчество</label>
                    <input class="form-group__input" type="text" name="patronymic">
                </div>
                <div class="form-group">
                    <label class="form-group__label">Пол</label>
                    <input class="form-group__input" type="text" name="gender">
                </div>
            </div>
            <div class="form-group-block form-group-block_address">
                <div class="form-group">
                    <label class="form-group__label required">Адрес дома</label>
                    <input class="form-group__input" type="text" placeholder="Например: г. Симферополь, пр. Кирова 1" name="address"><span class="form-group__tip">Порядок заполнения: Город, дом, корпус</span>
                </div>
            </div>
            <div class="form-group-block form-group-block_email">
                <div class="form-group">
                    <label class="form-group__label required">Электронная почта</label>
                    <input class="form-group__input" type="text" name="email"><span class="form-group__tip">Срок ответа составляет до 3-х рабочих дней</span>
                </div>
            </div>
            <div class="form-group-block toogle form-group-block_additionally">
                <div class="toogle__header"><a data-role="toogle" href="#additionally-data">Дополнительные контактные данные</a></div>
                <div class="toogle__body" id="additionally-data">
                    <div class="form-group">
                        <label class="form-group__label">Почтовый адрес</label>
                        <input class="form-group__input" type="text" name="post-address"><span class="form-group__tip">Индекс, Страна, Край/округ/республика, город, дом, корпус, квартира</span>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Телефон</label>
                        <input class="form-group__input" type="text" name="telephone"><span class="form-group__tip">+7(123) 45-67-89</span>
                    </div>
                </div>
            </div>
            <div class="form-group-block form-group-block_thematics">
                <div class="form-group">
                    <label class="form-group__label required">Тематика</label>
                    <select class="form-group__select" name="thematic">
                        <option class="select__option" value="payment-contributions">Уплата взносов на капитальный ремонт</option>
                        <option class="select__option" value="capital-repair">Проведение капитального ремонта</option>
                    </select><span class="form-group__tip">Выбирайте основную тему обращения</span>
                </div>
            </div>
            <div class="form-group-block form-group-block_treatment">
                <div class="form-group">
                    <label class="form-group__label required">Обращение</label>
                    <textarea class="form-group__textarea" minlength="5" maxlength="440" name="message"></textarea><span class="form-group__tip">Количество символов ограничено. Осталось: <span>440</span></span>
                </div>
            </div>
            <div class="form-group-block toogle form-group-block_attach">
                <div class="toogle__header"><a data-role="toogle" href="#attach-file">Прикрепить файл</a></div>
                <div class="toogle__body" id="attach-file">
                    <div class="form-group">
                        <label class="form-group__label">Файл с компьютера</label>
                        <div class="attach-block">
                            <div class="attach-block__left-col">
                                <input type="file" accept="image/jpeg, image/png, text/plain, .doc, .docx, .pdf" id="attach-input">
                                <button class="form-group__button" type="button" id="attach-btn">Выбрать файл</button>
                            </div>
                            <div class="attach-block__right-col"></div>
                        </div>
                        <div class="attach-error">Размер файла должен быть не более 10МВ</div><span class="form-group__tip">До 10 Мб. Формат: txt, doc, docx, pdf, img, png</span>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label">Указать ссылку на облачное хранилище</label>
                        <input class="form-group__input" type="text" name="cloud-links"><span class="form-group__tip">Допустимы: Yandex Disk, Google Drive, Dropbox, Облако Mail.Ru, iCloud, OneDrive</span>
                    </div>
                </div>
            </div>
            <div class="form-group-block form-group-block_captcha">
                <div class="form-group">
                    <label class="form-group__label required">Защита от спама</label>
                    <div class="form-group__captcha"></div><span class="form-group__tip">Поставьте флажок</span>
                </div>
            </div>
            <div class="divider"></div>
            <div class="form__footer">
                <a href="{{ url('/') }}" class="message-send__reset" type="reset">Отменить</a>
                <button class="message-send__submit" type="submit">Отправить</button>
            </div>
        </form>
    </div>
@endsection