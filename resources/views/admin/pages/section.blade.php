<div class="toogle">
    <div class="toogle__header"><a href="#admin-section-{{ $index }}" data-role="toogle">{{$section->title}}</a></div>
    <div class="toogle__body" id="admin-section-{{ $index }}">
        <table class="table">
            <tr>
                <th>Название</th>
                <th>Управление</th>
                <th>Последнее изменение</th>
            </tr>
            <tr>
                <td>Страница один</td>
                <td><a href="" class="link-change">Изменить</a></td>
                <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
            </tr>
        </table>
        <a href="{{ route('admin.pages.create') }}" class="btn-add-section">Добавить страницу</a>
    </div>
</div>