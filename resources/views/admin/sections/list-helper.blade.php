  
<ol class="dd-list">
  @foreach ($sections as $section)
  <li class="dd-item @if (count($section->children) > 0 ) acordion @endif" data-id="{{ $section->id }}">
      <div class="dd-handle">
          {{ $section[app()->getlocale()]->title }}
      </div>
      <div class="change-icons">
        @if ($section->type['type'] != 1  )
          <a href="/{{ app()->getLocale() }}/admin/section/{{ $section->id }}/posts/" class="far fa-eye"></a>
          @endif
          @if (auth()->user()->isType('admin'))
  
          <a href="/{{ app()->getLocale() }}/admin/sections/edit/{{ $section->id }}" class="fas fa-pencil-alt"></a>
         
         
          <a href="/{{ app()->getLocale() }}/admin/sections/destroy/{{ $section->id }}" onclick="return confirm('დარწმნებლი ხართ რომ გსურთ სექციის წაშლა ?');" class="fas fa-trash-alt"></a>
        
         @endif
          {{-- @if (count($section->children) > 0 ) <span class="button_je mdi mdi-chevron-down arrow"></span> @endif --}}
      </div>
      @if (count($section->children) > 0 )
      @include('admin.sections.list-helper', ['sections' => $section->children])
      @endif
  </li>
  @endforeach
</ol>
