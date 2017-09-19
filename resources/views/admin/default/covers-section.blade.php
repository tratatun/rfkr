<div class="toogle__body__top-row">
    <div class="top-row__title">Обложка</div>
    <a href="{{ route('admin.covers.create') }}" class="top-row__add-btn">Добавить</a>
</div>
<table class="table">
    <tr>
        <th>Название</th>
        <th>Управление</th>
        <th>Добавлена</th>
        <th>Последнее изменение</th>
    </tr>
    @forelse($covers as $cover)
        <tr>
            <td>{{ $cover->title }}</td>
            <td><a href="{{ route('admin.covers.edit', ['page' => $cover->id]) }}" class="link-change">Изменить</a></td>
            <td>{{ $cover->created_at->diffForHumans() }} ({{ $cover->user->getFirstName() }})</td>
            <td>{{ $cover->updated_at->diffForHumans() }} ({{ $cover->userUpdated->getFirstName() }})</td>
        </tr>
    @empty
        <tr>
            <td colspan="4" style="text-align: center">Обложек не найдено</td>
        </tr>
    @endforelse
</table>




