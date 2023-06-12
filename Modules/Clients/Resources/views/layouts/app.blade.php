<!DOCTYPE html>
<html lang="{{ !empty($_SESSION["lang"]) ? str_replace("_", "", $_SESSION["lang"]) : "en" }}">
<head>
    @include('clients::elements.extend.meta')
    @include('clients::elements.extend.style')
</head>
<body>
{!! !empty($data_common['setting']->code_body) ? $data_common['setting']->code_body : '' !!}
<div class="wrap-header-abs absolute">
    @include('clients::elements.header')
</div>
@yield('content')
@include('clients::elements.footer')
@include('clients::elements.extend.script')
</body>
</html>