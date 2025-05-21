@extends('admin.layouts.app')

@push('name')
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h2 style="font-size: 20px; display:block; margin-bottom:20px"> {{ trans('admin.employes') }}</h2>
            {{-- <div class="fileuploaddiv">
                <button id="filuplbutt" class=" btn btn-success">{{trans('admin.refresh')}}</button>
                <div class="container" style="margin:20px 0;">
                    <br />
                    <h2 class="text-title" style="font-size: 16px">{{trans('admin.upload_attandance_file')}}</h2>
                    <form style="margin-top: 15px;padding: 10px;" action="/{{ app()->getLocale() }}/importExcelemploy"
                        class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" name="import_file" id="fileinput" />

                        <button disabled class="btn btn-primary " id="filebutton">{{trans('admin.upload')}}</button>
                    </form>
                </div>
            </div> --}}
            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                <thead>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <tr>
                        <th>#</th>
                        <th scope="col">სახელი გვარი </th>
                        <th scope="col">პირადი ნომერი</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th></th>
                        {{-- <th>Action</th> --}}
                        {{-- <th><input id="myInput" type="text" placeholder="მოძებნეთ ცხრილში..." style="float: right; border:2px solid #f3f3f3; padding:6px"></th> --}}
                    </tr>
                </thead>
                <tbody>
                    <span style="display: none">{{ $i= 1 }}</span>
                    @foreach ($employ as $item)
                    <tr>

                        <td>{{ $i++ }}</td>
                        <td>{{$item->name_surname}}</td>
                        <td>{{$item->id_number}}</td>
                        <td> 
                            <form action="/{{ app()->getLocale() }}/resetpassword/{{$item->id}}" method="POST">
                                @csrf
                                <input type="hidden" value="1" name="password">
                                <button type="submit"  onclick="return confirm('დარწმნებლი ხართ რომ გსურთ პაროლის განახლება ?');" style="border: none; background-color:transparent; color:#71b6f9" >პაროლის განახლება</button>
                            </form> 

                        </td>
                        <td> 
                            <form action="/{{ app()->getLocale() }}/giveadmin/{{$item->id}}" method="POST">
                                @csrf
                                <input type="hidden" value="2" name="type_id">
                                <button type="submit"  onclick="return confirm('დარწმნებლი ხართ რომ გსურთ ადმინისტრატორის როლის მინიჭება ?');" style="border: none; background-color:transparent; color:#71b6f9" >ადმინისტრატორის როლის მინიჭება</button>
                            </form> 

                        </td>
                        <td><a href="/{{ app()->getLocale()}}/employes/employ/{{$item->id_number}}">{{trans('admin.details')}}</a> </td>
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
<script>
const generatePassword = length => {
  document.querySelector("#password").innerHTML = createPassword(length);
}

const createPassword = length => {
  const lowercase = "abcdefghijklmnopqrstuvwxyz";
  const uppercase = lowercase.toUpperCase();
  const numbers = "0123456789";
  
  const [lower, upper, num] = [
    Math.ceil(length/3),
    Math.ceil(length/3),
    length - 2 * Math.ceil(length/3),
  ]
  
  const passwordCharacters = shuffle([
    ...getCharacters(lower, lowercase),
    ...getCharacters(upper, uppercase),
    ...getCharacters(num, numbers)
  ]);
  
  const password = passwordCharacters.join("");
  
  return password;
}

const getCharacters = (length, string) => {
  let characters = [];
  for(let i = 0; i < length; i++) {
    let random = Math.floor(Math.random() * string.length);
    characters[i] = string.charAt(random);
  }
  return characters;
}

const shuffle = array => {
  return array.sort(() => Math.random() - 0.5);
}
</script>

<script>
    setTimeout(function() {

// Do something after 3 seconds
// This can be direct code, or call to some other function

$('.alert').hide();

}, 4000);
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
    tr:hover {
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
        height: 50px;
        overflow: hidden;
        transition-duration: .3s;
        padding: 0 0 19px 0
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
