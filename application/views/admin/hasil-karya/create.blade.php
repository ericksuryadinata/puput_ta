@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin.hasil-karya.index')}}">Hasil Karya</a></li>
                <li><a class="active" href="#">Tambah</a></li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo form_open_multipart(route('admin.hasil-karya.save'),'id="form_validation" novalidate="novalidate"')?>
                        <div class="header">
                            <h2>TAMBAH HASIL KARYA</h2>
                        </div>
                        <div class="body">
                            <label for="email_address">Judul Hasil Karya</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="judul_hasil_karya" required="" aria-required="true">
                                </div>
                            </div>
                            <label for="email_address">Isi Hasil Karya</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="isi_hasil_karya" id="isi_hasil_karya"></textarea>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="email_address">Gambar Hasil Karya</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" id="gambar_hasil_karya" name="gambar_hasil_karya" required="" aria-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Preview <small>ukuran sebenarnya 900x675</small></label>
                                    <div>
                                        <img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="targetphoto" src="{{base_url(default_image_for('untag'))}}" alt="profilphoto" style="object-fit:contain">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-green waves-effect simpan" id="simpan">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('additional-styles')
    <link href="{{base_url('assets/admin/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />    
@endsection
@section('additional-scripts')
    <!-- TinyMCE -->
    <script src="{{base_url('assets/admin/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        
        //TinyMCE
        tinymce.init({
            selector: "textarea#isi_hasil_karya",
            theme: "modern",
            height: 300,
            plugins: [
                'advlist autolink lists link charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
            toolbar2: 'print preview | forecolor backcolor emoticons',
        });

        tinymce.suffix = ".min";
        tinyMCE.baseURL = "{{base_url('assets/admin/plugins/tinymce')}}";

        $('#form_validation').validate({
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            }
        });

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#targetphoto').attr('src', e.target.result);
                }

               reader.readAsDataURL(input.files[0]);
            }
        }

        $("#gambar_hasil_karya").on("change", function () {
            readURL(this);
        });
    </script>
    
@endsection