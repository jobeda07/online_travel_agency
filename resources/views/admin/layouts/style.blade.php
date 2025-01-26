<link
rel="icon"
href="{{asset('admin/assets/img/kaiadmin/favicon.ico')}}"
type="image/x-icon"
/>

<!-- Fonts and icons -->
<script src="{{asset('admin/assets/js/plugin/webfont/webfont.min.js')}}"></script>
<script>
WebFont.load({
  google: { families: ["Public Sans:300,400,500,600,700"] },
  custom: {
    families: [
      "Font Awesome 5 Solid",
      "Font Awesome 5 Regular",
      "Font Awesome 5 Brands",
      "simple-line-icons",
    ],
    urls: ["{{asset('admin/assets/css/fonts.min.css')}}"],
  },
  active: function () {
    sessionStorage.fonts = true;
  },
});
</script>


<!-- CSS Files -->
<link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('admin/assets/css/plugins.min.css')}}" />
<link rel="stylesheet" href="{{asset('admin/assets/css/kaiadmin.min.css')}}" />


<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}" />
{{-- toastr --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
{{-- daterange --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- summernote -->
{{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs5.min.css">

@stack('style')

