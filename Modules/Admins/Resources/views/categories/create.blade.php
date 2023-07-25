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
                        <div class="card-body">
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-danger tabClick" data-locale="vn">
                                    Tiếng việt
                                </button>
                                <button type="button" class="btn btn-success tabClick" data-locale="en">
                                    Tiếng anh
                                </button>
{{--                                <button type="button" class="btn btn-success tabClick" data-locale="es">--}}
{{--                                    Tây ban nha--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-success tabClick" data-locale="pt">--}}
{{--                                    Bồ đào nha--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-success tabClick" data-locale="id">--}}
{{--                                    Indonesia--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-success tabClick" data-locale="ph">--}}
{{--                                    Philippines--}}
{{--                                </button>--}}
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
                                    <label>Tiêu đề 2</label>
                                    <input type="text" name="title2" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="description" placeholder="Mô tả" rows="4"
                                              class="form-control ckeditor"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả 2</label>
                                    <textarea name="description2" placeholder="Mô tả" rows="4"
                                              class="form-control ckeditor"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Vị trí</label>
                                    <input type="text" name="sort" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Thuộc danh mục</label>
                                    <select name="parent_id" class="form-control col-md-3">
                                        {!! $data['category'] !!}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Loại danh mục</label>
                                    <select name="type" class="form-control col-md-3">
                                        <option value=""></option>
                                        @foreach($type_cate as $row)
                                            <option value="{{ $row }}">{{ $type_text[$row] }}</option>
                                        @endforeach
                                    </select>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>Lọc thời gian</label>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-2">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <label class="form-check-label">--}}
{{--                                                    <input type="radio" class="form-check-input" name="st" value="1"--}}
{{--                                                           >--}}
{{--                                                    @lang('admins::layer.status.active')--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <label class="form-check-label">--}}
{{--                                                    <input type="radio" class="form-check-input" name="st"--}}
{{--                                                           value="0" checked>--}}
{{--                                                    @lang('admins::layer.status.no_active')--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label>Thumbnail</label>
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
                                    <label>Url redirect</label>
                                    <input type="text" name="url" class="form-control" placeholder=""/>
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
                                    <input type="text" name="title_en" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề 2</label>
                                    <input type="text" name="title2_en" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="description_en" placeholder="Mô tả" rows="4"
                                              class="form-control ckeditor"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả 2</label>
                                    <textarea name="description2_en" placeholder="Mô tả" rows="4"
                                              class="form-control ckeditor"></textarea>
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
        $(".tabClick").click(function () {
            $(".tabClick").removeClass("btn-danger");
            $(this).addClass("btn-danger");
            var locale = $(this).data("locale");
            $(".tabHide").hide();
            $("#tab_" + locale).show();
            $("#tab_" + locale + "_seo").show();
        });
    </script>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Category\CreateRequest','#form-create'); !!}
@endsection
