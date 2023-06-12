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
                    <div class="wrap-related">
                        <label>{{ \App\Helpers\Helpers::langDefine("Related news") }}</label>
                        @if(count($data['related']) > 0)
                            <div class="wrap-new-related">
                                <div class="wnrr-list">
                                    <ul>
                                        @foreach($data['related'] as $k=>$row)
                                            <li>
                                                <div class="item">
                                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                                       title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                        <img src="{{ \App\Helpers\Helpers::renderThumb('/storage/photos/1.png', 'new_list') }}"
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
                        @endif
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
                                                <img src="{{ \App\Helpers\Helpers::renderThumb('/storage/photos/1.png', 'new_list') }}"
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
    </section>
@endsection
