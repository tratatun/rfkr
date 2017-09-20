<div class="toogle">
    <div class="toogle__header"><a href="#admin-section-{{ $index }}" data-role="toogle">{{$section->title}}</a></div>
    <div class="toogle__body" id="admin-section-{{ $index }}">
        <table class="table">
            <tr>
                <th>Название раздела</th>
                <th>Доступ</th>
                <th>Управление разделом</th>
                <th>Добавлен раздел</th>
                <th>Последнее изменение раздела</th>
            </tr>
            <tr>
                <td>{{ $section->title }}</td>
                <td>@lang('admin.' . $section->status)</td>
                <td><a href="{{ route('admin.pages.edit', ['page' => $section->id]) }}" class="link-change">Изменить</a></td>
                <td>{{ $section->created_at->diffForHumans() }} ({{ $section->user->getFirstName() }})</td>
                <td>{{ $section->updated_at->diffForHumans() }} ({{ $section->userUpdated->getFirstName() }})</td>
            </tr>
        </table>
        <br>
        <table class="table">
            <tr>
                <th>Название</th>
                <th>Доступ</th>
                <th>Управление</th>
                <th>Добавлена</th>
                <th>Последнее изменение</th>
            </tr>
            @forelse($section->subPages as $page)
                <tr>
                    <td>{{ $page->title }}</td>
                    <td>@lang('admin.' . $page->status)</td>
                    <td><a href="{{ route('admin.pages.edit', ['page' => $page->id]) }}" class="link-change">Изменить</a></td>
                    <td>{{ $page->created_at->diffForHumans() }} ({{ $page->user->getFirstName() }})</td>
                    <td>{{ $page->updated_at->diffForHumans() }} ({{ $page->userUpdated->getFirstName() }})</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center">Страниц не найдено</td>
                </tr>
            @endforelse
        </table>
        <a href="{{ route('admin.pages.create', ['page_id' => $section->id]) }}" class="btn-add-section">Добавить страницу</a>
    </div>
</div>