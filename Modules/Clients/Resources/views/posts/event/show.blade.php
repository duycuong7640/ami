@extends('clients::layouts.new')

@section('content')
    <section id="box-new-detail">
        <div class="main-width relative">
            <div class="event-detail-img">
                <img src="{{ \App\Helpers\Helpers::renderThumb($data['detail']->thumbnail, 'event_img') }}"
                     title="{{ \App\Helpers\Helpers::lang($data['detail'], "title") }}"
                     alt="{{ \App\Helpers\Helpers::lang($data['detail'], "title") }}"/>
            </div>
            <div class="wrap-event-head">
                <div class="event-date">
                    <div class="e-month">{{ \App\Helpers\Helpers::langDefine('Tháng') }} {{ !empty($data['detail']->dienra) ? date('m', strtotime($data['detail']->dienra)) : '' }}</div>
                    <div class="e-day">{{ !empty($data['detail']->dienra) ? date('d', strtotime($data['detail']->dienra)) : '' }}</div>
                </div>
                <div class="event-content">
                    <div class="nrd-head">
                        <h1>{{ \App\Helpers\Helpers::lang($data['detail'], "title") }}</h1>
                    </div>
                    <div class="info-add date">
                        <span>{{ !empty($data['detail']->dienra) ? \App\Helpers\Helpers::calDate(strtotime($data['detail']->dienra)) : '' }}</span>
                    </div>
                    <div class="info-add localtion">
                        <a href="{{ $data['detail']->tai_link }}"
                           target="_blank">{{ \App\Helpers\Helpers::lang($data['detail'], "tai") }}</a>
                    </div>
                </div>
            </div>
            <div class="event-share">
                <ul>
                    <li>
                        <div class="b-s">
                            <a href="{!! !empty($data_common['setting']->facebook) ? $data_common['setting']->facebook : '' !!}"
                               title="" target="_blank">
                                <img src="{{ asset('web/images/efb.png') }}"/>
                                {{ \App\Helpers\Helpers::langDefine('Lan tỏa trên Facebook') }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="b-s">
                            <a href="{!! !empty($data_common['setting']->facebook_mess) ? $data_common['setting']->facebook_mess : '' !!}"
                               title="" target="_blank">
                                <img src="{{ asset('web/images/emess.png') }}"/>
                                {{ \App\Helpers\Helpers::langDefine('Gửi trực tiếp cho bạn bè') }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="b-s">
                            <a href="{!! !empty($data_common['setting']->zalo) ? $data_common['setting']->zalo : '' !!}"
                               title="" target="_blank">
                                <img src="{{ asset('web/images/ezalo.png') }}"/>
                                {{ \App\Helpers\Helpers::langDefine('Gửi trực tiếp cho bạn bè') }}
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="wrap-detail wrap-detail-event">
                <div class="">
                    <div class="show-des">
                        {!! \App\Helpers\Helpers::lang($data['detail'], "description") !!}
                    </div>
                    <div class="content-view ctct">
                        {!! \App\Helpers\Helpers::lang($data['detail'], "content") !!}
                    </div>
                </div>
            </div>
        </div>
        @if(count($data['related']) > 0)
            <div class="wrap-related wrap-related2">
                <div class="main-width">

                    @php
                        $slide_max = ceil(count($data['related']) / 5);
                        $slide_max_data = [];
                        $dem = 0;
                        $k = 0;
                        foreach ($data['related'] as $row){
                            $slide_max_data[$k][] = $row;
                            $dem ++;
                            if($dem == 3){
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
                    <section class="wrap-is-viewed slide-pro-viewed">
                        <div class="main-width">
                            <div class="wrap-list-viewed">
                                <div class="title e-fix">
                                    {{ \App\Helpers\Helpers::langDefine('SỰ KIỆN CẬP NHẬT') }}
                                    <div class="line-t"></div>
                                </div>
                                <div class="wrap-slide">
                                    <div id="carouselExampleIndicators" class="carousel slide"
                                         data-ride="carousel">
                                        {{--                                <ol class="carousel-indicators">--}}
                                        {{--                                    @for($i = 0; $i < $slide_max; $i ++)--}}
                                        {{--                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"--}}
                                        {{--                                            class="{{ !$i ? 'active' : '' }}"></li>--}}
                                        {{--                                    @endfor--}}
                                        {{--                                </ol>--}}
                                        <div class="carousel-inner">
                                            @for($i = 0; $i < $slide_max; $i ++)
                                                <div class="carousel-item {{ !$i ? 'active' : '' }}">
                                                    <div class="wrap-news">
                                                        <div class="news-list">
                                                            <ul>
                                                                @foreach($slide_max_data[$i] as $k=>$row)
                                                                    <li>
                                                                        <div class="item">
                                                                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                                                               title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'new_list') }}"
                                                                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                                                                     alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                                                            </a>
                                                                            <div class="content-data">
                                                                                <div class="category-nh">
                                                                                    {{ !empty($data['cates'][$row->category_id]) ? \App\Helpers\Helpers::lang($data['cates'][$row->category_id], "title") : ''}}
                                                                                </div>
                                                                                <h4>
                                                                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                                                                       title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                                        {{ \App\Helpers\Helpers::lang($row, "title") }}
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="shortdes">
                                                                                    {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 180) !!}
                                                                                </div>
                                                                                <div class="b-view-event">
                                                                                    <div class="l">
                                                                                        <div class="info-add date">
                                                                                            <span>{{ \App\Helpers\Helpers::calDate(strtotime($row->created_at)) }}</span>
                                                                                        </div>
                                                                                        <div class="info-add localtion">
                                                                                            <a href="{{ $row->tai_link }}"
                                                                                               target="_blank">{{ \App\Helpers\Helpers::lang($row, "tai") }}</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="r">
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
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                           role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators"
                                           role="button"
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
                                <div class="title e-fix">
                                    {{ \App\Helpers\Helpers::langDefine('SỰ KIỆN CẬP NHẬT') }}
                                    <div class="line-t"></div>
                                </div>
                                <div class="wrap-slide">
                                    <div id="carouselExampleIndicators_mb" class="carousel slide"
                                         data-ride="carousel">
                                        {{--                                <ol class="carousel-indicators">--}}
                                        {{--                                    @for($i = 0; $i < $slide_max; $i ++)--}}
                                        {{--                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"--}}
                                        {{--                                            class="{{ !$i ? 'active' : '' }}"></li>--}}
                                        {{--                                    @endfor--}}
                                        {{--                                </ol>--}}
                                        <div class="carousel-inner">
                                            @for($i = 0; $i < $slide_min; $i ++)
                                                <div class="carousel-item {{ !$i ? 'active' : '' }}">
                                                    <div class="wrap-news">
                                                        <div class="news-list">
                                                            <ul>
                                                                @foreach($slide_min_data[$i] as $k=>$row)
                                                                    <li>
                                                                        <div class="item">
                                                                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                                                               title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'new_list') }}"
                                                                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                                                                     alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                                                            </a>
                                                                            <div class="content-data">
                                                                                <div class="category-nh">
                                                                                    {{ !empty($data['cates'][$row->category_id]) ? \App\Helpers\Helpers::lang($data['cates'][$row->category_id], "title") : ''}}
                                                                                </div>
                                                                                <h4>
                                                                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                                                                       title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                                        {{ \App\Helpers\Helpers::lang($row, "title") }}
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="shortdes">
                                                                                    {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 180) !!}
                                                                                </div>
                                                                                <div class="b-view-event">
                                                                                    <div class="l">
                                                                                        <div class="info-add date">
                                                                                            <span>{{ \App\Helpers\Helpers::calDate(strtotime($row->created_at)) }}</span>
                                                                                        </div>
                                                                                        <div class="info-add localtion">
                                                                                            <a href="{{ $row->tai_link }}"
                                                                                               target="_blank">{{ \App\Helpers\Helpers::lang($row, "tai") }}</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="r">
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
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators_mb"
                                           role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators_mb"
                                           role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

            </div>
        @endif
    </section>
@endsection
