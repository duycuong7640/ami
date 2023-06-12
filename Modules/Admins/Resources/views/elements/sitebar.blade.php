<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item navbar-brand-mini-wrapper">
            <a class="nav-link navbar-brand brand-logo-mini" href="{{ route('admin.index') }}">
                <img src="{{ asset('/static/admin/assets/images/logo-mini.svg') }}" alt="logo"/>
            </a>
        </li>
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{ asset('/static/admin/assets/images/faces/face8.jpg') }}" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{ substr(\Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard())->user()->name, 0, 15) }}</p>
                    <p class="designation">{{ substr(\Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard())->user()->username, 0, 15) }}</p>
                </div>
                {{--<div class="icon-container">--}}
                    {{--<i class="icon-bubbles"></i>--}}
                    {{--<div class="dot-indicator bg-danger"></div>--}}
                {{--</div>--}}
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">@lang('admins::layer.dashboard.title')</span>
        </li>
        <li class="nav-item {{ Request::routeIs('client.home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('client.home') }}" target="_blank">
                <span class="menu-title">@lang('admins::layer.menu.parent.home')</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">@lang('admins::layer.menu.parent.function')</span>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.category.*')? 'active' : '' }} {{ Request::routeIs('admin.post.*')? 'active' : '' }}  {{ Request::routeIs('admin.postthree.*')? 'active' : '' }} {{ Request::routeIs('admin.posttwo.*')? 'active' : '' }} {{ Request::routeIs('admin.product.*')? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-expanded="false"
               aria-controls="basic-ui">
                <span class="menu-title">@lang('admins::layer.menu.parent.post')</span>
                <i class="icon-layers menu-icon"></i>
            </a>
            <div class="collapse {{ Request::routeIs('admin.category.*')? 'show' : '' }} {{ Request::routeIs('admin.post.*')? 'show' : '' }} {{ Request::routeIs('admin.postthree.*')? 'show' : '' }} {{ Request::routeIs('admin.posttwo.*')? 'show' : '' }} {{ Request::routeIs('admin.product.*')? 'show' : '' }} {{ Request::routeIs('admin.version.*')? 'show' : '' }}" id="basic-ui">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.category.*')? 'active' : '' }}" href="{{ route('admin.category.index') }}">@lang('admins::layer.menu.parent.post.category.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.post.*')? 'active' : '' }}" href="{{ route('admin.post.index') }}">@lang('admins::layer.menu.parent.post.post.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.posttwo.*')? 'active' : '' }}" href="{{ route('admin.posttwo.index') }}">Về ami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.postthree.*')? 'active' : '' }}" href="{{ route('admin.postthree.index') }}">Trụ sở</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.product.*')? 'active' : '' }}" href="{{ route('admin.product.index') }}">@lang('admins::layer.menu.parent.product.product.title')</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link {{ Request::routeIs('admin.version.*')? 'active' : '' }}" href="{{ route('admin.version.index_version') }}">@lang('admins::layer.menu.parent.product.product.title_version')</a>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.fixone.*')? 'active' : '' }} {{ Request::routeIs('admin.fixtwo.*')? 'active' : '' }} {{ Request::routeIs('admin.fixthree.*')? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#basic-ui1" aria-expanded="false"
               aria-controls="basic-ui1">
                <span class="menu-title">Ứng dụng</span>
                <i class="icon-layers menu-icon"></i>
            </a>
            <div class="collapse {{ Request::routeIs('admin.fixone.*')? 'show' : '' }} {{ Request::routeIs('admin.fixtwo.*')? 'show' : '' }}  {{ Request::routeIs('admin.fixthree.*')? 'show' : '' }} " id="basic-ui1">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.fixone.*')? 'active' : '' }}" href="{{ route('admin.fixone.index') }}">Giấc mơ sức sống việt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.fixtwo.*')? 'active' : '' }}" href="{{ route('admin.fixtwo.index') }}">Lĩnh vực hoạt động</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.fixthree.*')? 'active' : '' }}" href="{{ route('admin.fixthree.index') }}">Ban lãnh đạo</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.advertisement.*')? 'active' : '' }} {{ Request::routeIs('admin.advone.*')? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#basic-ui2" aria-expanded="false"
               aria-controls="basic-ui2">
                <span class="menu-title">Quảng cáo</span>
                <i class="icon-layers menu-icon"></i>
            </a>
            <div class="collapse {{ Request::routeIs('admin.advertisement.*')? 'show' : '' }} {{ Request::routeIs('admin.advone.*')? 'show' : '' }}" id="basic-ui2">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.advertisement.*')? 'active' : '' }}" href="{{ route('admin.advertisement.index') }}">Quảng cáo sitebar top</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.advone.*')? 'active' : '' }}" href="{{ route('admin.advone.index') }}">Quảng cáo sitebar bottom</a>
                    </li>
                </ul>
            </div>
        </li>
{{--        <li class="nav-item {{ Request::routeIs('admin.crawler.*')? 'active' : '' }}">--}}
{{--            <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-expanded="false"--}}
{{--               aria-controls="basic-ui">--}}
{{--                <span class="menu-title">@lang('admins::layer.menu.parent.crawler')</span>--}}
{{--                <i class="icon-layers menu-icon"></i>--}}
{{--            </a>--}}
{{--            <div class="collapse {{ Request::routeIs('admin.crawler.*')? 'show' : '' }}" id="basic-ui">--}}
{{--                <ul class="nav flex-column sub-menu">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link {{ Request::routeIs('admin.crawler.website.*')? 'active' : '' }}" href="{{ route('admin.crawler.website.index') }}">@lang('admins::layer.menu.parent.crawler.website.title')</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link {{ Request::routeIs('admin.post.*')? 'active' : '' }}" href="{{ route('admin.post.index') }}">@lang('admins::layer.menu.parent.post.post.title')</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link {{ Request::routeIs('admin.product.*')? 'active' : '' }}" href="{{ route('admin.product.index') }}">@lang('admins::layer.menu.parent.product.product.title')</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}
{{--        <li class="nav-item {{ Request::routeIs('admin.cart.*')? 'active' : '' }}">--}}
{{--            <a class="nav-link" href="{{ route('admin.cart.index') }}">--}}
{{--                <span class="menu-title">Giỏ hàng</span>--}}
{{--                <i class="icon-doc menu-icon"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item {{ Request::routeIs('admin.link.*')? 'active' : '' }}">--}}
{{--            <a class="nav-link" href="{{ route('admin.link.index') }}">--}}
{{--                <span class="menu-title">Liên kết</span>--}}
{{--                <i class="icon-doc menu-icon"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item {{ Request::routeIs('admin.logo.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.logo.index') }}">
                <span class="menu-title">Logo</span>
                <i class="icon-doc menu-icon"></i>
            </a>
        </li>
{{--        <li class="nav-item {{ Request::routeIs('admin.slideshow.*')? 'active' : '' }}">--}}
{{--            <a class="nav-link" href="{{ route('admin.slideshow.index') }}">--}}
{{--                <span class="menu-title">Slide</span>--}}
{{--                <i class="icon-doc menu-icon"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item {{ Request::routeIs('admin.fixfourth.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.fixfourth.index') }}">
                <span class="menu-title">Drag home</span>
                <i class="icon-doc menu-icon"></i>
            </a>
        </li>
{{--        <li class="nav-item {{ Request::routeIs('admin.redirect.*')? 'active' : '' }}">--}}
{{--            <a class="nav-link" href="{{ route('admin.redirect.index') }}">--}}
{{--                <span class="menu-title">Redirect url</span>--}}
{{--                <i class="mdi mdi-doc menu-icon"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item {{ Request::routeIs('admin.comment.*')? 'active' : '' }}">--}}
{{--            <a class="nav-link" href="{{ route('admin.comment.index') }}">--}}
{{--                <span class="menu-title">Bình luận</span>--}}
{{--                <i class="mdi mdi-doc menu-icon"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item {{ Request::routeIs('admin.setting.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.setting.update',["id" => 1]) }}">
                <span class="menu-title">Cấu hình website</span>
                <i class="mdi mdi-settings-box menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.account.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.account.index') }}">
                <span class="menu-title">Tài khoản</span>
                <i class="icon-bell menu-icon"></i>
            </a>
        </li>
{{--        <li class="nav-item {{ Request::routeIs('admin.mailtemplate.*')? 'active' : '' }}">--}}
{{--            <a class="nav-link" href="{{ route('admin.mailtemplate.index') }}">--}}
{{--                <span class="menu-title">Mail template</span>--}}
{{--                <i class="icon-bell menu-icon"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
</nav>