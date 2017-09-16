@extends('main.layout')

@section('content')
    @include('main.parts.header-close')
    <div class="agree-container" id="top">
        <div class="agree">
            <h1 class="agree__caption">Оставить обращение</h1>
            <h6 class="agree__subcaption">Соглашение обработки персональных данных</h6>
            <p class="agree-text__first-part">Я ознакомлен и согласен с тем, что:</p>
            <p class="agree-text__second-part">
                Обработка моих персональных данных производится в соответствии с требованиями Федерального закона от 27 июля 2006 г. №152-ФЗ «О персональных данных»
                и необходима в соответствии с пунктом 4 части 1 статьи 6 указанного Федерального закона
                для предоставления государственной или муниципальной услуги в соответствии
                с Федеральным законом от 27 июля 2010 г. №210-ФЗ «Об организации предоставления государственных и муниципальных услуг»,
                для обеспечения предоставления такой услуги;
                в соответствии с частью 4 статьи 7 Федерального закона от 27 июля 2010 г. №210-ФЗ
                «Об организации предоставления государственных и муниципальных услуг»
                не требуется моего согласия для обработки органами, предоставляющими государственные услуги, органами, предоставляющими муниципальные услуги, иными государственными органами, органами местного самоуправления, подведомственными государственным органам или органам местного самоуправления организациями, участвующими в предоставлении предусмотренных частью 1 статьи 1 Федерального закона от 27 июля 2010 г. №210-ФЗ
                «Об организации предоставления государственных и муниципальных услуг» государственных и муниципальных услуг, моих персональных данных в целях предоставления указанных персональных данных, имеющихся в распоряжении таких органов или организаций, в орган, предоставляющий государственную услугу, орган, предоставляющий муниципальную услугу, либо подведомственную государственному органу или органу местного самоуправления организацию, участвующую в предоставлении
                предусмотренных частью 1 статьи 1 Федерального закона от 27 июля 2010 г. №210-ФЗ
                «Об организации предоставления государственных и муниципальных услуг»
                государственных и муниципальных услуг, либо многофункциональный центр на основании межведомственных запросов таких органов или организаций для предоставления государственной или муниципальной услуги по моему запросу;
                оператор, осуществляющий обработку моих персональных данных, вправе в соответствии с частью 3 статьи 6 Федерального закона от 27 июля 2006 г. №152-ФЗ «О персональных данных» поручить обработку моих персональных данных другому лицу
                на основании заключаемого с этим лицом договора, в том числе государственного контракта, либо путем принятия соответствующего акта.
            </p>
            <div class="divider"></div>
            <div class="btn-container">
                <a href="/" class="btn-cancel">Отменить</a>
                <a href="/treatment" class="btn-continue">Я согласен</a>
            </div>
        </div>
    </div>
@endsection