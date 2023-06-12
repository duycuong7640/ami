@extends('clients::layouts.app')

@section('content')
    @foreach($data['drag_home'] as $row)
        <section id="slide-drag" class="relative">
            <div class="wrap-content-slide absolute">
                <div class="home-one-left absolute">
                    <div class="main-width-left w-720 absolute">
                        <div class="w-720 content-data absolute">
                            <label class="title">{!! \App\Helpers\Helpers::lang($row, "title") !!}</label>
                            <div>
                                <a href="{{ $row->url }}"
                                   title="">
                                    <button class="custom-button">{{ \App\Helpers\Helpers::langDefine('Xem thêm') }}</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="home-one-right absolute">
                    <div class="main-width-right w-720 absolute">
                        <div class="w-720 content-data absolute text-right">
                            <label class="title text-cd-custom">{!! \App\Helpers\Helpers::lang($row, "title2") !!}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <a class="wrapper-logo"></a>
                    </div>
                </div>
            </div>
            <section id="before-after">
                <div class="view view-after" style="width: 417px;">
                    <div class="wrapper-after" style="width: 1587px;">
                        <div class="img-bird-wrapper et-in-viewport-check et-in-viewport-floating_special"
                             et-anim="floating_special" et-anim-duration="3500" et-anim-delay="0" et-anim-easing="ease"
                             style="animation: 3500ms ease 0s 1 normal forwards running floating_special;">
                            <img src="{{ asset($row->thumbnail) }}">
                            <div class="tooltip-item tooltip-item-1" data-header-text="pos-item-1"
                                 style="display: none;"></div>
                            <div class="tooltip-item tooltip-item-2" data-header-text="pos-item-2"
                                 style="display: none;"></div>
                            <div class="tooltip-item tooltip-item-3" data-header-text="pos-item-3"
                                 style="display: none;"></div>
                            <div class="tooltip-item tooltip-item-4" data-header-text="pos-item-4"
                                 style="display: none;"></div>
                        </div>
                    </div>
                </div>
                <div class="view view-before">
                    <div class="wrapper-before">
                        <div class="img-bird-wrapper et-in-viewport-check et-in-viewport-floating_special"
                             et-anim="floating_special" et-anim-duration="3500" et-anim-delay="0" et-anim-easing="ease"
                             style="animation: 3500ms ease 0s 1 normal forwards running floating_special;">
                            <img src="{{ asset($row->thumbnail2) }}">
                            <div class="tooltip-item tooltip-item-1" data-header-text="pos-item-1"
                                 style="display: none;"></div>
                            <div class="tooltip-item tooltip-item-2" data-header-text="pos-item-2"
                                 style="display: none;"></div>
                            <div class="tooltip-item tooltip-item-3" data-header-text="pos-item-3"
                                 style="display: none;"></div>
                            <div class="tooltip-item tooltip-item-4" data-header-text="pos-item-4"
                                 style="display: none;"></div>
                        </div>
                    </div>
                </div>
                <div id="dragme"
                     style="transform: translate3d(0px, 0px, 0px); cursor: move; user-select: none; touch-action: none; left: 417px;">
                    <span class="icon-drag"></span>
                </div>
            </section>
        </section>
        @php break; @endphp
    @endforeach
    <section id="wrap-content">
        {{--        <section class="wrap-home-one relative">--}}
        {{--            <div class="b-img-ho">--}}
        {{--                <img src="{{ asset('web/images/bn1.png') }}" title="" alt=""/>--}}
        {{--            </div>--}}
        {{--            <div class="home-one-left absolute">--}}
        {{--                <div class="main-width-left w-720 absolute">--}}
        {{--                    <div class="w-720 content-data absolute">--}}
        {{--                        <label class="title">Mở ra cơ hội kinh doanh<br/>cho tất cả mọi người</label>--}}
        {{--                        <div>--}}
        {{--                            <a href="{{ !empty($data_common['setting']->url_dinhhuong) ? $data_common['setting']->url_dinhhuong : '' }}"--}}
        {{--                               title="">--}}
        {{--                                <button class="custom-button">Xem thêm</button>--}}
        {{--                            </a>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="home-one-right absolute">--}}
        {{--                <div class="main-width-right w-720 absolute">--}}
        {{--                    <div class="w-720 content-data absolute text-right">--}}
        {{--                        <label class="title text-cd-custom">Nắm bắt cơ hội<br/>thay đổi bản thân</label>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}
        @if(!empty($data['category_products']))
            <section class="wrap-home-two">
                <ul>
                    @foreach($data['category_products'] as $k=>$row)
                        <li class="{{ in_array($k, [1, 2, 5, 6, 9, 10, 13, 14, 17, 18, 21, 22, 25, 26, 29, 30]) ? 'other' : '' }}">
                            <div class="absolute mb-hid" style="background-size: cover !important; opacity: 1; background: url('{{ $row->thumbnail }}') no-repeat top -30px left; top: 0; left: 0; right: 0; bottom: 0;"></div>
                            <div class="absolute mb-hid" style="background: #1D3C6E; opacity: 0.3; top: 0; left: 0; right: 0; bottom: 0;"></div>
                            <div class="absolute border-1D3C6E">
                                <div class="{{ (($k % 2 === 0) ? 'main-width-left' : 'main-width-right') }} w-720 absolute">
                                    <div class="w-720 content-data absolute wow fadeInDown" data-wow-offset="2">
                                        <h2 class="title">
                                            <a href="{{ asset($row->slug) }}"
                                               title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                {{ \App\Helpers\Helpers::lang($row, "title") }}
                                            </a>
                                        </h2>
                                        <p>{!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 300) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
        <section class="wrap-home-three">
            <div class="main-width">
                <div class="wrap-data">
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/icon/ic1.svg') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft" data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('SẢN PHẨM HÀNG ĐẦU') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('sptopt') }}
                        </div>
                    </div>
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/icon/ic2.svg') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft" data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('SẢN PHẨM CHÍNH NGẠCH') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('spcn') }}
                        </div>
                    </div>
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/icon/ic3.svg') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft" data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('TIÊU DÙNG LÕI XANH') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('tdlx') }}
                        </div>
                    </div>
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/icon/ic4.svg') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft" data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('ĐA ĐIỂM CHẠM') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('ddc') }}
                        </div>
                    </div>
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/icon/ic5.svg') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft" data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('CỘNG ĐỒNG TIÊU DÙNG PHỦ KHẮP') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('cdtdpk') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(!empty($data['home_new']))
            <section class="wrap-home-fourth">
                <div class="main-width">
                    <div class="cate-title">
                        <a href="{{ route('client.category.index', ['slug' => $data['home_new']->slug]) }}" title="{{ \App\Helpers\Helpers::lang($data['home_new'], "title") }}">
                            {{ \App\Helpers\Helpers::lang($data['home_new'], "title") }}
                        </a>
                    </div>
                    <div class="cate-tab">
                        <ul>
                            @foreach($data['home_new_cate'] as $k=>$row)
                                <li class="ami-new-click {{ !$k ? 'active' : '' }}"
                                    data-id="{{ $row->id }}">{{ \App\Helpers\Helpers::lang($row, "title") }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @foreach($data['home_new_cate'] as $k=>$row)
                        <div class="wrap-news ami-new ami-new-{{ $row->id }}" style="{{ $k ? 'display: none;' : '' }}">
                            @if(!empty($data["home_new_cate_post"][$row->id]))
                                @foreach($data["home_new_cate_post"][$row->id] as $ki=>$i)
                                    @if(!$ki)
                                        <div class="new-hot">
                                            <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                               title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                <img src="{{ \App\Helpers\Helpers::renderThumb($i->thumbnail, 'new_hot') }}"
                                                     title="{{ \App\Helpers\Helpers::lang($i, "title") }}"
                                                     alt="{{ \App\Helpers\Helpers::lang($i, "title") }}"/>
                                            </a>
                                            <div class="content-data">
                                                <h3 class="wow fadeInRight" data-wow-offset="2">
                                                    <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                       title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                        {{ \App\Helpers\Helpers::lang($i, "title") }}
                                                    </a>
                                                </h3>
                                                <div class="shortdes wow fadeInLeft" data-wow-offset="2">
                                                    {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($i, "description"), 300) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="news-list">
                                    <ul>
                                        @foreach($data["home_new_cate_post"][$row->id] as $ki=>$i)
                                            @if($ki)
                                                <li>
                                                    <div class="item">
                                                        <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                           title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                            <img src="{{ \App\Helpers\Helpers::renderThumb($i->thumbnail, 'new_list') }}"
                                                                 title="{{ \App\Helpers\Helpers::lang($i, "title") }}"
                                                                 alt="{{ \App\Helpers\Helpers::lang($i, "title") }}"/>
                                                        </a>
                                                        <div class="content-data">
                                                            <h4 class="wow fadeInRight" data-wow-offset="2">
                                                                <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                                   title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                                    {{ \App\Helpers\Helpers::lang($i, "title") }}
                                                                </a>
                                                            </h4>
                                                            <div class="shortdes wow fadeInLeft" data-wow-offset="2">
                                                                {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($i, "description"), 200) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div class="text-center">
                                        <a href="{{ route('client.category.index', ['slug' => $row->slug]) }}"
                                           title="Xem thêm">
                                            <button class="custom-button ct-fk1">{{ \App\Helpers\Helpers::langDefine('Xem thêm') }}</button>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('/web/EngineThemes/style.css') }}"/>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/web/EngineThemes/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/web/EngineThemes/draggble.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/web/EngineThemes/teenmax.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/web/EngineThemes/waypoints.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/web/EngineThemes/jquery.roundabout.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/web/EngineThemes/custom.js') }}"></script>
    <script type="text/javascript">
        $('.ami-new-click').click(function () {
            var id = this.getAttribute("data-id");
            $('.ami-new-click').removeClass('active');
            $(this).addClass('active');
            $('.ami-new').hide();
            $('.ami-new-' + id).show();
        });
    </script>
@endsection
