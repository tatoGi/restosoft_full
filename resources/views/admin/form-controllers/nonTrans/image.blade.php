@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif
<div class="form-group">
    
    <label data-icon="-">{{ trans('admin.'.$key) }}</label> <br>
    <input type="file" name="thumb" value="" >
    
    @if(isset($banner->thumb) && ($banner->thumb != ''))
    <div class="col-md-8 dfie d-flex">
    <img src="{{ image($banner->thumb) }}" alt="img" style="width: 25%">
   
    <span class="delete-file" data-id="{{$banner->id}}" data-token="{{ csrf_token() }}"  data-route="/{{ app()->getLocale() }}/banners/{{ $banner->id }}/delete-image" delete="{{$banner->thumb}}" >X</span>
 
    </div>
    @endif
 
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Delete file
        $('.delete-file').click(function(e) {
            e.preventDefault();
            var bannerId = $(this).data('id');
            var token = $(this).data('token');
            var route = $(this).data('route');
            if (confirm('Are you sure you want to delete the image?')) {
            $.ajax({
                url: route,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: token,
                    banner_id: bannerId
                },
                success: function(data) {
                    // Remove image from DOM
                    $('.delete-file[data-id=' + bannerId + ']').closest('.dfie').remove();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    });
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name="thumb"]').change(function() {
            var fileSize = this.files[0].size;
            var maxSize = 2097152; // Maximum size is 2MB
    
            if (fileSize > maxSize) {
                alert('File size is greater than 2MB.');
                $('input[name="thumb"]').val('');
            }
        });
    });
    </script>
    
@endpush
<style>
.alt-text{
    display: block;
    width: 100%;
    height: calc(1.5em + 0.9rem + 2px);
    padding: 0.45rem 0.9rem;
    font-size: .9rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6c757d;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.2rem;
}
</style>