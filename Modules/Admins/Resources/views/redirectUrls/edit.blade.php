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
                                <a href="{{ route('admin.redirect.index') }}">
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
                            <div id="tab_en" class="tabHide">
                                <div class="form-group">
                                    <label>From</label>
                                    <div style="overflow: hidden;">
                                        <div style="width: 140px; float: left; font-size: 13px; margin-top: 10px;">{{ (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" }}</div>
                                        <div style="margin-left: 140px;">
                                            <input type="text" name="url" class="form-control" value="{{ $data['detail']->url }}" placeholder=""/>
                                            <p style="padding: 8px 0 0 0; font-size: 13px;">Bắt buộc: /game-xxx</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>To</label>
{{--                                    <div style="overflow: hidden;">--}}
{{--                                        <div style="width: 140px; float: left; font-size: 13px; margin-top: 10px;">{{ (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" }}</div>--}}
{{--                                        <div style="margin-left: 140px;"><input type="text" name="url_to" class="form-control" value="{{ $data['detail']->url_to }}" placeholder=""/></div>--}}
{{--                                    </div>--}}
                                    <input type="text" name="url_to" class="form-control" value="{{ $data['detail']->url_to }}" placeholder=""/>
                                    <p style="padding: 8px 0 0 0; font-size: 13px;">/game-xxx hoặc https://www.google.com/</p>
                                </div>
                                <div class="form-group">
                                    <label>Loại redirect</label>
                                    <select name="type" class="form-control col-md-3">
                                        @foreach($type_redirect as $row)
                                            <option @if($data['detail']->type == $row) selected
                                                    @endif value="{{ $row }}">{{ $row }}</option>
                                        @endforeach
                                    </select>
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
                                <a href="{{ route('admin.redirect.index') }}">
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
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\RedirectUrl\EditRequest','#form-edit'); !!}
@endsection
