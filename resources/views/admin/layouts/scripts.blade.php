<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Repeater -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

<!-- Vendor js -->
<script src="{{ asset('/admin/js/vendor.min.js')}}"></script>


<!--Morris Chart-->
<script src="{{ asset('/admin/libs/morris-js/morris.min.js')}}"></script>
<script src="{{ asset('/admin/libs/raphael/raphael.min.js')}}"></script>

<!-- knob plugin -->
<script src="{{ asset('/admin/libs/jquery-knob/jquery.knob.min.js')}}"></script>

<!-- Form Repeater -->
<script src="{{ asset('/admin/js/pages/form-repeater.js')}}"></script>

@filemanagerScript
<!-- ckeditor script -->
<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
<script>
    var allEditors = document.querySelectorAll('.ckeditor');
    for (var i = 0; i < allEditors.length; ++i) {
      ClassicEditor.create(allEditors[i]);
    }
</script>

>
<script src="{{ asset('/admin/js/app.min.js')}}"></script>

<script src="{{ asset('/admin/js/script.js')}}"></script>
@stack('scripts')



<!-- Dashboard init js-->
{{-- <script src="{{ asset('/admin/js/pages/dashboard.init.js')}}"></script> --}}

<!-- App js --
