<form id="filter" action="{{ route('admin.treatments') }}" method="get">
    <div class="form-group-block">
        <div class="form-row">
            <div class="form-group col-2">
                <label class="form-group__label">Специалист</label>
                <select class="form-group__select" name="user_id">
                    <option class="select__option" value=""></option>
                    @foreach($users as $user)
                        <option class="select__option" value="{{ $user->id }}"
                                {{request()->query('user_id') === $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-2">
                <label class="form-group__label">Статус</label>
                <select class="form-group__select" name="status">
                    <option class="select__option" value=""></option>
                    <option class="select__option" value="closed"
                            {{request()->query('status') === "closed" ? 'selected' : ''}}>Обработано</option>
                    <option class="select__option" value="spamed"
                            {{request()->query('status') === "spamed" ? 'selected' : ''}}>Спам</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-2">
                <label class="form-group__label">Период от</label>
                <input type='text' class="datepicker-here" name="date_from" value="{{ request()->query('date_from') }}"
                       data-date-format="yyyy-mm-dd" />
            </div>
            <div class="form-group col-2">
                <label class="form-group__label">Период до</label>
                <input type='text' class="datepicker-here" name="date_to"  value="{{ request()->query('date_to') }}"
                       data-date-format="yyyy-mm-dd" />
            </div>
        </div>
    </div>
</form>