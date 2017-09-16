@extends('admin.layout')

@section('content')
    @include('admin.parts.menu', ['back' => '/admin/treatments'])
    <div class="treatments-reply">
        <h1 class="treatments-reply__caption">Обращение</h1>
        <h6 class="treatments-reply__subcaption">Ответ на обращение</h6>
        <table class="table_type-treatments table">
            <tr>
                <th>Тип обращения</th>
                <th>Тематика</th>
            </tr>
            <tr>
                <td>Предложение</td>
                <td>Уплата взносов на капитальный ремонт</td>
            </tr>
        </table>
        <table class="table_type-treatments table">
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Отчество</th>
            </tr>
            <tr>
                <td>Константин</td>
                <td>Константинопольский</td>
                <td>Константинович</td>
            </tr>
        </table>
        <table class="table_user-gender table">
            <tr>
                <th>Пол</th>
            </tr>
            <tr>
                <td>Мужской</td>
            </tr>
        </table>
        <table class="table_user-address table">
            <tr>
                <th>Адрес дома</th>
            </tr>
            <tr>
                <td>г. Симферополь, пр. Кирова 1</td>
            </tr>
        </table>
        <table class="table_user-email table">
            <tr>
                <th>Электронная почта</th>
            </tr>
            <tr>
                <td>konstantin@mail.ru</td>
            </tr>
        </table>
        <table class="table_user-post-address table">
            <tr>
                <th>Почтовый адрес</th>
                <th>Телефон</th>
            </tr>
            <tr>
                <td>295000, Российская Федерация, Республика Крым, г. Симферополь, пр. Кирова 1</td>
                <td>+7(123) 456-78-90</td>
            </tr>
        </table>
        <table class="table_treatment-text table">
            <tr>
                <th>Обращение</th>
            </tr>
            <tr>
                <td>Даже если учесть разреженный газ, заполняющий пространство между звездами, то все равно солнечное затмение однократно. Южный Треугольник, и это следует подчеркнуть, изменяем. Ионный хвост, сублимиpуя с повеpхности ядpа кометы, сложен. Тукан ничтожно притягивает непреложный популяционный индекс.</td>
            </tr>
        </table>
        <table class="table_attach-file table">
            <tr>
                <th>Приложенный файл</th>
            </tr>
            <tr>
                <td><a href="/" class="table__attach-link">filename.doc</a></td>
            </tr>
        </table>
        <div class="treatments-reply__title">Ответ на обращение</div>
        <textarea name="editor" id="editor"></textarea>
        <div class="divider"></div>
        <div class="button-container">
            <button class="btn-spam">Спам</button>
            <button class="btn-reply">Ответить</button>
        </div>
    </div>
@endsection