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
                    <label class="title">{{ \App\Helpers\Helpers::langDefine('TIN TỨC CẬP NHẬT') }}</label>
                </div>
                <div class="wrap-news">
                    <div class="news-list">
                        <ul>
                            @foreach($data['newpost'] as $k=>$row)
                                    <li style="{{ $k >= 6 ? 'display: none' : '' }}">
                                        <div class="item">
                                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}" title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                                <img src="{{ \App\Helpers\Helpers::renderThumb('/storage/photos/1.png', 'new_list') }}"
                                                     title="{{ \App\Helpers\Helpers::lang($row, "title") }}" alt="{{ \App\Helpers\Helpers::lang($row, "title") }}"/>
                                            </a>
                                            <div class="content-data">
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
                        j ++;
                        if(j >= 6) break;
                    }
                }
                $('.wrap-loading').hide();
            }
        }
    </script>
@endsection
