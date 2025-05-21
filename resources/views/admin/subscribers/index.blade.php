
@extends('admin.layouts.app')
@push('name')
    {{ trans('admin.subscribers') }}
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">

            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>{{ trans('admin.email') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscribers as $subscriber)
                        <tr>
                            <td class="list-group-item">
                                <a href="mailto:{{ $subscriber->email}}" target="blank" style="color: #414141">{{ $subscriber->email }}</a>
                                <a href="/{{ app()->getLocale() }}/admin/subscribe/destroy/{{$subscriber->id}}" class="btn btn-danger" style="float: right">{{trans('admin.delete')}}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <!-- third party css -->
        <link href="{{ asset('/admin/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/admin/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/admin/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/admin/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
@endpush

@push('scripts')
    <!-- third party js -->
    <script src="{{ asset('/admin/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/pdfmake/vfs_fonts.js') }}"></script>
    <!-- third party js ends -->
    <!-- Datatables init -->
    <script src="{{ asset('/admin/js/pages/datatables.init.js') }}"></script>
@endpush