@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="post" action="" class="forms-sample" id="form-create">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
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
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        @if($errors->has('error'))
                            <p class="alert alert-danger">{{$errors->first('error')}}</p>
                        @endif
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
                                    <label>VN</label>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label id="urlfull" data-url="{{ asset("/") }}">Link: <a href=""></a></label>
                                </div>
                                <div class="form-group">
                                    <label>Giá bán</label>
                                    <input type="text" name="price" class="form-control" placeholder=""/>
                                </div>
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Giá gốc</label>--}}
                                {{--                                <input type="text" name="price_root" class="form-control" placeholder=""/>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Số lượng sản phẩm</label>--}}
                                {{--                                <input type="text" name="quantity" value="0" class="form-control" placeholder=""/>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Url affilate</label>--}}
                                {{--                                <input type="text" name="url_buy" value="" class="form-control" placeholder=""/>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Tel</label>--}}
                                {{--                                <input type="text" name="tel" value="" class="form-control" placeholder=""/>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Facebook url</label>--}}
                                {{--                                <input type="text" name="face_url" value="" class="form-control" placeholder=""/>--}}
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
                                                            <input type="checkbox" name="category_multi[]"
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
                                            <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder"
                                                   class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                                <input id="thumbnail" class="form-control" type="text" name="thumbnail"
                                                       readonly>
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">
                                        </div>
                                    </div>
                                </div>
                                @for($i = 0; $i < 5; $i ++)
                                    <div style="background: #fff; margin-bottom: 5px; padding: 10px 10px 2px 10px;">
                                        <div class="form-group">
                                            <label style="font-weight: bold; color: red; padding-left: 2px; padding-top: 8px; margin-bottom: 0;">File {{ $i + 1 }}</label>
                                        </div>
                                        <div class="form-group">
                                            <label>File</label>
                                            <input class="form-control" type="text"
                                                   name="file_multi[]"
                                            >
                                        </div>
                                    </div>
                                @endfor
                                <div class="form-group">
                                    <label>Mô tả top detail</label>
                                    <textarea type="text" name="des" id="des" class="form-control" placeholder=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="ckeditor-mini" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="ckeditor" name="content"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="status" value="1"
                                                           checked>
                                                    @lang('admins::layer.status.active')
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="status"
                                                           value="0">
                                                    @lang('admins::layer.status.no_active')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab_en" class="tabHide" style="display: none;">
                                <div class="form-group">
                                    <label>EN</label>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title_es" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả top detail</label>
                                    <textarea type="text" name="des_en" id="des_en" class="form-control" placeholder=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="ckeditor-mini" name="description_es"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="ckeditor" name="content_es"></textarea>
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
                                <label>Title seo <span id="title_seo_1" style="color: red;"></span></label>
                                <textarea type="text" name="title_seo" id="title_seo" onkeyup="countChar('title_seo');"
                                          class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta des <span id="meta_des_1" style="color: red;"></span></label>
                                <textarea type="text" name="meta_des" id="meta_des" onkeyup="countChar('meta_des');"
                                          class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta key <span id="meta_key_1" style="color: red;"></span></label>
                                <textarea type="text" name="meta_key" id="meta_key" onkeyup="countChar('meta_key');"
                                          class="form-control" placeholder=""></textarea>
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
                                <label>Title seo <span id="title_seo_es_1" style="color: red;"></span></label>
                                <textarea type="text" name="title_seo_es" id="title_seo_es" onkeyup="countChar('title_seo_es');"
                                          class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta des <span id="meta_des_es_1" style="color: red;"></span></label>
                                <textarea type="text" name="meta_des_es" id="meta_des_es" onkeyup="countChar('meta_des_es');"
                                          class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta key <span id="meta_key_es_1" style="color: red;"></span></label>
                                <textarea type="text" name="meta_key_es" id="meta_key_es" onkeyup="countChar('meta_key_es');"
                                          class="form-control" placeholder=""></textarea>
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
        $("input[name='title']").keyup(function () {
            var title = $(this).val();
            $("input[name='slug']").val(get_alias(title));

            var url = $("#urlfull").data("url");
            $("#urlfull a").attr("href", url + get_alias(title) + ".htm");
            $("#urlfull a").html(url + get_alias(title) + ".htm");
        });

        $('#loadData').on('click', function () {
            formdata = new FormData();
            formdata.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formdata.append('key', $("input[name=code]").val());
            $.ajax({
                url: '{{ route('api.product.loadData') }}',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.meta.status == 200) {
                        var filData = res.response;
                        setData("", "")
                        setData(filData, "data")
                    }
                },
                error: function (request, status, error) {
                    setData("", "")
                    console.log("Fail!");
                }
            });
        });

        function setData(res, type) {
            if (type == "") {
                $("input[name=play_image]").val("")
                $("#play_image").attr("src", "")

                $("input[name=play_cover]").val("")
                $("#play_cover").attr("src", "")

                $("input[name=play_name]").val("")
                $("input[name=play_updated]").val("")
                $("input[name=play_compatible_with]").val("")
                $("input[name=play_last_version]").val("")
                $("input[name=play_size]").val("")
                $("input[name=play_mod]").val("")
                $("input[name=play_dev]").val("")
                $("input[name=play_price]").val("Free")
            } else {
                console.log(res.play_image.url)
                $("input[name=play_image]").val(res.play_image)
                $("#play_image").attr("src", res.play_image)

                $("input[name=play_cover]").val(res.play_cover)
                $("#play_cover").attr("src", res.play_cover)

                $("input[name=play_name]").val(res.name)
                $("input[name=play_updated]").val(res.updated)
                $("input[name=play_compatible_with]").val(res.compatible_with)
                $("input[name=play_last_version]").val(res.version)
                $("input[name=play_size]").val(res.size)
                $("input[name=play_mod]").val(res.mod)
                $("input[name=play_dev]").val(res.develop)
                $("input[name=play_price]").val("Free")
            }
        }

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
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Product\CreateRequest','#form-create'); !!}
@endsection
