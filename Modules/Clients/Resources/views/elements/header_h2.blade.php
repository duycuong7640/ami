<header id="header">
    <div class="main-width">
        <div class="row no-gutters">
            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                <div class="logo-main">
                    <a href="{{ route("client.home") }}" title="">
                        <img src="{{ !empty($data_common['logo']->thumbnail2) ? asset($data_common['logo']->thumbnail2) : '' }}" title="" alt="">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-9 col-lg-9 col-xl-9">
                <div class="wrap-lang">
                    <a target="_blank" href="https://app.ami-solution.com.vn/" class="mb-hid">
                        {{ \App\Helpers\Helpers::langDefine('Kinh doanh cùng ami') }}
                    </a>
                    <a href="{{ route('client.category.index', ['slug' => $data['truso']->slug]) }}"  class="mb-hid" title="{{ \App\Helpers\Helpers::lang($data['truso'], "title") }}">
                        {{ \App\Helpers\Helpers::lang($data['truso'], "title") }}
                    </a>
                    <img src="{{ asset('web/images/icon/lang.png') }}" style="width: 18px; margin-top: -2px;" title="" alt="">
                    <select>
                        <option>Vietnamese (VN) </option>
                        <option>English (EN) </option>
                    </select>
                </div>
                <div class="clear"></div>
                @include('clients::elements.menu_h2')
            </div>
        </div>
    </div>
</header>