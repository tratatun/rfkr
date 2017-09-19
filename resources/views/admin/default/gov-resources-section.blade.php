<div class="toogle__body__top-row">
    <div class="top-row__title">Ссылки на смежные ресурсы</div>
    <a href="{{ route('admin.gov-resources.create') }}" class="top-row__add-btn">Добавить</a>
</div>
<table class="table">
    <tr>
        <th>Название</th>
        <th>Управление</th>
        <th>Добавлена</th>
        <th>Последнее изменение</th>
    </tr>
    @forelse($govResources as $govResource)
        <tr>
            <td>{{ $govResource->title }}</td>
            <td><a href="{{ route('admin.gov-resources.edit', ['page' => $govResource->id]) }}" class="link-change">Изменить</a></td>
            <td>{{ $govResource->created_at->diffForHumans() }} ({{ $govResource->user->getFirstName() }})</td>
            <td>{{ $govResource->updated_at->diffForHumans() }} ({{ $govResource->userUpdated->getFirstName() }})</td>
        </tr>
    @empty
        <tr>
            <td colspan="4" style="text-align: center">Ссылки на смежные ресурсы не найдены</td>
        </tr>
    @endforelse
</table>


