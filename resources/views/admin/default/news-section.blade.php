<div class="toogle__body__top-row">
    <div class="top-row__title">Новости</div>
    <a  href="{{ route('admin.news.create') }}" class="top-row__add-btn">Добавить</a>
</div>
<table class="news-table table">
    <tr>
        <th>Название</th>
        <th>Управление</th>
        <th>Добавлена</th>
        <th>Последнее изменение</th>
    </tr>
    @forelse($news as $newsOne)
        <tr>
            <td>{{ $newsOne->title }}</td>
            <td><a href="{{ route('admin.news.edit', ['page' => $newsOne->id]) }}" class="link-change">Изменить</a></td>
            <td>{{ $newsOne->created_at->diffForHumans() }} ({{ $newsOne->user->getFirstName() }})</td>
            <td>{{ $newsOne->updated_at->diffForHumans() }} ({{ $newsOne->userUpdated->getFirstName() }})</td>
        </tr>
    @empty
        <tr>
            <td colspan="4" style="text-align: center">Новостей не найдено</td>
        </tr>
    @endforelse
</table>





