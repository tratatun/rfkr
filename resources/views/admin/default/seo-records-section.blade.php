<div class="toogle__body__top-row">
    <div class="top-row__title">Рекламные записи (SEO)</div>
    <a href="{{ route('admin.seo-records.create') }}" class="top-row__add-btn">Добавить</a>
</div>
<table class="table">
    <tr>
        <th>Название</th>
        <th>Доступ</th>
        <th>Управление</th>
        <th>Добавлена</th>
        <th>Последнее изменение</th>
    </tr>
    @forelse($seoRecords as $seoRecord)
        <tr>
            <td>{{ $seoRecord->title }}</td>
            <td>@lang('admin.' . $seoRecord->status)</td>
            <td><a href="{{ route('admin.seo-records.edit', ['page' => $seoRecord->id]) }}" class="link-change">Изменить</a></td>
            <td>{{ $seoRecord->created_at->diffForHumans() }} ({{ $seoRecord->user->getFirstName() }})</td>
            <td>{{ $seoRecord->updated_at->diffForHumans() }} ({{ $seoRecord->userUpdated->getFirstName() }})</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" style="text-align: center">SEO записей не найдено</td>
        </tr>
    @endforelse
</table>




