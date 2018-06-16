@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin.pengumuman.index')}}">Pengumuman</a></li>
                <li><a class="active" href="#">Edit</a></li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo form_open_multipart(route('admin.pengumuman.update'),'id="form_validation" novalidate="novalidate"')?>
                        <div class="header">
                            <h2>EDIT PENGUMUMAN</h2>
                        </div>
                        <div class="body">
                            <label for="email_address">Judul pengumuman</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input value="{{isset($pengumuman->pengumuman_judul) ? $pengumuman->pengumuman_judul : '' }}" type="text" class="form-control" name="judul_pengumuman" required="" aria-required="true">
                                </div>
                            </div>
                            <label for="email_address">Isi pengumuman</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="isi_pengumuman" id="isi_pengumuman">
                                        {{isset($pengumuman->pengumuman_isi) ? $pengumuman->pengumuman_isi : '' }}
                                    </textarea>
                                </div>
                            </div>
                            <?php
                                if(isset($pengumuman->pengumuman_gambar)){
                                    $foto = $pengumuman->pengumuman_gambar;
                                    if($foto !== ''){
                                        $placeholder = base_url().image_path_for('pengumuman','original').$foto;
                                    }else{
                                        $placeholder = base_url().default_image_for('untag');    
                                    }
                                }else{
                                    $foto = '';
                                    $placeholder = base_url().default_image_for('untag');
                                }

                            ?>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="email_address">Gambar pengumuman</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" id="gambar_pengumuman" name="gambar_pengumuman" required="" aria-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Preview <small>ukuran sebenarnya 900x675</small></label>
                                    <div>
                                        <img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="targetphoto" src="{{$placeholder}}" alt="profilphoto" style="object-fit:contain">
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="hidden" name="id" value="{{isset($pengumuman->id) ? $pengumuman->id : ''}}">
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
            selector: "textarea#isi_pengumuman",
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

        $("#gambar_pengumuman").on("change", function () {
            readURL(this);
        });
    </script>
    
@endsection