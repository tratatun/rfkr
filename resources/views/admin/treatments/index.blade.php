@extends('admin.layout')

@section('content')
    @include('admin.parts.menu')
    <div class="admin-treatments">
        <h1 class="login__caption">Обращения</h1>
        <h6 class="login__subcaption">Просмотр обращений и формирование ответов</h6>
        <div class="tabs">
            <ul class="tabs__header">
                <li class="header__item"><a class="tabs-switch active" href="#new-treatments">Новые</a></li>
                <li class="header__item"><a class="tabs-switch" href="#parsed-treatments">Обработанные</a></li>
            </ul>
            <div class="tabs__content">
                @include('admin.treatments.news', ['treatments' => $newTreatments])
                @include('admin.treatments.olds', ['treatments' => $oldTreatments])
            </div>
        </div>
    </div>
@endsection