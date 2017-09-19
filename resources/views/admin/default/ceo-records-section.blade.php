<div class="toogle__body__top-row">
    <div class="top-row__title">Рекламные записи (SEO)</div>
    <div class="top-row__add-btn">Добавить</div>
</div>
<table class="table">
    <tr>
        <td>Рекламная запись один</td>
        <td>1</td>
        <td><a href="" class="link-change">Изменить</a></td>
        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
    </tr>
    <tr>
        <td>Рекламная запись два</td>
        <td>2</td>
        <td><a href="" class="link-change">Изменить</a></td>
        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
    </tr>
    <tr>
        <td>Рекламная запись три</td>
        <td>3</td>
        <td><a href="" class="link-change">Изменить</a></td>
        <td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span><span class="specialist"> (petr)</span></td>
    </tr>
</table>



{{--<div class="toogle__body__top-row">--}}
    {{--<div class="top-row__title">Новости</div>--}}
    {{--<a  href="{{ route('admin.news.create') }}" class="top-row__add-btn">Добавить</a>--}}
{{--</div>--}}
{{--<table class="news-table table">--}}
    {{--<tr>--}}
        {{--<th>Название</th>--}}
        {{--<th>Управление</th>--}}
        {{--<th>Добавлена</th>--}}
        {{--<th>Последнее изменение</th>--}}
    {{--</tr>--}}
    {{--@forelse($news as $newsOne)--}}
        {{--<tr>--}}
            {{--<td>{{ $newsOne->title }}</td>--}}
            {{--<td><a href="{{ route('admin.news.edit', ['page' => $newsOne->id]) }}" class="link-change">Изменить</a></td>--}}
            {{--<td>{{ $newsOne->created_at->diffForHumans() }} ({{ $newsOne->user->getFirstName() }})</td>--}}
            {{--<td>{{ $newsOne->updated_at->diffForHumans() }} ({{ $newsOne->userUpdated->getFirstName() }})</td>--}}
        {{--</tr>--}}
    {{--@empty--}}
        {{--<tr>--}}
            {{--<td colspan="4" style="text-align: center">Новостей не найдено</td>--}}
        {{--</tr>--}}
    {{--@endforelse--}}
{{--</table>--}}





