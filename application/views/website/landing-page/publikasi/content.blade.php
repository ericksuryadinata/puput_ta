<div class="container">
    <h2 style="color:#2971d3">Publikasi Teknik Informatika</h2>
    <hr>
    <table id="dataTables" class="display" cellspacing="0" width="100%" border="0">
        <thead>
            <tr bgcolor="#5a89f3">
                <th width="3%"><font color="white">NO.</font></th>
                <th width="70%"><font color="white">Judul Publikasi</font></th>
                <th width="10%"><font color="white">Periode</font></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td style="text-align: left;">
                    <a href="http://informatika.untag-sby.ac.id/backend/uploads/pdf/Ahmad_Istighfarid1.pdf" target="_blank">
                        <b><font color="black" >EFEKTIFITAS VASRIASI PUTARAN DARI PROSES BALANCING TERHADAP PUTARAN KERJA POROS YANG SESUNGGUHNYA</font></b>
                    </a>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Djoko Sulistyono, Arief Budiman
                </td>
                <td>2017 Gasal</td>
            </tr>
        </tbody>
    </table>
</div>
@section('additional-scripts')
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTables').DataTable();
    });
</script>
@endsection