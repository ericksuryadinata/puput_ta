<div class='with-right-sidebar' id='primary'>
    <h2>Staff Site Teknik Informatika</h2><hr>
    <table id="dosen-list" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NO.</th>
                <th>Staff Name</th>
                <th>Positions</th>
                <th>Email</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Staff Name</th>
                <th>Posisition</th>
                <th>Email</th>
                <th>Detail</th>
            </tr>
        </tfoot>
    </table>
</div>
@section('additional-styles')
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
@section('additional-scripts')
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dosen-list').DataTable({
                serverSide: true,
                responsive:true,
                order: [],
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                ajax: {
                    url: '{{route("dosen.datatables")}}',
                    type: 'GET',
                    data:{'<?php echo $csrf["name"]?>':'<?php echo $csrf["token"]?>'}
                },
            });

        });
    </script>
@endsection