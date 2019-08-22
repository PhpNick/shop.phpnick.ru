<footer id="footer"><!--Footer-->

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Информация</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Помощь</a></li>
                            <li><a href="#">Условия оплаты</a></li>
                            <li><a href="#">Условия доставки</a></li>
                            <li><a href="#">Гарантия на товар</a></li>
                            <li><a href="#">Возможности</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Помощь</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Вопрос-ответ</a></li>
                            <li><a href="#">Бренды</a></li>
                            <li><a href="#">Обзоры</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Компания</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">О компании</a></li>
                            <li><a href="#">Новости</a></li>
                            <li><a href="#">Сотрудники</a></li>
                            <li><a href="#">Вакансии</a></li>
                            <li><a href="#">Политика</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>Будьте всегда в курсе!</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Ваш e-mail" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p>Получайте саме свежие новости с нашего сайта</p>
                        </form>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>Наши контакты</h2>
                        <ul class="nav nav-pills">
                            <li><a rel="nofollow" href="tel:+70000000010"><i class="fa fa-phone"></i>&nbsp;&nbsp;+7 (000) 000-00-10</a></li>
                            <li><a href="mailto:info@domain.com" target="_blank"><i class="fa fa-envelope"></i>info@domain.com</a></li>
                            <li><a rel="nofollow" href="#"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Екатеринбург, ул. Лермонтова 17, 3 этаж, офис 4 </a>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © {{date("Y")}} E-Shopper – универсальный интернет-магазин </p>
                <p class="pull-right">Дизайн от <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->

<div id="itemAddedToCart" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Товар добавлен в корзину</h4>
            </div>
            <div class="modal-body">
                Содержимое модального окна...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Продолжить покупки</button>
                <a href="{{route('cartproducts')}}" type="button" class="btn btn-primary">Перейти в корзину</a>
            </div>
        </div>
    </div>
</div>

<div id="ajaxSearch" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Результаты поиска</h4>
            </div>
            <div class="modal-body">
                
            </table>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('js/price-range.js')}}"></script>
<script src="{{asset('js/lightbox.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script>
    lightbox.option({
      'albumLabel': 'Изображение %1 из %2',
      'wrapAround': true
    })    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    @yield('ajax')
</script>
</body>
</html>