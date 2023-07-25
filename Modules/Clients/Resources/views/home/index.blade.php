@extends('clients::layouts.app')

@section('content')
    @foreach($data['drag_home'] as $row)
        <section id="slide-drag" class="relative">
            {{--            <div class="wrap-content-slide absolute">--}}
            {{--                <div class="home-one-left absolute">--}}
            {{--                    <div class="main-width-left w-720 absolute">--}}
            {{--                        <div class="w-720 content-data absolute">--}}
            {{--                            <label class="title text-cd-custom1">{!! \App\Helpers\Helpers::lang($row, "title") !!}</label>--}}
            {{--                            <div>--}}
            {{--                                <a href="{{ $row->url }}"--}}
            {{--                                   title="">--}}
            {{--                                    <button class="custom-button">{{ \App\Helpers\Helpers::langDefine('Xem thêm') }}</button>--}}
            {{--                                </a>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="home-one-right absolute">--}}
            {{--                    <div class="main-width-right w-720 absolute">--}}
            {{--                        <div class="w-720 content-data absolute text-right">--}}
            {{--                            <label class="title text-cd-custom">{!! \App\Helpers\Helpers::lang($row, "title2") !!}</label>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <a class="wrapper-logo"></a>
                    </div>
                </div>
            </div>
            <section id="before-after">
                <div class="view view-before">
                    <div class="wrapper-before relative">
                        <div class="main-width wrap-header-abs wrap-header2 absolute">
                            @include('clients::elements.header_h2')
                        </div>
                        <div class="main-width absolute ct-show text-right">
                            <label class="title-ct2 float-right">{!! \App\Helpers\Helpers::lang($row, "title2") !!}</label>
                            <label class="title-ct2 float-left text-left">{!! \App\Helpers\Helpers::lang($row, "title") !!}</label>
                        </div>
                        <div class="img-bird-wrapper et-in-viewport-check et-in-viewport-floating_special"
                             et-anim="floating_special" et-anim-duration="3500" et-anim-delay="0" et-anim-easing="ease"
                             style="animation: 3500ms ease 0s 1 normal forwards running floating_special;">
                            <img src="{{ asset($row->thumbnail2) }}">
                            <div class="tooltip-item tooltip-item-1" data-header-text="pos-item-1"
                                 style="display1: none;"></div>
                            <div class="tooltip-item tooltip-item-2" data-header-text="pos-item-2"
                                 style="display1: none;"></div>
                            <div class="tooltip-item tooltip-item-3" data-header-text="pos-item-3"
                                 style="display1: none;"></div>
                            <div class="tooltip-item tooltip-item-4" data-header-text="pos-item-4"
                                 style="display1: none;"></div>
                            <div class="tooltip-item tooltip-item-5" data-header-text="pos-item-5"
                                 style="display1: none;"></div>
                        </div>
                    </div>
                </div>
                <div class="view view-after" style="width: 417px;">
                    <div class="wrapper-after relative" style="width: 1587px;">
                        <div class="main-width wrap-header-abs wrap-header1 absolute">
                            @include('clients::elements.header')
                        </div>
                        <div class="main-width absolute ct-show">
                            <label class="title-ct float-left">{!! \App\Helpers\Helpers::lang($row, "title") !!}</label>
                            <label class="title-ct float-right text-right">{!! \App\Helpers\Helpers::lang($row, "title2") !!}</label>
                        </div>
                        <div class="img-bird-wrapper et-in-viewport-check et-in-viewport-floating_special"
                             et-anim="floating_special" et-anim-duration="3500" et-anim-delay="0" et-anim-easing="ease"
                             style="animation: 3500ms ease 0s 1 normal forwards running floating_special;">
                            <img src="{{ asset($row->thumbnail) }}">
                            <div class="tooltip-item tooltip-item-1" data-header-text="pos-item-1"
                                 style="display1: none;"></div>
                            <div class="tooltip-item tooltip-item-2" data-header-text="pos-item-2"
                                 style="display1: none;"></div>
                            <div class="tooltip-item tooltip-item-3" data-header-text="pos-item-3"
                                 style="display1: none;"></div>
                            <div class="tooltip-item tooltip-item-4" data-header-text="pos-item-4"
                                 style="display1: none;"></div>
                            <div class="tooltip-item tooltip-item-5" data-header-text="pos-item-5"
                                 style="display1: none;"></div>
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
            <div class="main-width2">
                <section class="wrap-home-two">
                    <ul>
                        @foreach($data['category_products'] as $k=>$row)
                            <li class="{{ in_array($k, [1, 2, 5, 6, 9, 10, 13, 14, 17, 18, 21, 22, 25, 26, 29, 30]) ? 'other' : 'other' }}">
                                <div class="absolute"
                                     style="background-size: cover !important; opacity: 1; background: url('{{ $row->thumbnail }}') no-repeat top 0px left; top: 0; left: 0; right: 0; bottom: 0;"></div>
                                {{--                                <div class="absolute"--}}
                                {{--                                     style="background: #1D3C6E; opacity: 0.3; top: 0; left: 0; right: 0; bottom: 0;"></div>--}}
                                <div class="absolute bg-rgba">
                                    <div class="absolute border-1D3C6E">
                                        <div class="{{ (($k % 2 === 0) ? 'main-width-right' : 'main-width-right') }} w-7201">
                                            <div class="w-7201 content-data wow fadeInDown" data-wow-offset="2">
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
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>
        @endif
        <section class="wrap-home-three">
            <div class="main-width">
                <div class="wrap-data">
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/a1.png') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft"
                             data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('Tiêu chuẩn quốc tế') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('a_1') }}
                        </div>
                    </div>
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/a2.png') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft"
                             data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('Phân phối độc quyền') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('a_2') }}
                        </div>
                    </div>
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/a3.png') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft"
                             data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('TIÊU DÙNG LÕI XANH') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('tdlx') }}
                        </div>
                    </div>
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/a4.png') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft"
                             data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('Tiện ích 4.0') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('a_4') }}
                        </div>
                    </div>
                    <div class="content-data">
                        <div class="b-img">
                            <img src="{{ asset('web/images/a5.png') }}" title="" alt=""/>
                        </div>
                        <div class="title wow fadeInLeft"
                             data-wow-offset="2">{{ \App\Helpers\Helpers::langDefine('Cộng đồng tiêu dùng Ami') }}</div>
                        <div class="shortdes wow fadeInDown" data-wow-offset="2">
                            {{ \App\Helpers\Helpers::langDefine('a_5') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="wrap-home-five">
            <div class="main-width">
                <div class="cate-title">
                    <a href="{{ route('client.category.index', ['slug' => $data['ttsk']->slug]) }}"
                       title="{{ \App\Helpers\Helpers::lang($data['ttsk'], "title") }}">
                        {{ \App\Helpers\Helpers::lang($data['ttsk'], "title") }}
                    </a>
                </div>
                <div class="wrap-ttsk" style="padding-bottom: 50px;">
                    @foreach($data['ttsk_list'] as $k=>$row)
                        <div class="b-ttsk showcarol{{$k}}" @if($k) style="display: none;" @endif>
                            <div class="ttsk1">
                                <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                   title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'new_list_sk') }}"
                                         title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                         alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                </a>
                                <div class="content-data">
                                    <h4 class="wow11 fadeInRight11" data-wow-offset="2">
                                        <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                           title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                            {{ \App\Helpers\Helpers::lang($row, "title") }}
                                        </a>
                                    </h4>
                                    <div class="info-add date">
                                        {{ \App\Helpers\Helpers::langDefine('Diễn ra lúc') }}:
                                        <span>
                                            {{ \App\Helpers\Helpers::calDate(strtotime($row->created_at)) }}
                                            @if(!empty($row->dienra) && strtotime($row->dienra) > time() && (time() + (30 * (24 * 60 * 60))) > strtotime($row->dienra))
                                                <img class="ringring-thumb" src="{{ asset('web/images/ring.gif') }}">
                                            @endif
                                        </span>
                                    </div>
                                    <div class="info-add localtion">
                                        {{ \App\Helpers\Helpers::langDefine('Tại') }}: <a href="{{ $row->tai_link }}"
                                                                                          target="_blank">{{ \App\Helpers\Helpers::lang($row, "tai") }}</a>
                                    </div>
                                    <div class="w-dessk">
                                        <div class="des1">
                                            <div class="shortdes wow11 11fadeInLeft11" data-wow-offset="2">
                                                {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 200) !!}
                                            </div>
                                        </div>
                                        <div class="des2 w-viewmore float-right" style="padding: 0;">
                                            @if(strtotime($row->dienra) > time())
                                                <div class="count-down" id="demo_{{$row->id}}">
                                                    <script type="text/javascript">
                                                        // Set the date we're counting down to
                                                        var countDownDate_{{$row->id}} = new Date("{{date("F j, Y, g:i:s", strtotime($row->dienra))}}").getTime();
                                                        // Update the count down every 1 second
                                                        var x = setInterval(function () {

                                                            // Get today's date and time
                                                            var now_{{$row->id}} = new Date().getTime();

                                                            // Find the distance between now and the count down date
                                                            var distance_{{$row->id}} = countDownDate_{{$row->id}} - now_{{$row->id}};

                                                            // Time calculations for days, hours, minutes and seconds
                                                            var days_{{$row->id}} = Math.floor(distance_{{$row->id}} / (1000 * 60 * 60 * 24));
                                                            var hours_{{$row->id}} = Math.floor((distance_{{$row->id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                            var minutes_{{$row->id}} = Math.floor((distance_{{$row->id}} % (1000 * 60 * 60)) / (1000 * 60));
                                                            var seconds_{{$row->id}} = Math.floor((distance_{{$row->id}} % (1000 * 60)) / 1000);

                                                            // Display the result in the element with id="demo"
                                                            document.getElementById("demo_{{$row->id}}").innerHTML = 'Còn ' + days_{{$row->id}} + " ngày " + hours_{{$row->id}} + " giờ "
                                                                + minutes_{{$row->id}} + " phút ";// + seconds_{{$row->id}} + "s ";

                                                            // If the count down is finished, write some text
                                                            if (distance_{{$row->id}} < 0) {
                                                                clearInterval(x);
                                                                document.getElementById("demo").innerHTML = "";
                                                            }
                                                        }, 1000);
                                                    </script>
                                                </div>
                                            @endif
                                            <div class="detail-viewmore">
                                                <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                                   title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                    {{ \App\Helpers\Helpers::langDefine('Xem thêm') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(!empty($data['ttsk_list'][$k+1]))
                                @php $d = $data['ttsk_list'][$k+1]; @endphp
                                <div class="ttsk2">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($d->thumbnail, 'new_list_sk') }}"
                                         title="{{ \App\Helpers\Helpers::lang($d, "title") }}"
                                         alt="{{ \App\Helpers\Helpers::lang($d, "title") }}"/>
                                    <div class="b-action">
                                        <a href="javascript:void(0);" onclick="showDataCarol(0);">
                                            <img src="{{ asset('web/images/leftc.png') }}"/>
                                        </a>
                                        <a href="javascript:void(0);" onclick="showDataCarol(1);">
                                            <img src="{{ asset('web/images/rightc.png') }}"/>
                                        </a>
                                    </div>
                                </div>
                            @else
                                @php $d = $data['ttsk_list'][0]; @endphp
                                <div class="ttsk2">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($d->thumbnail, 'new_list_sk') }}"
                                         title="{{ \App\Helpers\Helpers::lang($d, "title") }}"
                                         alt="{{ \App\Helpers\Helpers::lang($d, "title") }}"/>
                                    <div class="b-action">
                                        <a href="javascript:void(0);" onclick="showDataCarol(0);">
                                            <img src="{{ asset('web/images/leftc.png') }}"/>
                                        </a>
                                        <a href="javascript:void(0);" onclick="showDataCarol(1);">
                                            <img src="{{ asset('web/images/rightc.png') }}"/>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <input type="hidden" value="0" id="minData"/>
                    <input type="hidden" value="{{ count($data['ttsk_list']) - 1 }}" id="maxData"/>
                    <input type="hidden" value="0" id="dataCurrent"/>
                </div>
                <div class="text-center relative" style="padding-bottom: 30px;">
                    <div class="bt-line"></div>
                    <div class="bt-line-click2 absolute">
                        <a href="{{ route('client.category.index', ['slug' => $data['ttsk']->slug]) }}"
                           title="Xem thêm">
                            <button class="custom-button ct-fk1">{{ \App\Helpers\Helpers::langDefine('Xem thêm') }}</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        @if(!empty($data['home_new']))
            <section class="wrap-home-fourth">
                <div class="main-width">
                    <div class="cate-title">
                        <a href="{{ route('client.category.index', ['slug' => $data['home_new']->slug]) }}"
                           title="{{ \App\Helpers\Helpers::lang($data['home_new'], "title") }}">
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
                                {{--                                @foreach($data["home_new_cate_post"][$row->id] as $ki=>$i)--}}
                                {{--                                    @if(!$ki)--}}
                                {{--                                        <div class="new-hot">--}}
                                {{--                                            <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"--}}
                                {{--                                               title="{{ \App\Helpers\Helpers::lang($i, "title") }}">--}}
                                {{--                                                <img src="{{ \App\Helpers\Helpers::renderThumb($i->thumbnail, 'new_hot') }}"--}}
                                {{--                                                     title="{{ \App\Helpers\Helpers::lang($i, "title") }}"--}}
                                {{--                                                     alt="{{ \App\Helpers\Helpers::lang($i, "title") }}"/>--}}
                                {{--                                            </a>--}}
                                {{--                                            <div class="content-data">--}}
                                {{--                                                <h3 class="wow fadeInRight" data-wow-offset="2">--}}
                                {{--                                                    <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"--}}
                                {{--                                                       title="{{ \App\Helpers\Helpers::lang($i, "title") }}">--}}
                                {{--                                                        {{ \App\Helpers\Helpers::lang($i, "title") }}--}}
                                {{--                                                    </a>--}}
                                {{--                                                </h3>--}}
                                {{--                                                <div class="shortdes wow fadeInLeft" data-wow-offset="2">--}}
                                {{--                                                    {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($i, "description"), 300) !!}--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    @endif--}}
                                {{--                                @endforeach--}}
                                <div class="fillter-bc fillter-bc-bg">
                                    <form method="get">
                                        <div class="fl-ct">
                                            {{ \App\Helpers\Helpers::langDefine('Thời gian từ') }}
                                            <select name="start" onchange="this.form.submit()">
                                                @for($i=2000; $i<=2100; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            {{ \App\Helpers\Helpers::langDefine('Đến') }}
                                            <select name="end" onchange="this.form.submit()">
                                                <option value=""></option>
                                                @for($i=2000; $i<=2100; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="news-list">
                                    <ul>
                                        @foreach($data["home_new_cate_post"][$row->id] as $ki=>$i)
                                            @if($ki >= 0)
                                                <li>
                                                    <div class="item">
                                                        <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                           title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                            <img src="{{ \App\Helpers\Helpers::renderThumb($i->thumbnail, 'new_list') }}"
                                                                 title="{{ \App\Helpers\Helpers::lang($i, "title") }}"
                                                                 alt="{{ \App\Helpers\Helpers::lang($i, "title") }}"/>
                                                        </a>
                                                        <div class="content-data content-dataff">
                                                            <div class="category-nh">
                                                                {{$row->title}}
                                                            </div>
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
                                                        <div class="w-viewmore">
                                                            <div class="detail-viewmore">
                                                                <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                                   title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                                    {{ \App\Helpers\Helpers::langDefine('Xem thêm') }}
                                                                </a>
                                                            </div>
                                                            <div class="dtime">
                                                                {{ \App\Helpers\Helpers::calDate(strtotime($i->created_at)) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div class="text-center relative">
                                        <div class="bt-line"></div>
                                        <div class="bt-line-click absolute">
                                            <a href="{{ route('client.category.index', ['slug' => $row->slug]) }}"
                                               title="Xem thêm">
                                                <button class="custom-button ct-fk1">{{ \App\Helpers\Helpers::langDefine('Xem thêm') }}</button>
                                            </a>
                                        </div>
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
    <link rel="stylesheet" href="{{ asset('/web/EngineThemes/style.css?v='.time()) }}"/>
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

        // function calWidthDrag() {
        //     var w = $('#before-after .view-after').innerWidth();
        //     var bw = $('body').innerWidth();
        //     if ((parseInt(bw) - parseInt(w)) <= 150) {
        //         $('#slide-drag .text-cd-custom').css('color', '#fff')
        //     } else {
        //         $('#slide-drag .text-cd-custom').css('color', '#1D3C6E')
        //     }
        //
        //     if (parseInt(w) <= 150) {
        //         $('#slide-drag .text-cd-custom1').css('color', '#1D3C6E')
        //         $('#slide-drag .custom-button').css('color', '#1D3C6E')
        //     } else {
        //         $('#slide-drag .text-cd-custom1').css('color', '#fff')
        //     }
        // }
        //
        // setInterval(function () {
        //     calWidthDrag()
        // }, 500);

        function showDataCarol(k) {
            var minData = $('#minData').val();
            var maxData = $('#maxData').val();
            var dataCurrent = $('#dataCurrent').val();
            if (parseInt(k) === parseInt(0)) {
                var min_total = 0;
                if (parseInt(dataCurrent) === parseInt(maxData)) {
                    min_total = maxData;
                } else {
                    min_total = parseInt(dataCurrent) - 1;
                }
                $('#dataCurrent').val(min_total);
                $('.b-ttsk').hide();
                $('.showcarol' + min_total).show();
            } else if (parseInt(k) === parseInt(1)) {
                var max_total = 0;
                if (parseInt(dataCurrent) === parseInt(maxData)) {
                    max_total = minData;
                } else {
                    max_total = parseInt(dataCurrent) + 1;
                }
                $('#dataCurrent').val(max_total);
                $('.b-ttsk').hide();
                $('.showcarol' + max_total).show();
            }
        }

        // setInterval(function () {
        //     showDataCarol(1);
        // }, 5000);
    </script>
@endsection
