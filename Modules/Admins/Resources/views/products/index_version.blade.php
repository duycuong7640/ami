@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
                </div>
            </div>
        </div>
        @if(Session::has('success'))
            <p class="alert alert-success">{{Session::get('success')}}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert alert-danger">{{Session::get('error')}}</p>
        @endif
        <form method="post" action="">
            @csrf()
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 35px;"><input class="check-all" type="checkbox"/></th>
                                        <th width="50">@lang('admins::layer.table.stt')</th>
                                        <th width="60">Ảnh</th>
                                        <th>@lang('admins::layer.table.title')</th>
                                        <th>Danh mục</th>
                                        <th>Mã</th>
                                        {{--                                        <th>Giá bán</th>--}}
                                        {{--                                        <th>Số lượng</th>--}}
                                        <th>@lang('admins::layer.table.status')</th>
                                        <th>Hot</th>
                                        <th>Ads</th>
                                        <th>Hot 2</th>
                                        <th>Update version</th>
                                        <th>Index - EN</th>
                                        {{--                                        <th>Index - ES</th>--}}
                                        {{--                                        <th>Index - PT</th>--}}
                                        {{--                                        <th>Index - ID</th>--}}
                                        <th width="90">@lang('admins::layer.table.created')</th>
                                        <th width="90">@lang('admins::layer.table.modified')</th>
                                        <th width="50">@lang('admins::layer.table.id')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['list'] as $k=>$row)
                                        <tr>
                                            <td><input type="checkbox" name="check[]" value="{{$row->id}}"/></td>
                                            <td>{{ \Helpers::renderSTT($k + 1, $data['list']) }}</td>
                                            <td><img src="{{ asset($row->thumbnail) }}" class="mw-100"></td>
                                            <td>
                                                {{ $row->title }}
                                                <div class="clearfix mb-3"></div>
                                                <a class="icon-form" title="edit"
                                                   href="{{ route('admin.product.edit', ['id' => $row->id, 'page' => $data['list']->currentPage()]) }}">
                                                    <i class="icon-note"></i>
                                                </a>
                                                <a class="icon-form status active"
                                                   href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'status']) }}">
                                                    {!! (($row->status == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                                </a>
                                                <a class="icon-form"
                                                   href="javascript:confirmDelete('{{ route('admin.product.destroy', ['id' => $row->id]) }}','@lang('admins::layer.notify.confirm.delete')')">
                                                    <i class="icon-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{ $row->category_title }}</td>
                                            <td>{{ $row->code }}</td>
                                            {{--                                            <td>{{ \App\Helpers\Helpers::formatPrice($row->price) }}</td>--}}
                                            {{--                                            <td>{{ $row->quantity }}</td>--}}
                                            <td>{{ \Helpers::renderStatus($row->status) }}</td>
                                            <td>
                                                <a class="icon-form status active"
                                                   href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_1']) }}">
                                                    {!! (($row->choose_1 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                                </a>
                                            </td>
                                            <td>
                                                {{--                                                @if(!empty($row->google_ads))--}}
                                                <a class="icon-form status active"
                                                   href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_2']) }}">
                                                    {!! (($row->choose_2 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                                </a>
                                                {{--                                                @endif--}}
                                            </td>
                                            <td>
                                                <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_3']) }}">
                                                    {!! (($row->choose_3 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_5']) }}">
                                                    {!! (($row->choose_5 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_4']) }}">
                                                    {!! (($row->choose_4 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                                </a>
                                            </td>
                                            {{--                                            <td>--}}
                                            {{--                                                <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_6']) }}">--}}
                                            {{--                                                    {!! (($row->choose_6 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </td>--}}
                                            {{--                                            <td>--}}
                                            {{--                                                <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_7']) }}">--}}
                                            {{--                                                    {!! (($row->choose_7 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </td>--}}
                                            {{--                                            <td>--}}
                                            {{--                                                <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_8']) }}">--}}
                                            {{--                                                    {!! (($row->choose_8 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </td>--}}
                                            <td>{{ \Helpers::formatTime($row->created_at) }}</td>
                                            <td>{{ \Helpers::formatTime($row->updated_at) }}</td>
                                            <td>{{ $row->id }}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $data['list']->links('admins::elements.extend.pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
