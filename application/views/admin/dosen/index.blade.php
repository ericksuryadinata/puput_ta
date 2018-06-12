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

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Dosen</h4>
            </div>
            <div class="modal-body">
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
    <script>
        function showNotif(text,method,condition){
            if(method === 'success'){
                colorName = 'alert-success';
            }else{
                colorName = 'alert-danger';
            }
            var allowDismiss = true;
            $.notify({
                message: text
            },
            {
                type: colorName,
                allow_dismiss: allowDismiss,
                newest_on_top: true,
                timer: 1000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                animate: {
                    enter: 'animated bounceInRight',
                    exit: 'animated bounceOutRight'
                },
                template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            });
        }
    </script>
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
    $(document).ready(function () {

        $('#dosen-list').DataTable({
            serverSide: true,
            responsive:true,
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '{{route("admin.dosen.datatable")}}',
                type: 'GET',
                data:{'<?php echo $csrf["name"]?>':'<?php echo $csrf["token"]?>'}
            },
        });

        $('.js-basic-example').on('click', '.detail',function () {
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{route('admin.dosen.detail')}}",
                data: {'id':id,'<?php echo $csrf["name"]?>':'<?php echo $csrf["token"]?>'},
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
                    $('#detailModal').modal('show');     
                }
            });
        });
    });
    </script>
@endsection