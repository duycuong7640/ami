@extends('clients::layouts.product')

@section('content')
    <section id="wrap-product-category">
        @if(!empty($data['detail']->cover))
            <div class="detail-cover pt-3">
                <img src="{{ $data['detail']->cover }}"/>
            </div>
        @else
            @if(!empty($data['detail']->play_cover))
                <div class="detail-cover pt-3">
                    <img src="{{ $data['detail']->play_cover }}"/>
                </div>
            @endif
        @endif
        <div class="pc-head text-center pt-5">
            <h1 class="title-cate-game">{{ \App\Helpers\Helpers::lang($data['detail'], "title") }}</h1>
        </div>
        @if($data["down"] == "original")
            @php
                $files = explode("|", $data['detail']->file_multi_original);
                $arr = [];
                foreach ($files as $row) {
                    if (!empty($row)) $arr[] = $row;
                }

                $file_apps = explode("|", $data['detail']->app_name_multi_original);
                $arr_appname = [];
                foreach ($file_apps as $row) {
                    if (!empty($row)) $arr_appname[] = $row;
                }

                $files_child = explode("|", $data['detail']->file_multi_original_1);
                $arr_child = [];
                foreach ($files_child as $row) {
                    if (!empty($row)) $arr_child[] = $row;
                }

                $file_apps_child = explode("|", $data['detail']->app_name_multi_original_1);
                $arr_appname_child = [];
                foreach ($file_apps_child as $row) {
                    if (!empty($row)) $arr_appname_child[] = $row;
                }
            @endphp
            @if(empty($arr_child))
                @foreach($arr as $k => $row)
                    @if(!empty($row) && ($k == $data["file_down"] - 1))
                        @php
                            $ex = explode("/", $row);
                            $name = !empty($ex[count($ex) - 1]) ? $ex[count($ex) - 1] : "";
                        @endphp
                        <div class="game-download text-center">
                            <label>{{ !empty($arr_appname[$k]) ? $arr_appname[$k] : "" }}</label>
                        </div>
                        @if($data['detail']->choose_2)
                            @if(!empty($data_common['setting']->ads6))
                                <div class="mb-4">
                                    {!! $data_common['setting']->ads6 !!}
                                </div>
                            @endif
                        @endif
                        <div class="wrap-download">
                            <a href="{{ asset($row) }}"
                               rel="dofollow sponsored"
                               title="{{ !empty($arr_appname[$k]) ? $arr_appname[$k] : "" }}">
                                <div class="btnDownload">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    {{ \App\Helpers\Helpers::langDefine("START DOWNLOADING") }}
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="display: table; margin: 0 auto;">
                    <table class="table table-striped table-bordered">
                        <tbody>
                        @foreach($arr as $k => $row)
                            @if(!empty($row))
                                @php
                                    $ex = explode("/", $row);
                                    $name = !empty($ex[count($ex) - 1]) ? $ex[count($ex) - 1] : "";
                                @endphp
                                <tr>
                                    <td width="30" class="title-icon">1</td>
                                    <td class="title-v">{{ !empty($arr_appname[$k]) ? $arr_appname[$k] : "" }}</td>
                                    <td class="title-v" width="50">
                                        <a href="{{ $row }}">
                                            <button type="button" class="btn btn-secondary btn-sm">Download</button>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        @foreach($arr_child as $k => $row)
                            @if(!empty($row))
                                @php
                                    $ex = explode("/", $row);
                                    $name = !empty($ex[count($ex) - 1]) ? $ex[count($ex) - 1] : "";
                                @endphp
                                <tr>
                                    <td width="30" class="title-icon">{{ $k + 2 }}</td>
                                    <td class="title-v">{{ !empty($arr_appname_child[$k]) ? $arr_appname_child[$k] : "" }}</td>
                                    <td class="title-v">
                                        <a href="{{ $row }}">
                                            <button type="button" class="btn btn-secondary btn-sm">Download</button>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if($data['detail']->choose_2)
                    @if(!empty($data_common['setting']->ads6))
                        <div class="mb-4">
                            {!! $data_common['setting']->ads6 !!}
                        </div>
                    @endif
                @endif
            @endif
        @else
            @php
                $files = explode("|", $data['detail']->file_multi);
                $arr = [];
                foreach ($files as $row) {
                    if (!empty($row)) $arr[] = $row;
                }

                $file_apps = explode("|", $data['detail']->app_name_multi);
                $arr_appname = [];
                foreach ($file_apps as $row) {
                    if (!empty($row)) $arr_appname[] = $row;
                }
            @endphp
            @foreach($arr as $k => $row)
                @if(!empty($row) && ($k == $data["file_down"] - 1))
                    @php
                        $ex = explode("/", $row);
                        $name = !empty($ex[count($ex) - 1]) ? $ex[count($ex) - 1] : "";

                        $thumbnail_multi_last = [];
                        switch ($data["file_down"]){
                            case 1:
                                $thumbnail_multi_last = explode("|", $data['detail']->file_multi_1);
                                break;
                            case 2:
                                $thumbnail_multi_last = explode("|", $data['detail']->file_multi_2);
                                break;
                            case 3:
                                $thumbnail_multi_last = explode("|", $data['detail']->file_multi_3);
                                break;
                            case 4:
                                $thumbnail_multi_last = explode("|", $data['detail']->file_multi_4);
                                break;
                            case 5:
                                $thumbnail_multi_last = explode("|", $data['detail']->file_multi_5);
                                break;
                            default:
                                $thumbnail_multi_last = [];
                                break;
                        }
                        $arr_thumbnail_multi_last = [];
                        foreach ($thumbnail_multi_last as $row1){
                            if(!empty($row1)) $arr_thumbnail_multi_last[] = $row1;
                        }

                        $appname_multi_last = [];
                        switch ($data["file_down"]){
                            case 1:
                                $appname_multi_last = explode("|", $data['detail']->app_name_multi_1);
                                break;
                            case 2:
                                $appname_multi_last = explode("|", $data['detail']->app_name_multi_2);
                                break;
                            case 3:
                                $appname_multi_last = explode("|", $data['detail']->app_name_multi_3);
                                break;
                            case 4:
                                $appname_multi_last = explode("|", $data['detail']->app_name_multi_4);
                                break;
                            case 5:
                                $appname_multi_last = explode("|", $data['detail']->app_name_multi_5);
                                break;
                            default:
                                $appname_multi_last = [];
                                break;
                        }
                        $arr_appname_multi_last = [];
                        foreach ($appname_multi_last as $row1){
                            if(!empty($row1)) $arr_appname_multi_last[] = $row1;
                        }
                    @endphp
                    @if(empty($arr_thumbnail_multi_last))
                        <div class="game-download text-center">
                            <label>{{ !empty($arr_appname[$k]) ? $arr_appname[$k] : "" }}</label>
                        </div>
                        <div class="wrap-download">
                            <a href="{{ asset($row) }}"
                               rel="dofollow sponsored"
                               title="{{ !empty($arr_appname[$k]) ? $arr_appname[$k] : "" }}">
                                <div class="btnDownload">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    {{ \App\Helpers\Helpers::langDefine("START DOWNLOADING") }}
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="display: table; margin: 0 auto;">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                @php
                                    $dj = 1;
                                @endphp
                                @foreach($arr as $k => $row)
                                    @if(!empty($row))
                                        @if($k == ($data["file_down"] - 1))
                                            @php
                                                $ex = explode("/", $row);
                                                $name = !empty($ex[count($ex) - 1]) ? $ex[count($ex) - 1] : "";
                                            @endphp
                                            <tr>
                                                <td width="30" class="title-icon">{{ $dj }}</td>
                                                <td class="title-v">{{ !empty($arr_appname[$k]) ? $arr_appname[$k] : "" }}</td>
                                                <td class="title-v" width="50">
                                                    <a href="{{ $row }}">
                                                        <button type="button" class="btn btn-secondary btn-sm">Download
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php
                                                $dj++;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($arr_thumbnail_multi_last as $k => $row)
                                    @if(!empty($row))
                                        @php
                                            $ex = explode("/", $row);
                                            $name = !empty($ex[count($ex) - 1]) ? $ex[count($ex) - 1] : "";
                                        @endphp
                                        <tr>
                                            <td width="30" class="title-icon">{{ $dj }}</td>
                                            <td class="title-v">{{ !empty($arr_appname_multi_last[$k]) ? $arr_appname_multi_last[$k] : "" }}</td>
                                            <td class="title-v">
                                                <a href="{{ $row }}">
                                                    <button type="button" class="btn btn-secondary btn-sm">Download
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $dj++;
                                        @endphp
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            @endforeach
        @endif
        <div class="join-group-other pt-5 pb-2">
            <a href="{!! !empty($data_common['setting']->mxh_url1) ? $data_common['setting']->mxh_url1 : '' !!}"
               target="_blank">
                <button class="bt1"
                        type="button">{!! !empty($data_common['setting']->mxh_title1) ? $data_common['setting']->mxh_title1 : '' !!}</button>
            </a>
            <div class="pt-4"></div>
            <a href="{!! !empty($data_common['setting']->mxh_url2) ? $data_common['setting']->mxh_url2 : '' !!}"
               target="_blank">
                <button class="bt2"
                        type="button">{!! !empty($data_common['setting']->mxh_title2) ? $data_common['setting']->mxh_title2 : '' !!}</button>
            </a>
        </div>
        <div class="wrap-content-app-detail pt-5">
            <div class="title-c">{{ \App\Helpers\Helpers::langDefine("Description") }}</div>
            <div class="content-game ctct">
                <?php echo \App\Helpers\Helpers::renderHtmlDescription(\App\Helpers\Helpers::lang($data['detail'], "description")); ?>
            </div>
            @if(!empty(\App\Helpers\Helpers::renderHtmlDescription(\App\Helpers\Helpers::lang($data['detail'], "mod_feature"))))
                <div class="title-c">{{ \App\Helpers\Helpers::langDefine("Mod feature") }}</div>
                <div class="content-game ctct">
                    <?php echo \App\Helpers\Helpers::renderHtmlDescription(\App\Helpers\Helpers::lang($data['detail'], "mod_feature")); ?>
                </div>
            @endif
        </div>
        @if($data['detail']->choose_2)
            @if(!empty($data_common['setting']->ads7))
                <div class="mb-4 mt-4">
                    {!! $data_common['setting']->ads7 !!}
                </div>
            @endif
        @endif
    </section>
@endsection
