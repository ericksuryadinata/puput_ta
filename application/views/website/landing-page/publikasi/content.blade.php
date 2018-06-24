<div class="container">
    <h2 style="color:#2971d3">Publikasi Teknik Informatika</h2>
    <hr>
    <table id="publikasi" class="display" cellspacing="0" width="100%" border="0">
        <thead>
            <tr bgcolor="#5a89f3">
                <th width="3%"><font color="white">NO.</font></th>
                <th width="70%"><font color="white">Judul Publikasi</font></th>
                <th width="10%"><font color="white">Periode</font></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@section('additional-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <style>
        .forceLeft{
            text-align: left;
        }
    </style>
@endsection
@section('additional-scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#publikasi').DataTable({
                serverSide: true,
                responsive:true,
                order: [],
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                ajax: {
                    url: '{{route("publikasi.datatables")}}',
                    type: 'GET',
                    data:{'<?php echo $csrf["name"]?>':'<?php echo $csrf["token"]?>'}
                },
                columnDefs:[
                    {
                        className:"forceLeft",targets:[1]
                    }
                ],
            });

        });
    </script>
@endsection