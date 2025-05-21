@extends('admin.layouts.app')

@push('name')
    {{ trans('admin.dashboard') }}
@endpush



@section('content')
<div class="row">
    {{-- <div class="col-xl-12">
        <div class="card-box">
            

            <h4 class="header-title mt-0 mb-3">{{ trans('admin.latest_drafts') }}</h4>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('admin.title') }}</th>
                        
                        @if (count(config('app.locales')) > 1)
                        <th>{{ trans('admin.locale') }}</th>
                        @endif
                        <th>{{ trans('admin.drafted_by') }}</th>
                        <th>{{ trans('admin.date') }}</th>
                        <th>{{ trans('admin.edit') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($postDrafts as $key => $draft) 
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $draft->title }}</td>
                                @if (count(config('app.locales')) > 1)
                                    
                                <td>{{ trans('admin.locale_'.$draft->locale) }}</td>
                                @endif
                                <td>{{ $draft->post->author->name }}</td>
                                <td>{{ $draft->updated_at->format('H:i d.m.Y') }}</td>
                                <td><a href="/{{ app()->getLocale() }}/admin/submissions?post_id={{ $draft->post->id }}" type="button" class="btn btn-info waves-effect width-md waves-light">{{ trans('admin.edit') }}</a></td>
                                     
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- end col --> --}}
</div>
<div class="row">
    @if (auth()->user()->isType('admin'))
    <div class="col-xl-12">
        <div class="card-box">
            
            <h4 class="header-title mb-">{{ trans('admin.latest_submissions') }}</h4>

            <div class="inbox-widget">
                
                @foreach ($submissions as $key => $submission)
                <div class="inbox-item">
                    <a href="/{{ app()->getLocale() }}/admin/submission/{{ $submission->id }}">
                        <h5 class="inbox-item-author mt-0 mb-1">{{ $submission->email }} <br> <small>{{ $submission->additional['letter'] ? $submission->additional['letter'] :"" }}</small></h5>
                        <p class="inbox-item-date">{{ $submission->created_at->format('H:i') }} {{ $submission->created_at->format('d.m.Y') }}</p>
                    </a>
                </div>
                @endforeach
                
               <style>
                   .inbox-item:hover{
                       background-color: #ebeff2
                   }
                   .inbox-item>a{
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        width: 100%;
                   }
                   .inbox-item>a p{
                       margin-bottom: 0;
                       position: initial !important;
                       margin-right: 10px
                   }
                    .inbox-item>a h5{height: fit-content;
                        margin: 0;
                        margin-left: 10px;
                   }
               </style>

            </div>
        </div>
    </div>
    @endif

   

</div>
<!-- end row -->  
@endsection