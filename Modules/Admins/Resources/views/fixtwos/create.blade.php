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
                                <a href="{{ route('admin.fixtwo.index') }}">
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
                                    <label>VN</label>
                                </div>
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" name="title" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Tên 2</label>
                                    <input type="text" name="title2" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="ckeditor-mini" name="description"></textarea>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label>Loại</label>
                                    <select name="type" class="form-control col-md-3">
                                        <option value="fixtwo">fixtwo</option>
                                        {{--                                    <option value="favico_web">Favico web</option>--}}
                                        {{--                                    <option value="favico_admin">Favico admin</option>--}}
                                        {{--                                    <option value="voucher">Voucher</option>--}}
                                    </select>
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
                                    <label>Tên</label>
                                    <input type="text" name="title_en" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Tên 2</label>
                                    <input type="text" name="title2_en" class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="ckeditor-mini" name="description_en"></textarea>
                                </div>
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
                                <a href="{{ route('admin.fixtwo.index') }}">
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
        });
    </script>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Advertisement\CreateRequest','#form-create'); !!}
@endsection
