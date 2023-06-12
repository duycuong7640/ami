@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th width="50">@lang('admins::layer.table.stt')</th>
                                    <th>Tên</th>
                                    <th>Nội dung</th>
                                    <th>@lang('admins::layer.table.status')</th>
                                    <th width="50">@lang('admins::layer.table.created')</th>
                                    <th width="50">@lang('admins::layer.table.modified')</th>
                                    <th width="50">@lang('admins::layer.table.id')</th>
                                    <th width="110"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['list'] as $k=>$row)
                                    <tr>
                                        <td>{{ \Helpers::renderSTT($k + 1, $data['list']) }}</td>
                                        <td>{{ $row->name  }}</td>
                                        <td>{{ $row->content  }}</td>
                                        <td>{{ \Helpers::renderStatus($row->status) }}</td>
                                        <td>{{ \Helpers::formatDate($row->created_at) }}</td>
                                        <td>{{ \Helpers::formatDate($row->updated_at) }}</td>
                                        <td>{{ $row->id }}</td>
                                        <td>
                                            <a class="icon-form status active" href="{{ route('admin.comment.status', ['id' => $row->id, 'field' => 'status']) }}">
                                                {!! (($row->status == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                            </a>
                                            <a class="icon-form" href="javascript:confirmDelete('{{ route('admin.comment.destroy', ['id' => $row->id]) }}','@lang('admins::layer.notify.confirm.delete')')">
                                                <i class="icon-trash"></i>
                                            </a>
                                        </td>
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
    </div>
@endsection
