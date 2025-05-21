@extends('admin.layouts.app')

@push('name')
{{ trans('admin.submissions') }}
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            @if (isset($post))
            <h4>{{ $post->translate(app()->getLocale())->title }}</h4>
            @endif
            <div style="display: flex; align-items:center; justify-content: space-between; padding:20px 0">


                <div class="table-responsive">
                    <table class="table mb-0" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>{{ trans('admin.Full_name') }}</th>
                                <th>{{ trans('admin.email') }}</th>
                                <th>{{ trans('admin.date') }}</th>
                                <th>{{ trans('admin.section') }}</th>
                                <th>{{ trans('admin.more') }}</th>
                                <th>{{ trans('admin.delete') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($submissions as $key => $submission)
                                
                            <tr {{ $submission->seen == 0 ? 'style=background-color:#d3d3d35e' : ''  }}>
                                <th scope="row">{{ $key + 1 }}</th>
                                @if($submission->name != null)
                                <td>{{ $submission->name }}</td>
                                @endif
                                <td>{{ $submission->email }}</td>

                                {{-- <td>{{ $submission->text }}</td> --}}
                                {{-- {{ dd($submission->additional) }} --}}

                                <td>{{ $submission->created_at->format('d.m.Y') }} <br>
                                    {{ $submission->created_at->format('H:i') }}</td>
                                <td>{{ $submission->post->parent->translate(app()->getlocale())->title }}</td>
                                <td><a href="/{{ app()->getLocale() }}/admin/submission/{{ $submission->id }}"
                                        type="button"
                                        class="btn btn-info waves-effect width-md waves-light">{{ trans('admin.more') }}</a>
                                </td>
                                <td><a href="/{{ app()->getLocale() }}/admin/submission/destroy/{{ $submission->id }}"
                                        onclick="return confirm('&#1073;&#1107;&#1114;&#1073;&#1107;&#1106;&#1073;&#1107;&#1087;&#1111;&#1029;&#1073;&#1107;&#1087;&#1111;&#1029;&#1073;&#1107;&#1087;&#1111;&#1029;&#1073;&#1107;&#1087;&#1111;&#1029;&#1073;&#1107;&#1113;&#1073;&#1107;&#1106;&#1073;&#1107;&#1087;&#1111;&#1029; &#1073;&#1107;&#1087;&#1111;&#1029;&#1073;&#1107;&#1038;&#1073;&#1107;&#1032;&#1073;&#1107;&#1087;&#1111;&#1029;&#1073;&#1107;&#1087;&#1111;&#1029; &#1073;&#1107;&#1087;&#1111;&#1029;&#1073;&#1107;&#1106;&#1073;&#1107;&#1025;&#1073;&#1107;&#1113;&#1073;&#1107;&#1106;; ?');"
                                        type="button"
                                        class=" btn btn-danger waves-effect width-md waves-light">{{ trans('admin.delete') }}</a>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="paginations" style="margin-top: 30px">
                        {{ $submissions->links('admin.layouts.pagination') }}
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
@endsection
