<link rel="stylesheet" href="{{ asset('/web/css/bootstrap/bootstrap.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('/web/font-awesome-4.7.0/css/font-awesome.css') }}"/>
<link rel="stylesheet" href="{{ asset('/web/css/menu/ddsmoothmenu.css') }}?v={{ time()}}"/>
@yield('style')
{{--<link rel="stylesheet" href="{{ asset('/static/client/css/fonts.css') }}"/>--}}
<link rel="stylesheet" href="{{ asset('/web/wow/css/animate.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('/web/css/style.css') }}?v={{ time() }}"/>
<link rel="stylesheet" href="{{ asset('/web/css/responsive.css') }}?v={{ time() }}"/>
@if(!empty($data["show"]))
<link rel="stylesheet" href="{{ asset('/web/css/ftoc.css') }}"/>
@endif
@if(!empty($mobile) && !$mobile)
<link rel="stylesheet" href="{{ asset('/web/css/menu_mobile.css') }}"/>
@endif
