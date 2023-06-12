@extends('clients::layouts.product')

@section('content')
    <section id="wrap-product-category">
        <div class="pc-head">
            <h1 class="title-cate-game">{{ \App\Helpers\Helpers::lang($data['detail'], "title") }}</h1>
        </div>
        <div class="content-game ctct">
            <?php echo \App\Helpers\Helpers::renderHtmlDescription(\App\Helpers\Helpers::lang($data['detail'], "description")); ?>
        </div>
        @if(!empty($data['detail']->play_cover))
            <div class="detail-cover mb-5">
                <img src="{{ $data['detail']->play_cover }}"/>
            </div>
        @endif
        <div class="wrap-content-app-detail">
            @if(!empty(\App\Helpers\Helpers::renderHtmlDescription(\App\Helpers\Helpers::lang($data['detail'], "mod_feature"))))
                <div class="title-c">{{ \App\Helpers\Helpers::langDefine("Mod feature") }}</div>
                <div class="content-game ctct">
                    <?php echo \App\Helpers\Helpers::renderHtmlDescription(\App\Helpers\Helpers::lang($data['detail'], "mod_feature")); ?>
                </div>
            @endif
            <div class="title-c">{{ \App\Helpers\Helpers::langDefine("Original Version") }}</div>
            <div class="mb-4">
                <table class="table table-striped table-bordered">
                    <tbody>
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
                    @endphp
                    @foreach($arr as $k => $row)
                        @if(!empty($row))
                            @php
                                $ex = explode("/", $row);
                                $name = !empty($ex[count($ex) - 1]) ? $ex[count($ex) - 1] : "";
                            @endphp
                            <tr>
                                <td width="30" class="title-icon">1</td>
                                <td class="title-v">{{ !empty($arr_appname[$k]) ? $arr_appname[$k] : "" }}</td>
                                <td class="title-v">
                                    <a href="{{ route("client.product.showDownloadApp", ['type' => "original-version-" . ($k + 1), 'slug' => $data['detail']->slug]) }}">
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
                @if(!empty($data_common['setting']->ads4))
                    <div class="mb-4">
                        {!! $data_common['setting']->ads4 !!}
                    </div>
                @endif
            @endif

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
            <div class="title-c">{{ \App\Helpers\Helpers::langDefine("Last Version") }}</div>
            <div class="mb-4">
                <table class="table table-striped table-bordered">
                    <tbody>
                    @foreach($arr as $k => $row)
                        @if(!empty($row))
                            @php
                                $ex = explode("/", $row);
                                $name = !empty($ex[count($ex) - 1]) ? $ex[count($ex) - 1] : "";
                            @endphp
                            <tr>
                                <td width="30" class="title-icon">{{ ($k + 1) }}</td>
                                <td class="title-v">{{ !empty($arr_appname[$k]) ? $arr_appname[$k] : "" }}</td>
                                <td class="title-v">
                                    <a href="{{ route("client.product.showDownloadApp", ['type' => "last-version-" . ($k + 1), 'slug' => $data['detail']->slug]) }}">
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
                @if(!empty($data_common['setting']->ads5))
                    <div class="mb-4">
                        {!! $data_common['setting']->ads5 !!}
                    </div>
                @endif
            @endif
        </div>
    </section>
@endsection
