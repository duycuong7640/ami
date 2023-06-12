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
        <section class="wrap-slide-manager">
            <div class="main-width">
                <div class="title">{{ \App\Helpers\Helpers::langDefine('BAN LÃNH ĐẠO') }}</div>
                <div class="shortdes">
                    <img src="{{ asset('web/images/icon/icon_ar.svg') }}" title="" alt=""/><br/><br/>
                    {!! \App\Helpers\Helpers::lang($data['category'], "description2") !!}
                </div>
                <div class="content-slide">
                    <div id="jssor_1"
                         style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;visibility:hidden;">
                        <!-- Loading Screen -->
                        <div data-u="loading" class="jssorl-009-spin"
                             style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;"
                                 src="img/spin.svg"/>
                        </div>
                        <div data-u="slides"
                             style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
                            @foreach($data['fixtthree'] as $k=>$row)
                                <div class="b-img-slide">
                                    <div class="b-manager">
                                        <a href="" title="">
                                            <img src="{{ \App\Helpers\Helpers::renderThumb('/storage/photos/ld1.png', 'manager') }}"
                                                 title="" alt=""/>
                                        </a>
                                        <div class="content-data">
                                            <div class="mn-title">{{ \App\Helpers\Helpers::lang($row, "title") }}</div>
                                            <div class="mn-position">{{ \App\Helpers\Helpers::lang($row, "position") }}</div>
                                            <div class="mn-shortdes">
                                                {!! \App\Helpers\Helpers::lang($row, "description") !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a data-scale="0" href="https://www.jssor.com"
                           style="display:none;position:absolute;">animation</a>
                        <!-- Bullet Navigator -->
                        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:20px;right:16px;"
                             data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                            <div data-u="prototype" class="i" style="width:12px;height:12px;">
                                <svg viewbox="0 0 16000 16000"
                                     style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                </svg>
                            </div>
                        </div>
                        <!-- Arrow Navigator -->
                        {{--                        <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:35px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">--}}
                        {{--                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">--}}
                        {{--                                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>--}}
                        {{--                            </svg>--}}
                        {{--                        </div>--}}
                        {{--                        <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:35px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">--}}
                        {{--                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">--}}
                        {{--                                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>--}}
                        {{--                            </svg>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </section>
        <section class="wrap-manager-share">
            <div class="main-width">
                <h2 class="title">{{ \App\Helpers\Helpers::langDefine('CỐ VẤN CHIẾN LƯỢC') }}</h2>
                <div class="content-data">
                    <ul>
                        @foreach($data['list'] as $k=>$row)
                            <li>
                                <div class="item">
                                    <div class="b-show">
                                        <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'lanhdao') }}"
                                             title="" alt=""/>
                                        <h3>{{ \App\Helpers\Helpers::lang($row, "title") }}</h3>
                                        <p class="position">{{ \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 35) }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('web/slide/js/jssor.slider-28.1.0.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.jssor_1_slider_init = function () {

            var jssor_1_options = {
                $AutoPlay: 0,
                $SlideWidth: 720,
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$,
                    $SpacingX: 16,
                    $SpacingY: 16
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 1440;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                } else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <script type="text/javascript">jssor_1_slider_init();</script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('/web/slide/css/style.css') }}"/>
@endsection