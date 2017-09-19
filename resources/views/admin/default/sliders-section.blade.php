<div class="toogle__body__top-row">
    <div class="top-row__title">Слайдер</div>
    <a href="{{ route('admin.sliders.create') }}" class="top-row__add-btn">Добавить</a>
</div>
<table class="table">
    <tr>
        <th>Название</th>
        <th>Управление</th>
        <th>Добавлена</th>
        <th>Последнее изменение</th>
    </tr>
    @forelse($sliders as $slider)
        <tr>
            <td>{{ $slider->title }}</td>
            <td><a href="{{ route('admin.sliders.edit', ['page' => $slider->id]) }}" class="link-change">Изменить</a></td>
            <td>{{ $slider->created_at->diffForHumans() }} ({{ $slider->user->getFirstName() }})</td>
            <td>{{ $slider->updated_at->diffForHumans() }} ({{ $slider->userUpdated->getFirstName() }})</td>
        </tr>
    @empty
        <tr>
            <td colspan="4" style="text-align: center">Обложек не найдено</td>
        </tr>
    @endforelse
</table>
