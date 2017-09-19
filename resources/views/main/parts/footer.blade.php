<div class="footer-wrapper">
    <footer class="footer">
        <h6 class="footer__caption">Структура сайта</h6>
        <div class="footer__content">
            @foreach ($sections as $section)
                <ul class="content__col">
                    <li class="content__col__item"><a class="footer-link item__link" href="{{$section->url()}}">{{ $section->title }}</a></li>
                    <ul class="content-col__sublist">
                        @foreach ($section->subPages as $page)
                            <li class="sublist-item"><a class="footer-link sublist-item__link" href="{{ url($page->url()) }}">{{ $page->title }}</a></li>
                        @endforeach
                    </ul>
            </ul>
            @endforeach
        </div>
        <div class="footer__bottom">
            <div class="social-block"><a class="social-block__link" href="/" target="_blank">
                    <svg class="link__icon link__icon_youtube" role="img">
                        <use xlink:href="/assets/images/svg-sprite.svg#shape-youtube"></use>
                    </svg></a><a class="social-block__link" href="/" target="_blank">
                    <svg class="link__icon link__icon_instagram" role="img">
                        <use xlink:href="/assets/images/svg-sprite.svg#shape-instagram"></use>
                    </svg></a><a class="social-block__link" href="/" target="_blank">
                    <svg class="link__icon link__icon_odnoklassniki" role="img">
                        <use xlink:href="/assets/images/svg-sprite.svg#shape-odnoklassniki"></use>
                    </svg></a><a class="social-block__link" href="/" target="_blank">
                    <svg class="link__icon link__icon_facebook" role="img">
                        <use xlink:href="/assets/images/svg-sprite.svg#shape-facebook"></use>
                    </svg></a><a class="social-block__link" href="/" target="_blank">
                    <svg class="link__icon link__icon_vk" role="img">
                        <use xlink:href="/assets/images/svg-sprite.svg#shape-vk"></use>
                    </svg></a>
            </div>
            <div class="copyright">НО РФ КРМД РК • 2017 • Материалы доступны по лицензии: CCA 4.0 International</div>
            <div class="btn-up animate-anchor" data-id="#top">
                <svg class="btn-up__icon btn-up__icon_default" role="img">
                    <use xlink:href="/assets/images/svg-sprite.svg#shape-arrow-up"></use>
                </svg>
                <svg class="btn-up__icon btn-up__icon_hover" role="img">
                    <use xlink:href="/assets/images/svg-sprite.svg#shape-arrow-up-blue"></use>
                </svg>
            </div>
        </div>
    </footer>
</div>