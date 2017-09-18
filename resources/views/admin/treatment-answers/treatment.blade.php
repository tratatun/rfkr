<table class="table_type-treatments table">
    <tr>
        <th>Тип обращения</th>
        <th>Тематика</th>
    </tr>
    <tr>
        <td>@lang('admin.' . $treatment->type )</td>
        <td>@lang('admin.' . $treatment->thematic )</td>
    </tr>
</table>
<table class="table_type-treatments table">
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчество</th>
    </tr>
    <tr>
        <td>{{ $treatment->lastname }}</td>
        <td>{{ $treatment->firstname }}</td>
        <td>{{ $treatment->patronymic }}</td>
    </tr>
</table>
<table class="table_user-gender table">
    <tr>
        <th>Пол</th>
    </tr>
    <tr>
        <td>{{ $treatment->gender }}</td>
    </tr>
</table>
<table class="table_user-address table">
    <tr>
        <th>Адрес дома</th>
    </tr>
    <tr>
        <td>{{ $treatment->address }}</td>
    </tr>
</table>
<table class="table_user-email table">
    <tr>
        <th>Электронная почта</th>
    </tr>
    <tr>
        <td>{{ $treatment->email }}</td>
    </tr>
</table>
<table class="table_user-post-address table">
    <tr>
        <th>Почтовый адрес</th>
        <th>Телефон</th>
    </tr>
    <tr>
        <td>{{ $treatment->post_address }}</td>
        <td>{{ $treatment->phone }}</td>
    </tr>
</table>
<table class="table_treatment-text table">
    <tr>
        <th>Обращение</th>
    </tr>
    <tr>
        <td>{{ $treatment->message }}</td>
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