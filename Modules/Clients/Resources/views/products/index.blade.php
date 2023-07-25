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
        <section class="wrap-products">
            <div class="main-width">
                <div class="product-left">
                    <div class="wrap-sitebar">
                        <div class="title">{{ \App\Helpers\Helpers::langDefine('SẢN PHẨM') }}</div>
                        <div class="list-cate">
                            <ul>
                                @foreach($data['cate'] as $row)
                                    <li>
                                        <a href="{{ route('client.category.index', ['slug' => $row->slug]) }}"
                                           title="{{ \App\Helpers\Helpers::lang($row, "title") }}">{{ \App\Helpers\Helpers::lang($row, "title") }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="product-right">
                    <div class="wrap-show-products">
                        <div class="title">
                            {{ \App\Helpers\Helpers::langDefine('TẤT CẢ SẢN PHẨM') }}
                        </div>
                        <div class="type-product">
                            <ul>
                                <li>
                                    <a href="{{ route('client.category.type.index', ['slug' => $data['category']->slug, 'type' => 'pb']) }}"
                                       title=""
                                       class="{{ (!request()->type || request()->type == 'pb') ? 'active' : '' }}">
                                        {{ \App\Helpers\Helpers::langDefine('Phổ biến') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('client.category.type.index', ['slug' => $data['category']->slug, 'type' => 'bc']) }}"
                                       title=""
                                       class="{{ (request()->type && request()->type == 'bc') ? 'active' : '' }}">
                                        {{ \App\Helpers\Helpers::langDefine('Bán chạy') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('client.category.type.index', ['slug' => $data['category']->slug, 'type' => 'hm']) }}"
                                       title=""
                                       class="{{ (request()->type && request()->type == 'hm') ? 'active' : '' }}">
                                        {{ \App\Helpers\Helpers::langDefine('Hàng mới') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('client.category.type.index', ['slug' => $data['category']->slug, 'type' => 'pasc']) }}"
                                       title=""
                                       class="{{ (request()->type && request()->type == 'pasc') ? 'active' : '' }}">
                                        {{ \App\Helpers\Helpers::langDefine('Giá từ thấp đến cao') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('client.category.type.index', ['slug' => $data['category']->slug, 'type' => 'pdesc']) }}"
                                       title=""
                                       class="{{ (request()->type && request()->type == 'pdesc') ? 'active' : '' }}">
                                        {{ \App\Helpers\Helpers::langDefine('Giá từ cao đến thấp') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="wrap-list-products">
                            <ul>
                                @foreach($data['newpost'] as $k=>$row)
                                    <li style="{{ $k >= 12 ? 'display: none' : '' }}">
                                        <div class="item">
                                            <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"
                                               title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'product') }}"
                                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                                     alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                            </a>
                                            <div class="content-data">
                                                <h3>
                                                    <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"
                                                       title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                        {{ \App\Helpers\Helpers::lang($row, "title") }}
                                                    </a>
                                                </h3>
                                                <div class="price">{{ ($row->price > 999) ? number_format($row->price) : $row->price }}
                                                    đ
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div style="clear: both;"></div>
                            <div class="wrap-loading" style="display: none;">
                                <img src="{{ asset('web/images/loading.gif') }}" width="65"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(!empty($data['pro_viewed']))
            {{--            <section class="wrap-is-viewed">--}}
            {{--                <div class="main-width">--}}
            {{--                    <div class="wrap-list-viewed">--}}
            {{--                        <div class="title">{{ \App\Helpers\Helpers::langDefine('SẢN PHẨM ĐÃ XEM') }}</div>--}}
            {{--                        <div class="wrap-l-viewed">--}}
            {{--                            <ul>--}}
            {{--                                @foreach($data['pro_viewed'] as $row)--}}
            {{--                                    <li>--}}
            {{--                                        <div class="item">--}}
            {{--                                            <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"--}}
            {{--                                               title="{{ \App\Helpers\Helpers::lang($row, "title") }}">--}}
            {{--                                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'product') }}"--}}
            {{--                                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}"--}}
            {{--                                                     alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>--}}
            {{--                                            </a>--}}
            {{--                                            <div class="content-data">--}}
            {{--                                                <h3>--}}
            {{--                                                    <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"--}}
            {{--                                                       title="{{ \App\Helpers\Helpers::lang($row, "title") }}">--}}
            {{--                                                        {{ \App\Helpers\Helpers::lang($row, "title") }}--}}
            {{--                                                    </a>--}}
            {{--                                                </h3>--}}
            {{--                                                <div class="price">{{ ($row->price > 999) ? number_format($row->price) : $row->price }}--}}
            {{--                                                    đ--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </li>--}}
            {{--                                @endforeach--}}
            {{--                            </ul>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </section>--}}
            @php
                $slide_max = ceil(count($data['pro_viewed']) / 5);
                $slide_max_data = [];
                $dem = 0;
                $k = 0;
                foreach ($data['pro_viewed'] as $row){
                    $slide_max_data[$k][] = $row;
                    $dem ++;
                    if($dem == 5){
                        $dem = 0;
                        $k ++;
                    }
                }
                $slide_min = ceil(count($data['pro_viewed']) / 2);
                $slide_min_data = [];
                $dem = 0;
                $k = 0;
                foreach ($data['pro_viewed'] as $row){
                    $slide_min_data[$k][] = $row;
                    $dem ++;
                    if($dem == 2){
                        $dem = 0;
                        $k ++;
                    }
                }
            @endphp
            <section class="wrap-is-viewed slide-pro-viewed">
                <div class="main-width">
                    <div class="wrap-list-viewed">
                        <div class="title">{{ \App\Helpers\Helpers::langDefine('SẢN PHẨM ĐÃ XEM') }}</div>
                        <div class="wrap-slide">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                {{--                                <ol class="carousel-indicators">--}}
                                {{--                                    @for($i = 0; $i < $slide_max; $i ++)--}}
                                {{--                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"--}}
                                {{--                                            class="{{ !$i ? 'active' : '' }}"></li>--}}
                                {{--                                    @endfor--}}
                                {{--                                </ol>--}}
                                <div class="carousel-inner">
                                    @for($i = 0; $i < $slide_max; $i ++)
                                        <div class="carousel-item {{ !$i ? 'active' : '' }}">
                                            <div class="wrap-l-viewed">
                                                <ul>
                                                    @foreach($slide_max_data[$i] as $k=>$row)
                                                        <li>
                                                            <div class="item">
                                                                <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"
                                                                   title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'product') }}"
                                                                         title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                                                         alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                                                </a>
                                                                <div class="content-data">
                                                                    <h3>
                                                                        <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"
                                                                           title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                            {{ \App\Helpers\Helpers::lang($row, "title") }}
                                                                        </a>
                                                                    </h3>
                                                                    <div class="price">{{ ($row->price > 999) ? number_format($row->price) : $row->price }}
                                                                        đ
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                   data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                   data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="wrap-is-viewed slide-pro-viewed-mb" style="display: none;">
                <div class="main-width">
                    <div class="wrap-list-viewed">
                        <div class="title">{{ \App\Helpers\Helpers::langDefine('SẢN PHẨM ĐÃ XEM') }}</div>
                        <div class="wrap-slide">
                            <div id="carouselExampleIndicators_mb" class="carousel slide" data-ride="carousel">
                                {{--                                <ol class="carousel-indicators">--}}
                                {{--                                    @for($i = 0; $i < $slide_max; $i ++)--}}
                                {{--                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"--}}
                                {{--                                            class="{{ !$i ? 'active' : '' }}"></li>--}}
                                {{--                                    @endfor--}}
                                {{--                                </ol>--}}
                                <div class="carousel-inner">
                                    @for($i = 0; $i < $slide_min; $i ++)
                                        <div class="carousel-item {{ !$i ? 'active' : '' }}">
                                            <div class="wrap-l-viewed">
                                                <ul>
                                                    @foreach($slide_min_data[$i] as $k=>$row)
                                                        <li>
                                                            <div class="item">
                                                                <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"
                                                                   title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'product') }}"
                                                                         title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                                                         alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                                                </a>
                                                                <div class="content-data">
                                                                    <h3>
                                                                        <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"
                                                                           title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                            {{ \App\Helpers\Helpers::lang($row, "title") }}
                                                                        </a>
                                                                    </h3>
                                                                    <div class="price">{{ ($row->price > 999) ? number_format($row->price) : $row->price }}
                                                                        đ
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators_mb" role="button"
                                   data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators_mb" role="button"
                                   data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
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
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        $(document).scroll(function () {
            loading();
        });

        async function loading() {
            $('.wrap-loading').show();
            await sleep(2000);
            var proH = $('.wrap-list-products').innerHeight();
            var curPos = $(document).scrollTop();

            var listLi = document.querySelectorAll('.wrap-list-products ul li')

            var j = 0;
            if (curPos >= proH - 400) {
                for (var i = 0; i < listLi.length; i++) {
                    if (listLi[i].getAttribute('style') === 'display: none') {
                        listLi[i].removeAttribute('style');
                        j ++;
                        if(j >= 12) break;
                    }
                }
                $('.wrap-loading').hide();
            }
        }
    </script>
@endsection