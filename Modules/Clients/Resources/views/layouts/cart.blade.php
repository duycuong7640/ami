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
<div class="main-width">
    @include('clients::elements.extend.breadcrumb')
    <div class="row no-gutters mb-5">
        @if(\Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check())
            <div class="col-12 col-md-3 col-lg-2 col-xl-2">
                @include('clients::elements.sitebar-user')
            </div>
            <div class="col-12 col-md-9 col-lg-10 col-xl-10">
                <div class="pl-4 fix-pr-4">
                    @yield('content')
                </div>
            </div>
        @else
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                @yield('content')
                </div>
        @endif
    </div>
</div>
@include('clients::elements.footer')
@include('clients::elements.extend.script')
</body>
</html>