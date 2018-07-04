@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
        <ol class="breadcrumb breadcrumb-col-teal">
            <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li><a class="active" href="#">Inbox</a></li>
        </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>LIST INBOX</h2>
                        <br>
                        <a href="javascript:void(0)" class="btn bg-green waves-effect" id="refresh">Refresh</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="inbox-list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengirim</th>
                                        <th>Email</th>
                                        <th>Subjek</th>
                                        <th>Pesan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengirim</th>
                                        <th>Email</th>
                                        <th>Subjek</th>
                                        <th>Pesan</th>
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

<div class="modal fade" id="bacaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pesan</h4>
            </div>
            <div class="modal-body">
                <div class="header">
                    <h2 id="subjek">Pesan Pertama</h2>
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <p id="from"><b>Erick Surya </b>< ericksurya@email.com></p>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <p id="tgl_kirim" class="align-right">11:01 AM</p>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="align-justify"><p id="pesan">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit nobis corrupti atque fuga a cumque earum! Mollitia placeat dignissimos dicta nemo voluptate obcaecati ipsa amet. Facere eligendi natus laboriosam impedit?</p></div>
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

        function updateMessage(id){
            let csrfName = $('[name=name_csrf]').val();
            let csrfToken = $('[name=token_csrf]').val();
            $.ajax({
                type: "POST",
                url: "{{route('admin.inbox.afterRead')}}",
                data: {'id' : id,[csrfName]:csrfToken},
                dataType: "JSON",
                success: function (response) {
                    if(response.status === 'success'){
                        $('[name=token_csrf]').val(response.csrf.token);
                        $('[name=name_csrf]').val(response.csrf.name);
                        $('#refresh').trigger('click');
                    }else{
                        $('[name=token_csrf]').val(response.csrf.token);
                        $('[name=name_csrf]').val(response.csrf.name);
                        $('#refresh').trigger('click');
                    }
                }
            });
        }
    let table;
    $(document).ready(function () {
        let csrfName = $('[name=name_csrf]').val();
        let csrfToken = $('[name=token_csrf]').val();

        table = $('#inbox-list').DataTable({
            serverSide: true,
            responsive:true,
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            ajax: {
                url: '{{route("admin.inbox.datatable")}}',
                type: 'GET',
                data:{[csrfName]:csrfToken}
            },
        });

        $('#refresh').on('click', function (e) {
            e.preventDefault();
            table.ajax.reload(null,false);
        });

        $('.js-basic-example').on('click','.baca', function () {
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: '{{route("admin.inbox.read")}}',
                data: {'id':id},
                dataType: "JSON",
                success: function (response) {
                    let data = response[0];
                    $("#subjek").text(data.inbox_subjek);
                    $("#from").html("<b>"+data.inbox_nama+"</b>&lt;"+data.inbox_email+"&gt;");
                    let tanggal = data.created_at.substr(11);
                    tanggal = tanggal.substr(0,5);
                    $("#tgl_kirim").text(tanggal);
                    $("#pesan").text(data.inbox_pesan);
                    $('#bacaModal').modal('show');
                    updateMessage(data.id);
                }
            });
        });
    });
    </script>
@endsection