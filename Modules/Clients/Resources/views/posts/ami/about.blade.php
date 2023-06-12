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
                                            <img src="{{ asset('web/images/icon/ichandle.svg') }}" title="" alt=""/>
                                        </div>
                                        <div class="title">{{ \App\Helpers\Helpers::langDefine('KẾT NỐI') }}</div>
                                        <div class="shortdes">
                                            {{ \App\Helpers\Helpers::langDefine('Những con người phù hợp') }}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item">
                                        <div class="b-img">
                                            <img src="{{ asset('web/images/icon/icbt.svg') }}" title="" alt=""/>
                                        </div>
                                        <div class="title">{{ \App\Helpers\Helpers::langDefine('KIẾN TẠO') }}</div>
                                        <div class="shortdes">
                                            {{ \App\Helpers\Helpers::langDefine('Một cộng đồng thịnh vượng và hạnh phúc') }}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item">
                                        <div class="b-img">
                                            <img src="{{ asset('web/images/icon/iclt.svg') }}" title="" alt=""/>
                                        </div>
                                        <div class="title">{{ \App\Helpers\Helpers::langDefine('LAN TỎA') }}</div>
                                        <div class="shortdes">
                                            {{ \App\Helpers\Helpers::langDefine('lt') }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ex-one-right">
                        <img src="{{ asset($row->thumbnail) }}"/>
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
                            <div class="content-data ami-show ami-item-{{ $row->id }}" style="{{ ($k > 0) ? 'display: none' : '' }}">
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
                            <div class="thumb-ab-ami ami-show ami-item-{{ $row->id }}" style="{{ ($k > 0) ? 'display: none' : '' }}">
                                <a href="" title="">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb('/storage/photos/n1.png', 'new_big') }}"
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
                                <li class="relative">
                                    <div class="absolute" style="background-size: cover !important; opacity: 0.5; background: url('{{ $row->thumbnail }}') no-repeat top left; top: 0; left: 0; right: 0; bottom: 0;"></div>
                                    <div class="absolute" style="top: 0; left: 0; right: 0; bottom: 0;">
                                        <div class="item">
                                            <div class="slogan">{{ \App\Helpers\Helpers::lang($row, "title") }}</div>
                                            <div class="title">{{ \App\Helpers\Helpers::lang($row, "title2") }}</div>
                                            <div class="shortdes">
                                                {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 230) !!}
                                            </div>
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
                <div class="title">{{ \App\Helpers\Helpers::langDefine('NHỮNG CON SỐ ẤN TƯỢNG') }}</div>
                <ul>
                    <li>
                        <div class="head wow fadeInDown" data-wow-offset="2">100</div>
                        <p>{{ \App\Helpers\Helpers::langDefine('TỶ USD') }}</p>
                        <p>{{ \App\Helpers\Helpers::langDefine('GIÁ TRỊ THƯƠNG HIỆU') }}</p>
                    </li>
                    <li>
                        <div class="head wow fadeInDown" data-wow-offset="2">#6</div>
                        <p>{{ \App\Helpers\Helpers::langDefine('TRUNG TÂM HOẠT ĐÔNG') }}</p>
                        <p>{{ \App\Helpers\Helpers::langDefine('SINH HOẠT CỘNG ĐỒNG') }}</p>
                    </li>
                    <li>
                        <div class="head wow fadeInDown" data-wow-offset="2">+500</div>
                        <p>{{ \App\Helpers\Helpers::langDefine('THÀNH VIÊN MỚI') }}</p>
                        <p>{{ \App\Helpers\Helpers::langDefine('TRONG NĂM 2022') }}</p>
                    </li>
                </ul>
            </div>
        </section>
    </section>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.amiChange').click(function (){
        var id = this.getAttribute("data-id");
        $('.amiChange').removeClass('active');
        $(this).addClass('active');
        $('.ami-show').hide();
        $('.ami-item-'+id).show();
    });
</script>
@endsection
