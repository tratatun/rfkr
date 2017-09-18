<div class="toogle">
    <div class="toogle__header"><a href="#admin-section-{{ $index }}" data-role="toogle">{{$section->title}}</a></div>
    <div class="toogle__body" id="admin-section-{{ $index }}">
        <a href="{{ route('admin.pages.edit', ['page' => $section->id]) }}" class="btn-add-section">Редактировать раздел</a>
        <br>
        <br>
        <br>
        <table class="table">
            <tr>
                <th>Название</th>
                <th>Управление</th>
                <th>Добавлена</th>
                <th>Последнее изменение</th>
            </tr>
            @forelse($section->subPages as $page)
                <tr>
                    <td>{{ $page->title }}</td>
                    <td><a href="{{ route('admin.pages.edit', ['page' => $page->id]) }}" class="link-change">Изменить</a></td>
                    <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                    <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center">Страниц не найдено</td>
                </tr>
            @endforelse
        </table>
        <a href="{{ route('admin.pages.create', ['page_id' => $section->id]) }}" class="btn-add-section">Добавить страницу</a>
    </div>
</div>