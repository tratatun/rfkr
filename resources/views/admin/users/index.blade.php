@extends('admin.layout')
@section('content')
    @include('admin.parts.menu')
    <div class="admin-team">
        <h1 class="login__caption">Команда</h1>
        <h6 class="login__subcaption">Добавление администраторов ресурса и управление ролями</h6>
        <div class="divider"></div>
        <table class="table">
            <tr>
                <th>Имя</th>
                <th>Почтовый ящик</th>
                <th>Роль</th>
                <th>Статус</th>
                <th>Управление</th>
                {{--<th>Последнее действие</th>--}}
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@lang('admin.' . $user->role)</td>
                    <td>
                        @if ($user->status === 'active')
                            Активный
                        @else
                            Заблокированный
                        @endif
                    </td>
                    <td><a href="{{ route('admin.users.edit', ['id' =>$user->id]) }}" class="btn-change">Изменить</a></td>
                    {{--<td><span class="last-visit-time">21:12</span><span> / </span><span class="last-visit-data">21 авг ’17</span></td>--}}
                </tr>
            @endforeach
        </table>
        <div class="divider"></div>
        <div class="button-container">
            <a href="{{ route('admin.users.create') }}" class="btn-add btn-add-admin">Добавить администратора</a>
        </div>
    </div>
@endsection