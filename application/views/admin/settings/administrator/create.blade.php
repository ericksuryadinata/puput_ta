@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin.settings.administrator.index')}}">Administrator</a></li>
                <li><a class="active" href="#">Tambah</a></li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo form_open_multipart(route('admin.settings.administrator.save'),'id="form_validation" novalidate="novalidate"')?>
                        <div class="header">
                            <h2>TAMBAH ADMINISTRATOR</h2>
                        </div>
                        <div class="body">
                            <label for="email_address">Firstname</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="firstname" required="" aria-required="true">
                                </div>
                            </div>
                            <label for="email_address">Lastname</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="lastname" required="" aria-required="true">
                                </div>
                            </div>
                            <label for="email_address">Username</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="username" required="" aria-required="true">
                                </div>
                            </div>
                            <label for="email_address">Email</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" required="" aria-required="true">
                                </div>
                            </div>
                            <label for="email_address">Password</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" required="" aria-required="true">
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