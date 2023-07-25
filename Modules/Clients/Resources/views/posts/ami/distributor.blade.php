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
        <section class="wrap-ex-one wrap-ex-one2">
            <div class="main-width">
                <div class="ex-des">
                    {!! \App\Helpers\Helpers::lang($data['category'], "description2") !!}
                </div>
            </div>
        </section>
        <section class="wrap-distributors">
            <div class="main-width">
                <div class="head">{{ \App\Helpers\Helpers::langDefine('NHÀ PHÂN PHỐI DẪN ĐẦU') }}</div>
                <div class="wrap-list-distributors">
                    <ul>
                        @foreach($data['list'] as $k=>$row)
                            <li style="{{ $k >= 9 ? 'display: none' : '' }}">
                                <div class="item">
                                    <div class="content-data">
                                        <a href="" title="">
                                            <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'lanhdao') }}"
                                                 title="" alt=""/>
                                        </a>
                                        <h3 class="title">{{ \App\Helpers\Helpers::lang($row, "title") }}</h3>
                                        <div class="shortdes">{{ \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 35) }}</div>
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
            var proH = $('.wrap-list-distributors').innerHeight();
            var curPos = $(document).scrollTop();

            var listLi = document.querySelectorAll('.wrap-list-distributors ul li')

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
