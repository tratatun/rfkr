<div class="content__pane visible" id="new-treatments">
    <table class="table">
        <tr>
            <th>Тип</th>
            <th>Тематика</th>
            <th>Управление</th>
            <th>Дата добавления</th>
        </tr>
        @forelse ($treatments as $treatment)
            <tr>
                <td>@lang('admin.' . $treatment->type )</td>
                <td>@lang('admin.' . $treatment->thematic )</td>
                <td><a href="/">Ответить</a></td>
                <td>{{ $treatment->created_at->diffForHumans()}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center;">Обращения не найдены</td>
            </tr>
        @endforelse
    </table>
</div>