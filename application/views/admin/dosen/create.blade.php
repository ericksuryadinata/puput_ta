@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin.dosen.index')}}">Dosen</a></li>
                <li><a class="active" href="#">Tambah</a></li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo form_open_multipart(route('admin.dosen.save'),'id="form_validation" novalidate="novalidate"')?>
                        <div class="header">
                            <h2>TAMBAH DOSEN</h2>
                        </div>
                        <div class="body">
                            <label>Nomor Induk Dosen</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nidn" required="" aria-required="true">
                                </div>
                            </div>
                            <label>Nama Dosen</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nama_dosen" required="" aria-required="true">
                                </div>
                            </div>
                            <label>Posisi</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="posisi" required="" aria-required="true">
                                </div>
                            </div>
                            <label>Alamat</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="alamat" required="" aria-required="true">
                                </div>
                            </div>
                            <label>Telepon</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="telepon" required="" aria-required="true">
                                </div>
                            </div>
                            <label>Fax</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="fax">
                                </div>
                            </div>
                            <label>Email</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <label>Preview <small>ukuran sebenarnya</small></label>
                                    <div>
                                        <img id="targetphoto" src="{{base_url(default_image_for('man'))}}" alt="profilphoto" height="200" width="150" style="object-fit:contain">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                    <label>Foto</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" id="fotodosen" name="fotodosen" required="" aria-required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label>Laman Web</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="laman_web">
                                </div>
                            </div>
                            <label>Aktifitas Sekarang</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="aktifitas" id="aktifitas"></textarea>
                                </div>
                            </div>
                            <label>Minat Penelitian</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="minat_penelitian" id="minat_penelitian"></textarea>
                                </div>
                            </div>
                            <label>Latar Belakang Pendidikan</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="latar_belakang_pendidikan" id="latar_belakang_pendidikan"></textarea>
                                </div>
                            </div>
                            <label>Pengalaman Mengajar</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="pengalaman_mengajar" id="pengalaman_mengajar"></textarea>
                                </div>
                            </div>
                            <label>Publikasi</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="publikasi" id="publikasi"></textarea>
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

@section('additional-scripts')
    <!-- TinyMCE -->
    <script src="{{base_url('assets/admin/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        
        //TinyMCE
        tinymce.init({
            selector: "textarea#aktifitas",
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
        
        tinymce.init({
            selector: "textarea#minat_penelitian",
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

        tinymce.init({
            selector: "textarea#latar_belakang_pendidikan",
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

        tinymce.init({
            selector: "textarea#pengalaman_mengajar",
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

        tinymce.init({
            selector: "textarea#publikasi",
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

        $("#fotodosen").on("change", function () {
            readURL(this);
        });
    </script>
    
@endsection