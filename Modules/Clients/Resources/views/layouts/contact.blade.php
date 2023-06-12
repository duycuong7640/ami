<!DOCTYPE html>
<html lang="{{ !empty($_SESSION["lang"]) ? str_replace("_", "", $_SESSION["lang"]) : "en" }}">
<head>
    @include('clients::elements.extend.meta')
    @include('clients::elements.extend.style')
</head>
<body>
{!! !empty($data_common['setting']->code_body) ? $data_common['setting']->code_body : '' !!}
<div class="wrap_header">
@include('clients::elements.header')
@include('clients::elements.menu')
</div>
<div class="main-width">
    @include('clients::elements.extend.breadcrumb')
    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            @yield('content')
        </div>
    </div>
</div>
@include('clients::elements.footer')
@include('clients::elements.extend.script')
</body>
</html>