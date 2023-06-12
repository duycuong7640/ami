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
                                <a href="{{ route('admin.mailtemplate.index') }}">
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
                                <label>Tiêu đề</label>
                                <input type="text" name="name" value="{{ $data['detail']->name }}" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Loại</label>
                                <select name="type" class="form-control col-md-3">
                                    <option value="0">Loại</option>
                                    <option value="1" <?php echo $data['detail']->type ==1?'selected="selected"':''; ?>>Đơn hàng</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Gửi về</label>
                                <input type="checkbox" class="form-check-input" name="send_to_admin" <?php echo $data['detail']->send_to_admin ==1?'checked="checked"':''; ?> value="1" style="padding-right: 10px;"/> <span style="display: inline-block;padding-left: 20px;">Admin</span>
                                <input type="checkbox" class="form-check-input" name="send_to_user" <?php echo $data['detail']->send_to_user ==1?'checked="checked"':''; ?> value="1" style="padding-right: 10px;"/> <span style="display: inline-block;padding-left: 20px;">User</span>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="tinymce" name="content">{{ $data['detail']->content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" value="1" {{ ($data['detail']->status == 1) ? 'checked' : '' }}>
                                                @lang('admins::layer.status.active')
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" value="0" {{ ($data['detail']->status == 0) ? 'checked' : '' }}>
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
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    @lang('admins::layer.button.submit')
                                </button>
                                <a href="{{ route('admin.advertisement.index') }}">
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
@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Account\EditRequest','#form-edit'); !!}
@endsection
