@extends('admin.layouts.app')
@push('name')
{{ trans('admin.employes') }}
@endpush
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <a href="{{ url()->previous() }}" class="btn btn-primary" style="display: block; width:fit-content; margin-bottom:20px; color: #435966;">{{ trans('admin.back') }}</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>თანამშრომლები</th>
                                <th scope="col">პირადი ნომერი: </th>
                                <th scope="col">სახელი გვარი: </th>
                                <th scope="col">თარიღი: </th>
                                <th scope="col"> განყოფილება: </th>
                                <th scope="col"> ქვედანაყოფი: </th>   
                                <th>   პოზიცია : </th> 
                                <th>  ნომერი  : </th> 
                                <th>  მეილი  : </th> 
                                <th> ანაზ.შვებულება   : </th> 
                                <th>  არაანაზღ.შვებ  : </th> 
                                <th>  დეიოფი  : </th> 
                                <th>  გამოყენებული ანაზღაურებადი შვებულება ოჯახური პირობის გამო  : </th> 
                                <th>  ბიულეტინი  : </th> 
                                <th>   მომხმარებლის სახელი : </th> 
                                <th>   პაროლი : </th> 
                            </tr>
                        </thead>
                        <tbody>
                            <span style="display: none">{{ $i= 1 }}</span>
                            @foreach ($items as $item)
                            <tr class="active-row"> 
                                <td>{{ $i++ }}</td>
                                <td>{{$item->id_number}}</td>
                                <td>{{$item->name_surname}}</td>
                                <td>{{ $item['date'] }}</td>
                                <td>{{$item->section}}</td>
                                <td>{{$item->sub_section}}</td>
                                <td>{{$item->position}}</td>
                                <td>{{$item->mobile}}</td> 
                                <td>{{$item->email}}</td>
                                <td>{{$item->paid_vacation}}</td>
                                <td>{{$item->unpaid_vacation}}</td>
                                <td>{{$item->day_off}}</td>
                                <td>{{$item->family_circumstances}}</td>
                                <td>{{$item->bulletin}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->password}}</td>
                            </tr>  
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
<script src="/authorize/vendor/jquery/jquery-3.2.1.min.js"></script>
<script>
    $('#fileinput').blur(function () {
        if (!$(this).val()) {
            document.getElementById("filebutton").disabled = false;
        }
    });
    $('#filuplbutt').click(function () {
        $(".fileuploaddiv").toggleClass('opened');

    });
</script>
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

<style>
    tr:hover{
        background-color: #ebeff2
    }
    #wrapper {
        overflow: initial !important;
    }
    .navbar-custom {
        top: 0
    }
    .notification-list .noti-icon {
        display: none
    }
    input:focus-visible {
        border: none
    }
    .fileuploaddiv {
        height: 72px;
        overflow: hidden;
        transition-duration: .3s;
        padding: 19px 0
    } 
    .opened {
        height: 100%;
    } 
    #filuplbutt {
        float: right
    } 
    .hidden {
        display: none
    } 
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
     .styled-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    } 
    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    } 
    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    } 
    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    } 
    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    } 
    .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    } 
</style>