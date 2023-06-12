@extends('clients::layouts.new')

@section('content')
    <section class="wrap-detail-product">
        <section class="wrap-writing">
            <div class="main-width">
                <div class="content-data">{!! \App\Helpers\Helpers::lang($data['detail'], "des") !!}</div>
            </div>
        </section>
        <section class="wrap-show-detail-product">
            <div class="main-width">
                <div class="wrap-detail-product">
                    <div class="detail-p-left">
                        <div class="dp-img-main">
                            <a id="example1" href="{{ asset($data['detail']->thumbnail) }}">
                                <img src="{{ \App\Helpers\Helpers::renderThumb($data['detail']->thumbnail, 'product_detail') }}"
                                 title="{{ \App\Helpers\Helpers::lang($data['detail'], "title") }}" alt="{{ \App\Helpers\Helpers::lang($data['detail'], "title") }}"/>
                            </a>
                        </div>
                    </div>
                    <div class="detail-p-right">
                        <h1 class="title">{{ \App\Helpers\Helpers::lang($data['detail'], "title") }}</h1>
                        <div class="price">{{ ($data['detail']->price > 999) ? number_format($data['detail']->price) : $data['detail']->price }} đ</div>
                        <div class="detail-des">
                            {!! \App\Helpers\Helpers::lang($data['detail'], "description") !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="wrap-content-detail">
            <div class="main-width">
                <div class="wrap-cd">
                    <div class="title-cd">{{ \App\Helpers\Helpers::langDefine('Mô tả sản phẩm') }}</div>
                    <div class="content-view ctct">
                        {!! \App\Helpers\Helpers::lang($data['detail'], "content") !!}
                    </div>
                </div>
            </div>
        </section>
        @php
            $slide_max = ceil(count($data['related']) / 5);
            $slide_max_data = [];
            $dem = 0;
            $k = 0;
            foreach ($data['related'] as $row){
                $slide_max_data[$k][] = $row;
                $dem ++;
                if($dem == 5){
                    $dem = 0;
                    $k ++;
                }
            }
            $slide_min = ceil(count($data['related']) / 2);
            $slide_min_data = [];
            $dem = 0;
            $k = 0;
            foreach ($data['related'] as $row){
                $slide_min_data[$k][] = $row;
                $dem ++;
                if($dem == 2){
                    $dem = 0;
                    $k ++;
                }
            }
        @endphp
        <section class="wrap-products-related">
            <div class="main-width">
                <div class="wrap-prelated-list">
                    <div class="title-lq">{{ \App\Helpers\Helpers::langDefine('SẢN PHẨM LIÊN QUAN') }}</div>
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
                                        <div class="wrap-l-related">
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
        <section class="wrap-products-related slide-pro-viewed-mb" style="display: none;">
            <div class="main-width">
                <div class="wrap-prelated-list">
                    <div class="title-lq">{{ \App\Helpers\Helpers::langDefine('SẢN PHẨM LIÊN QUAN') }}</div>
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
                                        <div class="wrap-l-related">
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
    </section>
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('web/fancybox/fancybox/jquery.fancybox-1.3.4.css') }}" media="screen" />
    <link rel="stylesheet" href="{{ asset('web/fancybox/fancybox/style.css') }}" />
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('web/fancybox/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("a#example1").fancybox();
        });
    </script>
@endsection
