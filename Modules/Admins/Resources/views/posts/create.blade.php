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
                                <a href="{{ route('admin.category.index') }}">
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
                                <div style="padding: 15px; background: #ddd; display: none;">
                                    <div class="form-group">
                                        <label>Diễn ra lúc</label>
                                        <div style="overflow: hidden; clear: both;">
                                            <select name="d" class="form-control" style="width: 80px; float: left;">
                                                <option value="">Ngày</option>
                                                @for($i=1; $i<=31; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <select name="m" class="form-control" style="width: 85px; float: left; margin: 0 10px;">
                                                <option value="">Tháng</option>
                                                @for($i=1; $i<=12; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <select name="y" class="form-control" style="width: 80px; float: left;">
                                                <option value="">Năm</option>
                                                @for($i=2000; $i<=2100; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <select name="h" class="form-control" style="width: 80px; float: left; margin: 0 10px;">
                                                <option value="0">Giờ</option>
                                                @for($i=0; $i<=23; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <select name="i" class="form-control" style="width: 80px; float: left;">
                                                <option value="0">Phút</option>
                                                @for($i=0; $i<=59; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <select name="s" class="form-control" style="width: 80px; float: left; margin: 0 10px;">
                                                <option value="0">Giây</option>
                                                @for($i=0; $i<=59; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Vị trí</label>
                                        <input type="text" name="tai" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="form-group">
                                        <label>Vị trí link</label>
                                        <input type="text" name="tai_link" class="form-control" placeholder=""/>
                                    </div>
                                </div>
                                <div style="clear: both; margin-bottom: 15px;"></div>
                                <div class="form-group">
                                    <label>Danh mục chính</label>
                                    <select name="category_id" class="form-control col-md-3">
                                        {!! $data['category']['select'] !!}
                                    </select>
                                </div>
                                <div class="form-group">
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
                                                            <input type="checkbox" name="category_multi[]" value="{{ $k }}">
                                                            {{ $row }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="ckeditor-mini" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="ckeditor" name="content"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tag content</label>
                                    <textarea class="ckeditor" name="tag_content"></textarea>
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
                                                    <input type="radio" class="form-check-input" name="status" value="0">
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
                                    <input type="text" name="title_en" class="form-control" placeholder=""/>
                                </div>
                                <div style="padding: 15px; background: #ddd; display: none;">
                                    <div class="form-group">
                                        <label>Vị trí</label>
                                        <input type="text" name="tai_en" class="form-control" placeholder=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="ckeditor-mini" name="description_en"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="ckeditor" name="content_en"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tag content</label>
                                    <textarea class="ckeditor" name="tag_content_en"></textarea>
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
                                <label>Title seo</label>
                                <textarea type="text" name="title_seo" class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta des</label>
                                <textarea type="text" name="meta_des" class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta key</label>
                                <textarea type="text" name="meta_key" class="form-control" placeholder=""></textarea>
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
                                <label>Title seo</label>
                                <textarea type="text" name="title_seo_en" class="form-control"
                                          placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta des</label>
                                <textarea type="text" name="meta_des_en" class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta key</label>
                                <textarea type="text" name="meta_key_en" class="form-control" placeholder=""></textarea>
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
                                <a href="{{ route('admin.category.index') }}">
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
        $("input[name='title']").keyup(function(){
            var title = $(this).val();
            $("input[name='slug']").val(get_alias(title));

            var url = $("#urlfull").data("url");
            $("#urlfull a").attr("href", url + get_alias(title) + ".html");
            $("#urlfull a").html(url + get_alias(title) + ".html");
        });

        $(".tabClick").click(function () {
            $(".tabClick").removeClass("btn-danger");
            $(this).addClass("btn-danger");
            var locale = $(this).data("locale");
            $(".tabHide").hide();
            $("#tab_"+locale).show();
            $("#tab_" + locale + "_seo").show();
        });
    </script>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Post\CreateRequest','#form-create'); !!}
@endsection
