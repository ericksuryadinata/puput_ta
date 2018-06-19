@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin.settings.slider.index')}}">Slider</a></li>
                <li><a class="active" href="#">Tambah</a></li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo form_open_multipart(route('admin.settings.slider.save'),'id="form_validation" novalidate="novalidate"')?>
                        <div class="header">
                            <h2>TAMBAH SLIDER</h2>
                        </div>
                        <div class="body">
                            <label for="email_address">Nama Slider</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nama_slider" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="email_address">Gambar Slider</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" id="slider_gambar" name="slider_gambar" required="" aria-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Preview <small>ukuran sebenarnya 900x675</small></label>
                                    <div>
                                        <img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="targetphoto" src="{{base_url(default_image_for('camera'))}}" alt="profilphoto" style="object-fit:contain">
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

@section('additional-scripts')
    <script>
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

        $("#slider_gambar").on("change", function () {
            readURL(this);
        });
    </script>
    
@endsection