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
                <div class="cate">
                    <ul>
                        @foreach($data['cate'] as $k=>$row)
                            <li class="{{ !$k ? 'active' : '' }}">
                                <h2>
                                    <a href="{{ route('client.category.index', ['slug' => $row->slug]) }}"
                                       title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                        {{ \App\Helpers\Helpers::lang($row, "title") }}
                                    </a>
                                </h2>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if($data['category']->type == 'new_event')
                    <div class="fillter-bc">
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
                @endif
                <div class="wrap-news">
                    {{--                    @foreach($data['newpost'] as $row)--}}
                    {{--                        <div class="new-hot">--}}
                    {{--                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}" title="{{ \App\Helpers\Helpers::lang($row, "title") }}">--}}
                    {{--                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'new_hot') }}"--}}
                    {{--                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}"--}}
                    {{--                                     alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>--}}
                    {{--                            </a>--}}
                    {{--                            <div class="content-data">--}}
                    {{--                                <h3>--}}
                    {{--                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}" title="{{ \App\Helpers\Helpers::lang($row, "title") }}">--}}
                    {{--                                        {{ \App\Helpers\Helpers::lang($row, "title") }}--}}
                    {{--                                    </a>--}}
                    {{--                                </h3>--}}
                    {{--                                <div class="shortdes">--}}
                    {{--                                    {!! \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 400) !!}--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        @php break; @endphp--}}
                    {{--                    @endforeach--}}
                    <div class="news-list">
                        <ul>
                            @foreach($data['newpost'] as $k=>$row)
                                @if($k >= 0)
                                    <li style="{{ $k >= 7 ? 'display: none' : '' }}">
                                        <div class="item bg-it">
                                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                               title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'new_list') }}"
                                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                                     alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                            </a>
                                            <div class="content-data content-data-new">
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
