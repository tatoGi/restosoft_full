@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif
<div class="form-group">
    <label data-icon="-">{{ trans('admin.'.$key) }}</label> <br>
    <input type="file" name="thumb" value="" accept="image/jpeg,image/png,image/gif">

    @if(isset($post) && isset($post->thumb) && !empty($post->thumb))
    <div class="col-md-8 dfie d-flex">
        <img src="{{ image($post->thumb) }}" alt="img" style="width: 25%">
        <span class="delete-file" data-id="{{$post->id}}"
            data-route="{{ route('post.delete-image', ['post' => $post->id]) }}"
            data-delete="{{$post->thumb}}">X</span>
    </div>
    @endif
</div>

@if(isset($post->thumb))
    <input type="hidden" name="old_thumb" value="{{ $post->thumb }}">
@endif

@push('scripts')
<script>
    $(document).ready(function() {
        // Delete file
        $('.delete-file').click(function(e) {
            e.preventDefault();
            var postId = $(this).data('id');
            var route = $(this).data('route');

            if (confirm('Are you sure you want to delete the image?')) {
                $.ajax({
                    url: route,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        field: 'thumb'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Remove image from DOM
                            $('.delete-file[data-id=' + postId + ']').closest('.dfie').remove();
                            // Clear the hidden input if it exists
                            $('input[name="old_thumb"]').val('');
                            location.reload(); // Reload the page to ensure everything is updated
                        } else {
                            alert(response.message || 'Error deleting image. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert('Error deleting image. Please try again.');
                    }
                });
            }
        });

        // File size validation
        $('input[name="thumb"]').change(function() {
            var fileSize = this.files[0].size;
            var maxSize = 2097152; // Maximum size is 2MB
            var fileType = this.files[0].type;
            var allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (fileSize > maxSize) {
                alert('File size is greater than 2MB.');
                $(this).val('');
                return;
            }

            if (!allowedTypes.includes(fileType)) {
                alert('Invalid file type. Only JPG, PNG and GIF are allowed.');
                $(this).val('');
                return;
            }
        });
    });
</script>
@endpush

<style>
.dfie {
    margin-top: 10px;
    position: relative;
    align-items: center;
}

.delete-file {
    position: absolute;
    right: 10px;
    top: 10px;
    background: #dc3545;
    color: white;
    width: 20px;
    height: 20px;
    text-align: center;
    line-height: 20px;
    border-radius: 50%;
    cursor: pointer;
}

.delete-file:hover {
    background: #c82333;
}

.alt-text {
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
    margin-top: 5px;
}
</style>
