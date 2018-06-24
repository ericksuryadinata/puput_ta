@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin.publikasi.index')}}">publikasi</a></li>
                <li><a class="active" href="#">Tambah</a></li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo form_open_multipart(route('admin.publikasi.save'),'id="form_validation" novalidate="novalidate"')?>
                        <div class="header">
                            <h2>TAMBAH PUBLIKASI</h2>
                        </div>
                        <div class="body">
                            <label>Judul publikasi</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="judul_publikasi" required="" aria-required="true">
                                </div>
                            </div>
                            <label>Penulis</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="penulis_publikasi" required="" aria-required="true">
                                </div>
                            </div>
                            <label>Semester</label>
                            <div class="form-group">
                                <select class="form-control show-tick" name="semester_publikasi" required="" aria-required="true" >
                                    <option value="">-- Pilih --</option>
                                    <option value="1">Gasal</option>
                                    <option value="2">Genap</option>
                                </select>
                            </div>
                            <label>Tahun</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tahun_publikasi" required="" aria-required="true">
                                </div>
                            </div>
                            <label>File</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" class="form-control" name="file_publikasi" required="" aria-required="true">
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
    </script>
    
@endsection