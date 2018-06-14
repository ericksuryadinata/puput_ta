@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin.berita.post.index')}}">Berita</a></li>
                <li><a class="active" href="#">Tambah</a></li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo form_open_multipart(route('admin.berita.post.save'),'id="form_validation" novalidate="novalidate"')?>
                        <div class="header">
                            <h2>TAMBAH BERITA</h2>
                        </div>
                        <div class="body">
                            <label for="email_address">Judul Berita</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="judul_berita" required="" aria-required="true">
                                </div>
                            </div>
                            <label for="email_address">Isi Berita</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="isi_berita" id="isi_berita"></textarea>
                                </div>
                            </div>
                            <label for="email_address">Kategori</label>
                            <select class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                @foreach ($kategori as $key => $value)
                                    <option value="{{$value->id}}">{{$value->nama_kategori}}</option>
                                @endforeach
                            </select>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Preview <small>ukuran sebenarnya</small></label>
                                    <div>
                                        <img id="targetphoto" src="{{base_url(default_image_for('untag'))}}" alt="profilphoto" height="200" width="150" style="object-fit:contain">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="email_address">Gambar Berita</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" id="fotodosen" name="fotodosen" required="" aria-required="true">
                                        </div>
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
            selector: "textarea#isi_berita",
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