@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
        <ol class="breadcrumb breadcrumb-col-teal">
            <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li><a class="active" href="#">Dosen</a></li>
        </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>LIST DOSEN</h2>
                        <br>
                        <a href="{{route('admin.dosen.create')}}" class="btn bg-indigo waves-effect">Tambah Data</a>
                        <a href="javascript:void(0)" class="btn bg-green waves-effect" id="refresh">Refresh</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dosen-list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIDN</th>
                                        <th>Nama</th>
                                        <th>Posisi</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>NIDN</th>
                                        <th>Nama</th>
                                        <th>Posisi</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="text" hidden name="token_csrf" value="<?php echo $csrf["token"]?>">
<input type="text" hidden name="name_csrf" value="<?php echo $csrf["name"]?>">

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Dosen</h4>
            </div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#cv" data-toggle="tab">Curriculum Vitae</a></li>
                    <li role="presentation"><a href="#education" data-toggle="tab">Education Background</a></li>
                    <li role="presentation"><a href="#teaching" data-toggle="tab">Teaching Experience</a></li>
                    <li role="presentation"><a href="#publications" data-toggle="tab">Publications</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="cv">
                        <div class="media">
                            <div class="media-left">
                                <a href="javascript:void(0);">
                                    <img id="foto_dosen" class="media-object" src="http://placehold.it/64x64" width="150" height="200">
                                </a>
                            </div>
                            <div class="media-body">
                                <label for="nidn">Nomor Induk Dosen</label>
                                <p class="lead" id="nidn"></p>
                                <label for="nama">Nama Dosen</label>
                                <p class="lead" id="nama"></p>
                                <label for="posisi">Posisi</label>
                                <p class="lead" id="posisi"></p>
                                <label for="alamat">Alamat</label>
                                <p class="lead" id="alamat"></p>
                                <label for="telepon">Telepon</label>
                                <p class="lead" id="telepon"></p>
                                <label for="fax">Fax</label>
                                <p class="lead" id="fax"></p>
                                <label for="email">Email</label>
                                <p class="lead" id="email"></p>
                                <label for="laman_web">Laman Web</label>
                                <p class="lead" id="laman_web"></p>
                                <label for="aktifitas">Aktifitas</label>
                                <p class="lead" id="aktifitas"></p>
                                <label for="peminatan">Minat Penelitian</label>
                                <p class="lead" id="peminatan"></p>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="education">
                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="teaching">
                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="publications">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
@stop
@section('additional-scripts')
    <!-- Bootstrap Notify Plugin Js -->
    <script src="{{base_url('assets/admin/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>
    <script src="{{base_url('assets/admin/js/custom-admin.js')}}"></script>
    <?php
        if(isset($_SESSION['message'])){
            if($_SESSION['message'] === 'success'){
                if($_SESSION['method'] === 'save'){
                    echo "<script>showNotif('".$_SESSION['pesan']."','success')</script>";
                }else{
                    echo "<script>showNotif('".$_SESSION['pesan']."','success')</script>";
                }
            }else{
                if($_SESSION['method'] === 'save'){
                    echo "<script>showNotif('".$_SESSION['pesan']."','error')</script>";
                }else{
                    echo "<script>showNotif('".$_SESSION['pesan']."','error')</script>";
                }
            }
        }
    ?>
    <script>
    let base_url = '<?php echo base_url()?>';
    let default_image = '<?php echo default_image_for("man")?>';
    let table;
    $(document).ready(function () {
        let csrfName = $('[name=name_csrf]').val();
        let csrfToken = $('[name=token_csrf]').val();

        table = $('#dosen-list').DataTable({
            serverSide: true,
            responsive:true,
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '{{route("admin.dosen.datatable")}}',
                type: 'GET',
                data:{[csrfName]:csrfToken}
            },
        });

        $('.js-basic-example').on('click', '.detail',function () {
            let id = $(this).data('id');
            let csrfName = $('[name=name_csrf]').val();
            let csrfToken = $('[name=token_csrf]').val();
            $.ajax({
                type: "GET",
                url: "{{route('admin.dosen.detail')}}",
                data: {'id':id,[csrfName]:csrfToken},
                dataType: "JSON",
                success: function (response) {
                    let data = response[0];
                    $("#nidn").text(data.nidn);
                    $("#nama").text(data.nama);
                    $("#posisi").text(data.posisi);
                    $("#alamat").text(data.alamat);
                    $("#telepon").text(data.telepon);
                    $("#fax").text(data.fax);
                    $("#email").text(data.email);
                    if(data.nama_foto === ''){
                        $('#foto_dosen').attr('src',base_url+'uploads/images/placeholder/avatar.png');
                    }else{
                        $('#foto_dosen').attr('src',base_url+'uploads/images/dosen/'+data.nama_foto);
                    }
                    $("#laman_web").text(data.laman_web);
                    $("#aktifitas").html(data.aktifitas);
                    $("#peminatan").html(data.peminatan);
                    $("#education").html(data.latar_belakang_pendidikan);
                    $("#teaching").html(data.pengalaman_mengajar);
                    $("#publications").html(data.publikasi);
                    $('#detailModal').modal('show');     
                }
            });
        });

        $('#refresh').on('click', function (e) {
            e.preventDefault();
            table.ajax.reload(null,false);
        });

        $('.js-basic-example').on('click','.hapus', function () {
            let id = $(this).data('id');
            let csrfName = $('[name=name_csrf]').val();
            let csrfToken = $('[name=token_csrf]').val();
            $.ajax({
                type: "POST",
                url: '{{route("admin.dosen.delete")}}',
                data: {'id':id,[csrfName]:csrfToken},
                dataType: "JSON",
                success: function (response) {
                    if(response.message === 'success'){
                        $('[name=token_csrf]').val(response.csrf.token);
                        $('[name=name_csrf]').val(response.csrf.name);
                        $('#refresh').trigger('click');
                        showNotif(response.pesan,response.message);
                    }else{
                        $('[name=token_csrf]').val(response.csrf.token);
                        $('[name=name_csrf]').val(response.csrf.name);
                        $('#refresh').trigger('click');
                        showNotif(response.pesan,response.message);
                    }
                }
            });
        });
    });
    </script>
@endsection