
@if (isset($languages))
<div class="tab-content">
    <ul class="nav nav-tabs">
    
        @foreach ( $languages as $k => $lang)
        <li class="nav-item ">
            <a href="#locale-{{ $k }}" data-toggle="tab" aria-expanded="false" class="nav-link @if($k == app()->getLocale()) active @endif">
                <span class="d-none d-sm-block">{{ trans('admin.locale_'.$k) }}</span>            
            </a>
        </li>
        @endforeach
            
    </ul>
    <div class="tab-content">
        @foreach ($languages as $k => $lang)
        
            <div role="tabpanel" class="tab-pane fade @if($k == app()->getLocale()) active show @endif " id="locale-{{ $k }}">
                @foreach ($lang as $key => $value)
                    <div class="form-group">
            
                        {{ Form::label($key, null, ['class' => 'control-label']) }}
                        
                        {{ Form::text($k.'['.$key.']',  $value ?? null, array_merge(['class' => 'form-control'])) }}
                    
                        
                    </div> 
                @endforeach
                

            </div>
            
        @endforeach
    </div> 

    
    
</div> 

@endif
            
                
                

<div class="form-group text-right mb-0">
    <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
        {{ trans('admin.save') }}
    </button>
</div>
                