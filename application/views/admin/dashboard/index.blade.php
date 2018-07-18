@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-red">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">VISITOR</div>
                        <div class="number count-to" data-from="0" data-to="{{$total_visitor->total}}" data-speed="1000" data-fresh-interval="20">{{$total_visitor->total}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>LIST SLIDER</h2>
                        <br>
                        <a href="{{route('admin.settings.slider.create')}}" class="btn bg-indigo waves-effect">Tambah Data</a>
                        <a href="javascript:void(0)" class="btn bg-green waves-effect" id="refresh">Refresh</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="slider-list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Slider</th>
                                        <th>Gambar Slider</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Slider</th>
                                        <th>Gambar Slider</th>
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
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>SITE LOG</h2>
                        <br>
                        <a href="javascript:void(0)" class="btn bg-green waves-effect" id="refresh-log">Refresh</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="log-list">
                                <thead>
                                    <tr>
                                        <th>Log</th>
                                        <th>Tanggal Akses</th>
                                    </tr>
                                </thead>
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
    function initCounters() {
        $('.count-to').countTo();
    }
    let table, tableLog;
    $(document).ready(function () {
        let csrfName = $('[name=name_csrf]').val();
        let csrfToken = $('[name=token_csrf]').val();

        table = $('#slider-list').DataTable({
            serverSide: true,
            responsive:true,
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '{{route("admin.settings.slider.datatable")}}',
                type: 'GET',
                data:{[csrfName]:csrfToken}
            },
        });

        tableLog = $('#log-list').DataTable({
            serverSide: true,
            responsive:true,
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '{{route("admin.dashboard.log")}}',
                type: 'GET',
                data:{[csrfName]:csrfToken}
            },
            ordering:false,
            searching:false
        });

        $('#refresh').on('click', function (e) {
            e.preventDefault();
            table.ajax.reload(null,false);
        });

        $('#refresh-log').on('click', function (e) {
            e.preventDefault();
            tableLog.ajax.reload(null,false);
        });

        $('.js-basic-example').on('click','.hapus', function () {
            let id = $(this).data('id');
            let csrfName = $('[name=name_csrf]').val();
            let csrfToken = $('[name=token_csrf]').val();
            $.ajax({
                type: "POST",
                url: '{{route("admin.settings.slider.delete")}}',
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
                url: "{{route('admin.settings.slider.aktifkan')}}",
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
        initCounters();
    });
    </script>
@endsection