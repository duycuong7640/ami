@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="post" action="" class="forms-sample" id="form-edit">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <a href="{{ route("client.product.show", ["slug" => $data['detail']->slug]) }}"
                                   target="_blank">
                                    <button type="button" class="btn btn-success">
                                        View
                                    </button>
                                </a>
                                <button type="submit" class="btn btn-success">
                                    @lang('admins::layer.button.submit')
                                </button>
                                <a href="{{ route('admin.product.index') }}">
                                    <button type="button" class="btn btn-inverse-dark">
                                        @lang('admins::layer.button.cancel')
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-danger tabClick" data-locale="vn">
                                    Tiếng việt
                                </button>
                                <button type="button" class="btn btn-success tabClick" data-locale="en">
                                    Tiếng anh
                                </button>
                            </div>

                            <div id="tab_vn" class="tabHide">
                                <div class="form-group">
                                    <label>EN</label>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title" value="{{ $data['detail']->title }}"
                                           class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" name="slug" value="{{ $data['detail']->slug }}"
                                           class="form-control"
                                           placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label id="urlfull" data-url="{{ asset("/") }}">Link: <a
                                                href="{{ asset("/").$data['detail']->slug.".htm" }}">{{ asset("/").$data['detail']->slug.".htm" }}</a></label>
                                </div>
                                <div class="form-group">
                                    <label>Giá bán</label>
                                    <input type="text" name="price" value="{{ $data['detail']->price }}"
                                           class="form-control" placeholder=""/>
                                </div>
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Giá gốc</label>--}}
                                {{--                                <input type="text" name="price_root" value="{{ $data['detail']->price_root }}"--}}
                                {{--                                       class="form-control" placeholder=""/>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Số lượng sản phẩm</label>--}}
                                {{--                                <input type="text" name="quantity" value="{{ $data['detail']->quantity }}"--}}
                                {{--                                       class="form-control" placeholder=""/>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Url affilate</label>--}}
                                {{--                                <input type="text" name="url_buy" value="{{ $data['detail']->url_buy }}"--}}
                                {{--                                       class="form-control" placeholder=""/>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Tel</label>--}}
                                {{--                                <input type="text" name="tel" value="{{ $data['detail']->tel }}" class="form-control"--}}
                                {{--                                       placeholder=""/>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Facebook url</label>--}}
                                {{--                                <input type="text" name="face_url" value="{{ $data['detail']->face_url }}"--}}
                                {{--                                       class="form-control" placeholder=""/>--}}
                                {{--                            </div>--}}
                                <div class="form-group">
                                    <label>Danh mục chính</label>
                                    <select name="category_id" class="form-control col-md-3">
                                        {!! $data['category']['select'] !!}
                                    </select>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label>Danh mục liên quan</label>
                                    <div class="multi-category">
                                        <ul>
                                            <li>
                                                @php $dem = 0; @endphp
                                                @foreach($data['category']['list'] as $k => $row)
                                                    @php
                                                        if($dem) if(!strpos('string'.$row, '--')) echo '</li><li>';
                                                        $dem ++;
                                                    @endphp
                                                    <div>
                                                        <label>
                                                            <input type="checkbox"
                                                                   {{ (in_array($k, explode('|', $data['detail']->category_multi))) ? 'checked' : '' }} name="category_multi[]"
                                                                   value="{{ $k }}">
                                                            {{ $row }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="{{ asset($data['detail']->thumbnail) }}" width="150" class="mb-2">
                                            <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                                <input id="thumbnail" class="form-control"
                                                       value="{{ $data['detail']->thumbnail }}" type="text"
                                                       name="thumbnail"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả top detail</label>
                                    <textarea type="text" name="des" id="des" class="form-control" placeholder="">{{ $data['detail']->des }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="ckeditor-mini"
                                              name="description">{{ $data['detail']->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="ckeditor" name="content">{{ $data['detail']->content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="status"
                                                           value="1" {{ ($data['detail']->status == 1) ? 'checked' : '' }}>
                                                    @lang('admins::layer.status.active')
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="status"
                                                           value="0" {{ ($data['detail']->status == 0) ? 'checked' : '' }}>
                                                    @lang('admins::layer.status.no_active')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('error'))
                                    <p class="alert alert-danger">{{$errors->first('error')}}</p>
                                @endif
                            </div>
                            <div id="tab_en" class="tabHide" style="display: none;">
                                <div class="form-group">
                                    <label>EN</label>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title_es" class="form-control"
                                           value="{{ $data['detail']->title_es }}" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả top detail</label>
                                    <textarea type="text" name="des_en" id="des_en" class="form-control" placeholder="">{{ $data['detail']->des_en }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="ckeditor-mini"
                                              name="description_es">{{ $data['detail']->description_es }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="ckeditor"
                                              name="content_es">{{ $data['detail']->content_es }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row tabHide" id="tab_vn_seo">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>VN</label>
                            </div>
                            <div class="form-group">
                                <label>Title seo <span id="title_seo_1"
                                                       style="color: red;">{{ !empty($data['detail']->title_seo) ? "Ký tự: " . strlen($data['detail']->title_seo) : "" }}</span></label>
                                <textarea type="text" name="title_seo" id="title_seo" onkeyup="countChar('title_seo');"
                                          class="form-control"
                                          placeholder="">{{ $data['detail']->title_seo }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta des <span id="meta_des_1"
                                                      style="color: red;">{{ !empty($data['detail']->meta_des) ? "Ký tự: " . strlen($data['detail']->meta_des) : "" }}</span></label>
                                <textarea type="text" name="meta_des" id="meta_des" onkeyup="countChar('meta_des');"
                                          class="form-control"
                                          placeholder="">{{ $data['detail']->meta_des }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta key <span id="meta_key_1"
                                                      style="color: red;">{{ !empty($data['detail']->meta_key) ? "Ký tự: " . strlen($data['detail']->meta_key) : "" }}</span></label>
                                <textarea type="text" name="meta_key" id="meta_key" onkeyup="countChar('meta_key');"
                                          class="form-control"
                                          placeholder="">{{ $data['detail']->meta_key }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row tabHide" id="tab_en_seo" style="display: none;">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>EN</label>
                            </div>
                            <div class="form-group">
                                <label>Title seo <span id="title_seo_es_1"
                                                       style="color: red;">{{ !empty($data['detail']->title_seo_es) ? "Ký tự: " . strlen($data['detail']->title_seo_es) : "" }}</span></label>
                                <textarea type="text" name="title_seo_es" id="title_seo_es" onkeyup="countChar('title_seo_es');"
                                          class="form-control"
                                          placeholder="">{{ $data['detail']->title_seo_es }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta des <span id="meta_des_es_1"
                                                      style="color: red;">{{ !empty($data['detail']->meta_des_es) ? "Ký tự: " . strlen($data['detail']->meta_des_es) : "" }}</span></label>
                                <textarea type="text" name="meta_des_es" id="meta_des_es" onkeyup="countChar('meta_des_es');"
                                          class="form-control"
                                          placeholder="">{{ $data['detail']->meta_des_es }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta key <span id="meta_key_es_1"
                                                      style="color: red;">{{ !empty($data['detail']->meta_key_es) ? "Ký tự: " . strlen($data['detail']->meta_key_es) : "" }}</span></label>
                                <textarea type="text" name="meta_key_es" id="meta_key_es" onkeyup="countChar('meta_key_es');"
                                          class="form-control"
                                          placeholder="">{{ $data['detail']->meta_key_es }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    @lang('admins::layer.button.submit')
                                </button>
                                <a href="{{ route('admin.product.index') }}">
                                    <button type="button" class="btn btn-inverse-dark">
                                        @lang('admins::layer.button.cancel')
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $("input[name='slug']").keyup(function () {
            var url = $("#urlfull").data("url");
            $("#urlfull a").attr("href", url + $(this).val() + ".htm");
            $("#urlfull a").html(url + $(this).val() + ".htm");
        });

        function countChar(type) {
            var str = document.getElementById(type).value;
            $("#" + type + "_1").html("Ký tự: " + str.length + "");
        }

        $(".tabClick").click(function () {
            $(".tabClick").removeClass("btn-danger");
            $(this).addClass("btn-danger");
            var locale = $(this).data("locale");
            $(".tabHide").hide();
            $("#tab_" + locale).show();
            $("#tab_" + locale + "_seo").show();
        });

        function htmlFile(file) {
            $str = '<div style="background: #fff; margin-bottom: 15px; padding: 10px 10px 2px 10px;">\n' +
                '                                                    <div class="form-group">\n' +
                '                                                        <label>File app</label>\n' +
                '                                                        <input class="form-control" type="text"\n' +
                '                                                               name="file_multi_original_' + file + '[]"\n' +
                '                                                        >\n' +
                '                                                    </div>\n' +
                '                                                    <div class="form-group">\n' +
                '                                                        <label>Name app</label>\n' +
                '                                                        <input type="text" name="app_name_multi_original_' + file + '[]" class="form-control"\n' +
                '                                                               placeholder=""/>\n' +
                '                                                    </div>\n' +
                '                                                </div>';
            return $str;
        }

        function addFile(file) {
            $('#addFile_' + file).append(htmlFile(file));
        }

        function htmlFileLast(file) {
            $str = '<div style="background: #fff; margin-bottom: 15px; padding: 10px 10px 2px 10px;">\n' +
                '                                                    <div class="form-group">\n' +
                '                                                        <label>File app</label>\n' +
                '                                                        <input class="form-control" type="text"\n' +
                '                                                               name="file_multi_' + file + '[]"\n' +
                '                                                        >\n' +
                '                                                    </div>\n' +
                '                                                    <div class="form-group">\n' +
                '                                                        <label>Name app</label>\n' +
                '                                                        <input type="text" name="app_name_multi_' + file + '[]" class="form-control"\n' +
                '                                                               placeholder=""/>\n' +
                '                                                    </div>\n' +
                '                                                </div>';
            return $str;
        }

        function addFileLast(file) {
            $('#addFileLast_' + file).append(htmlFileLast(file));
        }
    </script>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Product\EditRequest','#form-edit'); !!}
@endsection
