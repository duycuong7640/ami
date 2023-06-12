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
</div>
<div class="main-width pt-3 pb-4">
    <div class="row no-gutters">
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="pr-4 fix-pr-4 nopadd">
                @include('clients::elements.extend.breadcrumb')
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('clients::elements.footer')
@include('clients::elements.extend.script')
</body>
</html>