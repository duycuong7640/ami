<script type="text/javascript" src="{{ asset('/web/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/web/js/bootstrap/bootstrap.min.js') }}" async></script>
<script type="text/javascript" src="{{ asset('/web/js/menu/ddsmoothmenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('/web/js/app.js') }}" async></script>
<script type="text/javascript" src="{{ asset('/web/wow/js/wow.min.js') }}"></script>
@yield('scripts')
<script type="text/javascript">
    var ww = document.body.clientWidth;
    if (ww < 700) {
        $("ul.navmenu").addClass("classArrow");
    }

    ddsmoothmenu.init({
        mainmenuid: "smoothmenu1",
        orientation: 'h',
        classname: 'ddsmoothmenu',
        contentsource: "markup"
    });

    $(window).scroll(function () {
        var widthScreen = $(window).width();
        var cach_top = $(window).scrollTop();
        if (widthScreen > 1024) {
            var heightHeader = $('.wrap_header').height();
            if (cach_top >= heightHeader) {
                $('.wrap_header').addClass('fix-header');
            } else {
                $('.wrap_header').removeClass('fix-header');
            }
        } else {
            var heightHeader = $('#header').height();
            if (cach_top >= heightHeader) {
                $('#header').addClass('fix-header');
            } else {
                $('#header').removeClass('fix-header');
            }
        }
    });
</script>
@if(!empty($mobile) && !$mobile)
    <script type="text/javascript" src="{{ asset('/web/js/menu_mobile.js') }}" async></script>
@endif
<script>
    new WOW().init();
</script>