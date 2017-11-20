<div class="content__pane" id="parsed-treatments">
    @include('admin.treatments.filter')
    <div class="divider"></div>
    <div class="button-container">
        <a href="{{ route('admin.treatments') }}" class="btn-filter-clear">Очистить фильтр</a>
        <button form="filter" type="submit" class="btn-filter">Отфильтровать</button>
    </div>
    <div class="divider"></div>
    <table class="table">
        <tr>
            <th>Обратил(ся/ась)</th>
            <th>Тип</th>
            <th>Тематика</th>
            <th>Управление</th>
            <th>Обработано</th>
        </tr>
        @forelse ($treatments as $treatment)
            <tr>
                <td>{{$treatment->firstname}} {{$treatment->lastname}}</td>
                <td>@lang('admin.' . $treatment->type )</td>
                <td>@lang('admin.' . $treatment->thematic )</td>
                <td><a href="{{ route('admin.treatment-answers.index', ['treatment' => $treatment->id]) }}">Ответить повторно</a></td>
                <td>{{ $treatment->updated_at->diffForHumans()}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center;">Обращения не найдены</td>
            </tr>
        @endforelse
    </table>
</div>