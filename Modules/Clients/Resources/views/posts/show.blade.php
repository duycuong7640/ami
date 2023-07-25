@extends('clients::layouts.new')

@section('content')
    <section id="box-new-detail">
        <div class="main-width relative">
            <div class="wrap-show-extention">
                <ul>
                    <li>
                        <a href="{!! !empty($data_common['setting']->facebook) ? $data_common['setting']->facebook : '' !!}"
                           title="" target="_blank">
                            <img src="{{ asset('web/images/icon/ic_fb.svg') }}"/>
                        </a>
                    </li>
                    <li>
                        <a href="{!! !empty($data_common['setting']->zalo) ? $data_common['setting']->zalo : '' !!}"
                           title="" target="_blank">
                            <img src="{{ asset('web/images/icon/ic_zalo.svg') }}"/>
                        </a>
                    </li>
                    <li>
                        <a href="{!! !empty($data_common['setting']->mxh_url1) ? $data_common['setting']->mxh_url1 : '' !!}"
                           title="" target="_blank">
                            <img src="{{ asset('web/images/icon/ic_message.svg') }}"/>
                        </a>
                    </li>
                    <li>
                        <a href="{!! !empty($data_common['setting']->instagram) ? $data_common['setting']->instagram : '' !!}"
                           title="" target="_blank">
                            <img src="{{ asset('web/images/icon/ic_instagram.svg') }}"/>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="wrap-detail">
                <div class="show-left">
                    <div class="nrd-head">
                        <h1>{{ \App\Helpers\Helpers::lang($data['detail'], "title") }}</h1>
                    </div>
                    <div class="date">
                        {{ date('H:i d/m/Y', strtotime($data['detail']->created_at)) }}
                    </div>
                    <div class="show-des">
                        {!! \App\Helpers\Helpers::lang($data['detail'], "description") !!}
                    </div>
                    <div class="content-view ctct">
                        {!! \App\Helpers\Helpers::lang($data['detail'], "content") !!}
                    </div>
                    <div class="wrap-show-extention2">
                        <ul>
                            <li>
                                <a href="{!! !empty($data_common['setting']->facebook) ? $data_common['setting']->facebook : '' !!}"
                                   title="" target="_blank">
                                    <img src="{{ asset('web/images/icon/ic_fb.svg') }}"/>
                                </a>
                            </li>
                            <li>
                                <a href="{!! !empty($data_common['setting']->zalo) ? $data_common['setting']->zalo : '' !!}"
                                   title="" target="_blank">
                                    <img src="{{ asset('web/images/icon/ic_zalo.svg') }}"/>
                                </a>
                            </li>
                            <li>
                                <a href="{!! !empty($data_common['setting']->mxh_url1) ? $data_common['setting']->mxh_url1 : '' !!}"
                                   title="" target="_blank">
                                    <img src="{{ asset('web/images/icon/ic_message.svg') }}"/>
                                </a>
                            </li>
                            <li>
                                <a href="{!! !empty($data_common['setting']->instagram) ? $data_common['setting']->instagram : '' !!}"
                                   title="" target="_blank">
                                    <img src="{{ asset('web/images/icon/ic_instagram.svg') }}"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="show-right">
                    @foreach($data['adv1'] as $row)
                        <div class="wrap-adv">
                            <a href="{{ $row->url }}" target="_blank"
                               title="">
                                <img src="{{ asset($row->thumbnail) }}" title="" alt=""/>
                            </a>
                        </div>
                    @endforeach
                    <div class="wrap-news-up">
                        <label>{{ \App\Helpers\Helpers::langDefine('TIN TỨC CẬP NHẬT') }}</label>
                        <div class="list-nu">
                            <ul>
                                @foreach($data['newpost'] as $k=>$row)
                                    <li>
                                        <div class="item">
                                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                               title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'new_list') }}"
                                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                                     alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                            </a>
                                            <div class="content-data">
                                                <h4>
                                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                                       title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                        {{ \App\Helpers\Helpers::lang($row, "title") }}
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @foreach($data['adv2'] as $row)
                        <div class="wrap-adv">
                            <a href="{{ $row->url }}" target="_blank"
                               title="">
                                <img src="{{ asset($row->thumbnail) }}" title="" alt=""/>
                            </a>
                        </div>
                    @endforeach
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
                                    {{ \App\Helpers\Helpers::langDefine('Related news') }}
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
                                                                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}" title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'new_list') }}"
                                                                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}" alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                                                            </a>
                                                                            <div class="content-data content-data-new">
                                                                                <h4>
                                                                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}" title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                                        {{ \App\Helpers\Helpers::lang($row, "title") }}
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="shortdes">
                                                                                    {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 180) !!}
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
                                    {{ \App\Helpers\Helpers::langDefine('Related news') }}
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
                                                                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}" title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'new_list') }}"
                                                                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}" alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                                                            </a>
                                                                            <div class="content-data content-data-new">
                                                                                <h4>
                                                                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}" title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                                                        {{ \App\Helpers\Helpers::lang($row, "title") }}
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="shortdes">
                                                                                    {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 180) !!}
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
