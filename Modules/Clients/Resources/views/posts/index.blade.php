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
        <section class="wrap-new-category">
            <div class="main-width">
                {{--                @if($data['category']->st)--}}
                {{--                    <div class="fillter-bc">--}}
                {{--                        <form method="get">--}}
                {{--                            <div class="fl-ct">--}}
                {{--                                Thời gian từ--}}
                {{--                                <select name="start" onchange="this.form.submit()">--}}
                {{--                                    @for($i=2000; $i<=2100; $i++)--}}
                {{--                                        <option value="{{$i}}">{{$i}}</option>--}}
                {{--                                    @endfor--}}
                {{--                                </select>--}}
                {{--                                Đến--}}
                {{--                                <select name="end" onchange="this.form.submit()">--}}
                {{--                                    <option value=""></option>--}}
                {{--                                    @for($i=2000; $i<=2100; $i++)--}}
                {{--                                        <option value="{{$i}}">{{$i}}</option>--}}
                {{--                                    @endfor--}}
                {{--                                </select>--}}
                {{--                            </div>--}}
                {{--                        </form>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
                {{--                <div class="cate">--}}
                {{--                    <label class="title">{{ \App\Helpers\Helpers::langDefine('TIN TỨC CẬP NHẬT') }}</label>--}}
                {{--                </div>--}}
                <div class="wrap-news">
                    <div class="news-list">
                        <ul>
                            @foreach($data['newpost'] as $k=>$i)
                                @if(!$k)
                                    <li>
                                        <div class="relative">
                                            <div class="absolute bg-new-i"
                                                 style='background: url("{{ \App\Helpers\Helpers::renderThumb($i->thumbnail, 'new_list_big') }}")'></div>
                                            <div class="item bg-it">
                                                <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                   title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                    <img src="{{ \App\Helpers\Helpers::renderThumb($i->thumbnail, 'new_list') }}"
                                                         title="{{ \App\Helpers\Helpers::lang($i, "title") }}"
                                                         alt="{{ \App\Helpers\Helpers::lang($i, "title") }}"/>
                                                </a>
                                                <div class="content-data content-dataff">
                                                    <div class="category-nh">
                                                        {{ !empty($data['cates'][$i->category_id]) ? \App\Helpers\Helpers::lang($data['cates'][$i->category_id], "title") : ''}}
                                                    </div>
                                                    <h4 class="wow fadeInRight" data-wow-offset="2">
                                                        <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                           title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                            {{ \App\Helpers\Helpers::lang($i, "title") }}
                                                        </a>
                                                    </h4>
                                                    <div class="shortdes wow fadeInLeft"
                                                         data-wow-offset="2">
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
                                        </div>
                                    </li>
                                    <li>
                                        <div class="relative">
                                            <div class="absolute style-2new bg-it">
                                                <div class="item bg-it">
                                                    <div class="content-data content-dataff">
                                                        <div class="category-nh">
                                                            {{ !empty($data['cates'][$i->category_id]) ? \App\Helpers\Helpers::lang($data['cates'][$i->category_id], "title") : ''}}
                                                        </div>
                                                        <h4 class="wow fadeInRight" data-wow-offset="2">
                                                            <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                               title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                                {{ \App\Helpers\Helpers::lang($i, "title") }}
                                                            </a>
                                                        </h4>
                                                        <div class="shortdes wow fadeInLeft"
                                                             data-wow-offset="2">
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
                                            </div>
                                            <div class="item bg-it">
                                                <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                   title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                    <img src="{{ \App\Helpers\Helpers::renderThumb($i->thumbnail, 'new_list') }}"
                                                         title="{{ \App\Helpers\Helpers::lang($i, "title") }}"
                                                         alt="{{ \App\Helpers\Helpers::lang($i, "title") }}"/>
                                                </a>
                                                <div class="content-data content-dataff">
                                                    <div class="category-nh">
                                                        {{ !empty($data['cates'][$i->category_id]) ? \App\Helpers\Helpers::lang($data['cates'][$i->category_id], "title") : ''}}
                                                    </div>
                                                    <h4 class="wow fadeInRight" data-wow-offset="2">
                                                        <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                           title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                            {{ \App\Helpers\Helpers::lang($i, "title") }}
                                                        </a>
                                                    </h4>
                                                    <div class="shortdes wow fadeInLeft"
                                                         data-wow-offset="2">
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
                                        </div>
                                    </li>
                                @else
                                    <li style="{{ $k >= 5 ? 'display: none' : '' }}">
                                        <div class="item bg-it">
                                            <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                               title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                <img src="{{ \App\Helpers\Helpers::renderThumb($i->thumbnail, 'new_list') }}"
                                                     title="{{ \App\Helpers\Helpers::lang($i, "title") }}"
                                                     alt="{{ \App\Helpers\Helpers::lang($i, "title") }}"/>
                                            </a>
                                            <div class="content-data content-dataff">
                                                <div class="category-nh">
                                                    {{ !empty($data['cates'][$i->category_id]) ? \App\Helpers\Helpers::lang($data['cates'][$i->category_id], "title") : ''}}
                                                </div>
                                                <h4 class="wow fadeInRight" data-wow-offset="2">
                                                    <a href="{{ route('client.post.show', ['slug' => $i->slug]) }}"
                                                       title="{{ \App\Helpers\Helpers::lang($i, "title") }}">
                                                        {{ \App\Helpers\Helpers::lang($i, "title") }}
                                                    </a>
                                                </h4>
                                                <div class="shortdes wow fadeInLeft"
                                                     data-wow-offset="2">
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
                        <div style="clear: both;"></div>
                        <div class="wrap-loading" style="display: none;">
                            <img src="{{ asset('web/images/loading.gif') }}" width="65"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
            var proH = $('.news-list').innerHeight();
            var curPos = $(document).scrollTop();

            var listLi = document.querySelectorAll('.news-list ul li')

            var j = 0;
            if (curPos >= proH - 100) {
                for (var i = 0; i < listLi.length; i++) {
                    if (listLi[i].getAttribute('style') === 'display: none') {
                        listLi[i].removeAttribute('style');
                        j++;
                        if (j >= 6) break;
                    }
                }
                $('.wrap-loading').hide();
            }
        }
    </script>
@endsection
