<div class="content__pane" id="parsed-treatments">
    <form id="filter" action="{{ route('admin.treatments') }}" method="get">
        <div class="form-group-block ">
            <div class="form-group col-4">
                <label class="form-group__label">Специалист</label>
                <select class="form-group__select" name="specialist">
                    <option class="select__option" value="oleg">oleg</option>
                    <option class="select__option" value="petr">petr</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label class="form-group__label">Статус</label>
                <select class="form-group__select" name="status">
                    <option class="select__option" value="process">В работе</option>
                    <option class="select__option" value="parsed">Обработано</option>
                    <option class="select__option" value="spam">Спам</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label class="form-group__label">Период от</label>
                <select class="form-group__select" name="periodFrom">
                    <option class="select__option" value="january17">янв ‘17</option>
                    <option class="select__option" value="march17">март ‘17</option>
                    <option class="select__option" value="february17">фев ‘17</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label class="form-group__label">Период до</label>
                <select class="form-group__select" name="periodTo">
                    <option class="select__option" value="today">Сегодня</option>
                    <option class="select__option" value="week">Неделя</option>
                    <option class="select__option" value="month">Месяц</option>
                </select>
            </div>
        </div>
    </form>
    <div class="divider"></div>
    <div class="button-container">
        <a href="{{ route('admin.treatments') }}" class="btn-filter-clear">Очистить фильтр</a>
        <button form="filter" type="submit" class="btn-filter">Отфильтровать</button>
    </div>
    <div class="divider"></div>
    <table class="table">
        <tr>
            <th>Тип</th>
            <th>Тематика</th>
            <th>Управление</th>
            <th>Обработано</th>
        </tr>
        @forelse ($treatments as $treatment)
            <tr>
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