<div class='with-right-sidebar' id='primary'> 
    <h2>Staff Site Teknik Informatika</h2><hr>
    <table id="dataTables" class="display" cellspacing="0" width="100%">
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
        @for ($i = 0; $i < 59; $i++)
            <tr>
                <td>{{($i+1)}}</td>
                <td>Some person name</td>
                <td>Some person job</td>
                <td>example@email.com</td>
                <td>
                    <a href="#" title=""><img src="{{base_url('assets/website/images/ico-search.png')}}"></a>
                </td>
            </tr>
        @endfor
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
@section('additional-scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable();
        });
    </script>
@endsection