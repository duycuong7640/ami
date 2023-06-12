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
            @if(Session::has('success'))
                <p class="alert alert-success">{{Session::get('success')}}</p>
            @endif
            @if(Session::has('error'))
                <p class="alert alert-danger">{{Session::get('error')}}</p>
            @endif
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
                                    <label>Google index toàn trang</label>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                           name="status_gooogleindex"
                                                           value="1" {{ ($data['detail']->status_gooogleindex == 1) ? 'checked' : '' }}>
                                                    @lang('admins::layer.status.active')
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                           name="status_gooogleindex"
                                                           value="0" {{ ($data['detail']->status_gooogleindex == 0) ? 'checked' : '' }}>
                                                    @lang('admins::layer.status.no_active')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="name" value="{{ $data['detail']->name }}"
                                           class="form-control"
                                           placeholder=""/>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label>Home (url cơ hội kinh doanh)</label>
                                    <input type="text" name="url_dinhhuong" value="{{ $data['detail']->url_dinhhuong }}"
                                           class="form-control"
                                           placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <input type="text" name="email" value="{{ $data['detail']->email }}"
                                                   class="form-control" placeholder=""/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Hotline</label>
                                            <input type="text" name="hotline" value="{{ $data['detail']->hotline }}"
                                                   class="form-control" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>Địa chỉ</label>--}}
{{--                                    <input type="text" name="address" value="{{ $data['detail']->address }}"--}}
{{--                                           class="form-control" placeholder=""/>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Instagram</label>
                                            <input type="text" name="instagram" value="{{ $data['detail']->instagram }}"
                                                   class="form-control" placeholder=""/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Facebook</label>
                                            <input type="text" name="facebook" value="{{ $data['detail']->facebook }}"
                                                   class="form-control" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Youtube</label>
                                            <input type="text" name="youtube" value="{{ $data['detail']->youtube }}"
                                                   class="form-control" placeholder=""/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Google</label>
                                            <input type="text" name="google" value="{{ $data['detail']->google }}"
                                                   class="form-control" placeholder=""/>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Zalo</label>
                                            <input type="text" name="zalo" value="{{ $data['detail']->zalo }}"
                                                   class="form-control" placeholder=""/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Message</label>
                                            <input type="text" name="mxh_url1" value="{{ $data['detail']->mxh_url1 }}"
                                                   class="form-control" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>Telephone</label>--}}
{{--                                    <input type="text" name="telephone" value="{{ $data['detail']->telephone }}"--}}
{{--                                           class="form-control" placeholder=""/>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label>Code header</label>
                                    <textarea name="code_header" class="form-control"
                                              rows="8">{{ $data['detail']->code_header }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Code body</label>
                                    <textarea name="code_body" class="form-control"
                                              rows="8">{{ $data['detail']->code_body }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Code footer</label>
                                    <textarea name="code_footer" class="form-control"
                                              rows="8">{{ $data['detail']->code_footer }}</textarea>
                                </div>
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Content payment card</label>--}}
                                {{--                                <textarea class="ckeditor" class="form-control"--}}
                                {{--                                          name="content_pay">{{ $data['detail']->content_pay }}</textarea>--}}
                                {{--                            </div>--}}
                                <div class="form-group">
                                    <label>Content footer</label>
                                    <textarea class="ckeditor" class="form-control"
                                              name="content_footer">{{ $data['detail']->content_footer }}</textarea>
                                </div>
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Thông tin liên hệ</label>--}}
                                {{--                                <textarea class="ckeditor" class="form-control"--}}
                                {{--                                          name="content_contact">{{ $data['detail']->content_contact }}</textarea>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Thông tin thanh toán thành công</label>--}}
                                {{--                                <textarea class="ckeditor" class="form-control"--}}
                                {{--                                          name="content_pay_suc">{{ $data['detail']->content_pay_suc }}</textarea>--}}
                                {{--                            </div>--}}
                                <div class="form-group">
                                    <label>Copyright</label>
                                    <textarea class="form-control"
                                              name="copyright">{{ $data['detail']->copyright }}</textarea>
                                </div>
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Ads top</label>--}}
                                {{--                                <textarea class="form-control" name="ads1">{{ $data['detail']->ads1 }}</textarea>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Ads bottom</label>--}}
                                {{--                                <textarea class="form-control" name="ads2">{{ $data['detail']->ads2 }}</textarea>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Ads right</label>--}}
                                {{--                                <textarea class="form-control" name="ads3">{{ $data['detail']->ads3 }}</textarea>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Quảng cáo 1</label>--}}
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col-md-6">--}}
                                {{--                                        <img src="{{ asset($data['detail']->ads1) }}" width="150" class="mb-2">--}}
                                {{--                                        <div class="input-group">--}}
                                {{--                                            <span class="input-group-btn">--}}
                                {{--                                                <a data-input="ads1" class="lfm btn btn-primary">--}}
                                {{--                                                    <i class="fa fa-picture-o"></i> CHOOSE--}}
                                {{--                                                </a>--}}
                                {{--                                            </span>--}}
                                {{--                                            <input id="ads1" class="form-control"--}}
                                {{--                                                   value="{{ $data['detail']->ads1 }}" type="text" name="ads1"--}}
                                {{--                                                   readonly>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Url</label>--}}
                                {{--                                <textarea class="form-control" name="ads1_url">{{ $data['detail']->ads1_url }}</textarea>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Quảng cáo 1</label>--}}
                                {{--                                <textarea class="form-control" name="ads1">{{ $data['detail']->ads1 }}</textarea>--}}
                                {{--                            </div>--}}

                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Quảng cáo 2</label>--}}
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col-md-6">--}}
                                {{--                                        <img src="{{ asset($data['detail']->ads2) }}" width="150" class="mb-2">--}}
                                {{--                                        <div class="input-group">--}}
                                {{--                                            <span class="input-group-btn">--}}
                                {{--                                                <a data-input="ads2" class="lfm btn btn-primary">--}}
                                {{--                                                    <i class="fa fa-picture-o"></i> CHOOSE--}}
                                {{--                                                </a>--}}
                                {{--                                            </span>--}}
                                {{--                                            <input id="ads2" class="form-control"--}}
                                {{--                                                   value="{{ $data['detail']->ads2 }}" type="text" name="ads2"--}}
                                {{--                                                   readonly>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Url</label>--}}
                                {{--                                <textarea class="form-control" name="ads2_url">{{ $data['detail']->ads2_url }}</textarea>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Quảng cáo 2</label>--}}
                                {{--                                <textarea class="form-control" name="ads2">{{ $data['detail']->ads2 }}</textarea>--}}
                                {{--                            </div>--}}

                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Quảng cáo 3</label>--}}
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col-md-6">--}}
                                {{--                                        <img src="{{ asset($data['detail']->ads3) }}" width="150" class="mb-2">--}}
                                {{--                                        <div class="input-group">--}}
                                {{--                                            <span class="input-group-btn">--}}
                                {{--                                                <a data-input="ads3" class="lfm btn btn-primary">--}}
                                {{--                                                    <i class="fa fa-picture-o"></i> CHOOSE--}}
                                {{--                                                </a>--}}
                                {{--                                            </span>--}}
                                {{--                                            <input id="ads3" class="form-control"--}}
                                {{--                                                   value="{{ $data['detail']->ads3 }}" type="text" name="ads3"--}}
                                {{--                                                   readonly>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Url</label>--}}
                                {{--                                <textarea class="form-control" name="ads3_url">{{ $data['detail']->ads3_url }}</textarea>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>Quảng cáo 3</label>--}}
                                {{--                                <textarea class="form-control" name="ads3">{{ $data['detail']->ads3 }}</textarea>--}}
                                {{--                            </div>--}}
                            </div>
                            <div id="tab_en" class="tabHide" style="display: none;">
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="name_en" value="{{ $data['detail']->name_en }}"
                                           class="form-control"
                                           placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Content footer</label>
                                    <textarea class="ckeditor" class="form-control"
                                              name="content_footer_en">{{ $data['detail']->content_footer_en }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Copyright</label>
                                    <textarea class="form-control"
                                              name="copyright_en">{{ $data['detail']->copyright_en }}</textarea>
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
                                <label>Title seo</label>
                                <input type="text" name="title_seo" value="{{ $data['detail']->title_seo }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Meta des</label>
                                <input type="text" name="meta_des" value="{{ $data['detail']->meta_des }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Meta key</label>
                                <input type="text" name="meta_key" value="{{ $data['detail']->meta_key }}"
                                       class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="row">--}}
            {{--                <div class="col-12 grid-margin stretch-card">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Tây ban nha</label>--}}
            {{--                            </div>--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Title seo</label>--}}
            {{--                                <input type="text" name="title_seo_es" value="{{ $data['detail']->title_seo_es }}"--}}
            {{--                                       class="form-control" placeholder=""/>--}}
            {{--                            </div>--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Meta des</label>--}}
            {{--                                <input type="text" name="meta_des_es" value="{{ $data['detail']->meta_des_es }}"--}}
            {{--                                       class="form-control" placeholder=""/>--}}
            {{--                            </div>--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Meta key</label>--}}
            {{--                                <input type="text" name="meta_key_es" value="{{ $data['detail']->meta_key_es }}"--}}
            {{--                                       class="form-control" placeholder=""/>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="row">--}}
            {{--                <div class="col-12 grid-margin stretch-card">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Bồ đào nha</label>--}}
            {{--                            </div>--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Title seo</label>--}}
            {{--                                <input type="text" name="title_seo_pt" value="{{ $data['detail']->title_seo_pt }}"--}}
            {{--                                       class="form-control" placeholder=""/>--}}
            {{--                            </div>--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Meta des</label>--}}
            {{--                                <input type="text" name="meta_des_pt" value="{{ $data['detail']->meta_des_pt }}"--}}
            {{--                                       class="form-control" placeholder=""/>--}}
            {{--                            </div>--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Meta key</label>--}}
            {{--                                <input type="text" name="meta_key_pt" value="{{ $data['detail']->meta_key_pt }}"--}}
            {{--                                       class="form-control" placeholder=""/>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="row tabHide" id="tab_en_seo" style="display: none;">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title seo</label>
                                <input type="text" name="title_seo_en" value="{{ $data['detail']->title_seo_en }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Meta des</label>
                                <input type="text" name="meta_des_en" value="{{ $data['detail']->meta_des_en }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Meta key</label>
                                <input type="text" name="meta_key_en" value="{{ $data['detail']->meta_key_en }}"
                                       class="form-control" placeholder=""/>
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
