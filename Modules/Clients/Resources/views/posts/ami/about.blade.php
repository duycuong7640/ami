@extends('clients::layouts.new')

@section('content')
    <section class="wrap-about-ami">
        <section class="wrap-cate">
            <div class="main-width">
                <h1>{{ !empty(\App\Helpers\Helpers::lang($data['category'], "title2")) ? \App\Helpers\Helpers::lang($data['category'], "title2") : \App\Helpers\Helpers::lang($data['category'], "title") }}</h1>
                <div class="cate-des">
                    {!! \App\Helpers\Helpers::lang($data['category'], "description") !!}
                </div>
            </div>
        </section>
        @if(!empty($data['fixone']->id))
            @php $row = $data['fixone']; @endphp
            <section class="wrap-ex-one1">
                <div class="main-width">
                    <div class="ex-one-right">
                        <img src="{{ asset($row->thumbnail) }}"/>
                    </div>
                </div>
            </section>
            <section class="wrap-ex-one">
                <div class="main-width">
                    <div class="ex-one-left">
                        <h4>{{ \App\Helpers\Helpers::lang($row, "title") }}</h4>
                        <div class="ex-des">
                            {!! \App\Helpers\Helpers::lang($row, "description") !!}
                        </div>
                        <div class="item-fix">
                            <ul>
                                <li>
                                    <div class="item">
                                        <div class="b-img">
                                            <img src="{{ asset('web/images/iconketnoi.png') }}" title="" alt=""/>
                                        </div>
                                        <div class="title">{{ \App\Helpers\Helpers::langDefine('KẾT NỐI') }}</div>
                                        <div class="shortdes">
                                            {{ \App\Helpers\Helpers::langDefine('b_1') }}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item">
                                        <div class="b-img">
                                            <img src="{{ asset('web/images/iconkientao.png') }}" title="" alt=""/>
                                        </div>
                                        <div class="title">{{ \App\Helpers\Helpers::langDefine('KIẾN TẠO') }}</div>
                                        <div class="shortdes">
                                            {{ \App\Helpers\Helpers::langDefine('b_2') }}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item">
                                        <div class="b-img">
                                            <img src="{{ asset('web/images/iconlantoa.png') }}" title="" alt=""/>
                                        </div>
                                        <div class="title">{{ \App\Helpers\Helpers::langDefine('LAN TỎA') }}</div>
                                        <div class="shortdes">
                                            {{ \App\Helpers\Helpers::langDefine('b_3') }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <section class="wrap-list">
            <div class="main-width">
                <h2 class="title">
                    <a href="" title="">
                        {{ \App\Helpers\Helpers::langDefine('TỪNG BƯỚC BIẾN GIẤC MƠ THÀNH SỰ THẬT') }}
                    </a>
                </h2>
                <div class="wrap-show">
                    <div class="show-sitebar">
                        <ul>
                            @foreach($data['list'] as $k=>$row)
                                <li data-id="{{ $row->id }}" class="amiChange {{ ($k == 0) ? 'active' : '' }}">
                                    <span>Ami</span> {{ \App\Helpers\Helpers::lang($row, "title") }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="show-content">
                        @foreach($data['list'] as $k=>$row)
                            <div class="content-data ami-show ami-item-{{ $row->id }}"
                                 style="{{ ($k > 0) ? 'display: none' : '' }}">
                                <h3>
                                    <span>Ami</span> {{ \App\Helpers\Helpers::lang($row, "title") }}
                                </h3>
                                <div class="shortdes">
                                    {!! \App\Helpers\Helpers::lang($row, "description") !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="show-image">
                        @foreach($data['list'] as $k=>$row)
                            <div class="thumb-ab-ami ami-show ami-item-{{ $row->id }}"
                                 style="{{ ($k > 0) ? 'display: none' : '' }}">
                                <a href="" title="">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'new_big') }}"
                                         title="" alt=""/>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        @if(!empty($data['fixtwo']))
            <section class="wrap-ex-two">
                <div class="main-width">
                    <label class="title">{{ \App\Helpers\Helpers::langDefine('LĨNH VỰC HOẠT ĐỘNG') }}</label>
                </div>
                <div class="bg-ex-two">
                    <div class="main-width">
                        <ul>
                            @foreach($data['fixtwo'] as $row)
                                <li>
                                    <div class="relative">
                                        <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'about_ami') }}"
                                             title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                             alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                        <div class="absolute"
                                             style="top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3)">
                                            <div class="item">
                                                <div class="slogan">{{ \App\Helpers\Helpers::lang($row, "title") }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-dt">
                                        <div class="title">{{ \App\Helpers\Helpers::lang($row, "title2") }}</div>
                                        <div class="shortdes">
                                            {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 230) !!}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        @endif
        <section class="wrap-counter">
            <div class="main-width">
                {{--                <div class="title">{{ \App\Helpers\Helpers::langDefine('NHỮNG CON SỐ ẤN TƯỢNG') }}</div>--}}
                <ul>
                    <li>
                        <div class="head wow fadeInDown" data-wow-offset="2">100+</div>
                        <p>{{ \App\Helpers\Helpers::langDefine('NHÀ PHÂN PHỐI') }}</p>
                        <p>{{ \App\Helpers\Helpers::langDefine('TRONG NĂM 2023') }}</p>
                    </li>
                    <li>
                        <div class="head wow fadeInDown" data-wow-offset="2">10.000+</div>
                        <p>{{ \App\Helpers\Helpers::langDefine('KHÁCH HÀNG TIÊU DÙNG') }}</p>
                        <p>{{ \App\Helpers\Helpers::langDefine('TRONG NĂM 2023') }}</p>
                    </li>
                    <li>
                        <div class="head wow fadeInDown" data-wow-offset="2">100+</div>
                        <p>{{ \App\Helpers\Helpers::langDefine('ĐỐI TÁC') }}</p>
                        <p>{{ \App\Helpers\Helpers::langDefine('TOÀN CẦU') }}</p>
                    </li>
                </ul>
            </div>
        </section>
        @if(!empty($data['newfix']))
            <section class="wrap-home-fourth">
                <div class="main-width">
                    <div class="cate-title">
                        <a href="{{ route('client.category.index', ['slug' => $data['newfix']->slug]) }}"
                           title="{{ \App\Helpers\Helpers::lang($data['newfix'], "title") }}">
                            {{ \App\Helpers\Helpers::lang($data['newfix'], "title") }}
                        </a>
                    </div>
                    <div class="" style="height: 35px;"></div>
                    <div class="wrap-news">
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
                                @foreach($data['newfix_list'] as $k=>$i)
                                    @if($k >= 0)
                                        <li>
                                            <div class="item">
                                                <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                   title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                    <img src="{{ \App\Helpers\Helpers::renderThumb($i->thumbnail, 'new_list') }}"
                                                         title="{{ \App\Helpers\Helpers::lang($i, "title") }}"
                                                         alt="{{ \App\Helpers\Helpers::lang($i, "title") }}"/>
                                                </a>
                                                <div class="content-data content-data-ab">
                                                    <div class="category-nh">
                                                        {{ !empty($data['cates'][$i->category_id]) ? \App\Helpers\Helpers::lang($data['cates'][$i->category_id], "title") : ''}}
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
                                    <a href="{{ route('client.category.index', ['slug' => $data['newfix']->slug]) }}"
                                       title="Xem thêm">
                                        <button class="custom-button ct-fk1">{{ \App\Helpers\Helpers::langDefine('Xem thêm') }}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.amiChange').click(function () {
            var id = this.getAttribute("data-id");
            $('.amiChange').removeClass('active');
            $(this).addClass('active');
            $('.ami-show').hide();
            $('.ami-item-' + id).show();
        });
    </script>
@endsection
