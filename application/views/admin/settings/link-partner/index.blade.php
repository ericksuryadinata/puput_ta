@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
        <ol class="breadcrumb breadcrumb-col-teal">
            <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li><a class="active" href="#">Link Partner</a></li>
        </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>LIST LINK PARTNER</h2>
                        <br>
                        <a href="{{route('admin.settings.link.create')}}" class="btn bg-indigo waves-effect">Tambah Data</a>
                        <a href="javascript:void(0)" class="btn bg-green waves-effect" id="refresh">Refresh</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="partner-list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Partner</th>
                                        <th>Link Partner</th>
                                        <th>Gambar Partner</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Partner</th>
                                        <th>Link Partner</th>
                                        <th>Gambar Partner</th>
                                        <th>Status</th>
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
    let table;
    $(document).ready(function () {
        let csrfName = $('[name=name_csrf]').val();
        let csrfToken = $('[name=token_csrf]').val();

        table = $('#partner-list').DataTable({
            serverSide: true,
            responsive:true,
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '{{route("admin.settings.link.datatable")}}',
                type: 'GET',
                data:{[csrfName]:csrfToken}
            },
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
                url: '{{route("admin.settings.link.delete")}}',
                data: {'id':id,[csrfName]:csrfToken},
                dataType: "JSON",
                success: function (response) {
                    if(response.message === 'success'){
                        $('[name=token_csrf]').val(response.csrf.token);
                        $('[name=name_csrf]').val(response.csrf.name);
                        $('#refresh').trigger('click');
                        showNotif(response.pesan,response.message);
                    }
                }
            });
        });

        $('.js-basic-example').on('click','.aktifkan',function () {
            let id = $(this).data('id');
            let action = $(this).data('action');
            let aktif;
            let csrfName = $('[name=name_csrf]').val();
            let csrfToken = $('[name=token_csrf]').val();
            if(action === 'aktif'){
                aktif = true;
            }else{
                aktif = false;
            }
            let csrf = {'id':id,'aktif':aktif,[csrfName]:csrfToken};
            $.ajax({
                type: "POST",
                url: "{{route('admin.settings.link.aktifkan')}}",
                data: csrf,
                dataType: "JSON",
                success: function (response) {
                    if(response.message === 'success'){
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