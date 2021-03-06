@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin.settings.link.index')}}">Link Partner</a></li>
                <li><a class="active" href="#">Tambah</a></li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo form_open_multipart(route('admin.settings.link.save'),'id="form_validation" novalidate="novalidate"')?>
                        <div class="header">
                            <h2>TAMBAH LINK PARTNER</h2>
                        </div>
                        <div class="body">
                            <label for="email_address">Nama Partner</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nama_partner" required="" aria-required="true">
                                </div>
                            </div>
                            <label for="email_address">Link Partner</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="link_partner" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <label>Preview <small>ukuran sebenarnya 190 x 55</small></label>
                                    <div>
                                        <img id="targetphoto" src="{{base_url(default_image_for('long-ads'))}}" alt="partnerphoto" height="55" width="190" style="object-fit:contain">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                    <label for="email_address">Gambar</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" id="partner_gambar" name="partner_gambar" required="" aria-required="true">
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

        $("#partner_gambar").on("change", function () {
            readURL(this);
        });
    </script>
    
@endsection