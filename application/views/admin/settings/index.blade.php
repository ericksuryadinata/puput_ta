@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <ol class="breadcrumb breadcrumb-col-teal">
        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li><a class="active" href="#">Settings</a></li>
      </ol>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <?php echo form_open(route('admin.settings.save'),'id="form_validation" novalidate="novalidate"')?>
                    <div class="header">
                        <h2>WEBSITE SETTINGS</h2>
                        <br>
                        <button type="submit" class="btn bg-green waves-effect simpan hidden" id="simpan">SIMPAN</button>
                        <button type="button" class="btn bg-indigo waves-effect" data-id="edit" id="edit">EDIT</button>
                    </div>
                    <div class="body">
                        <label for="email_address">Nama Universitas</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input disabled type="text" class="form-control" name="nama_universitas" required="" aria-required="true" value="{{isset($settings) ? $settings['nama_universitas'] : ''}}">
                            </div>
                        </div>
                        <label for="email_address">Nama Fakultas</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input disabled type="text" class="form-control" name="nama_fakultas" required="" aria-required="true" value="{{isset($settings) ? $settings['nama_fakultas'] : ''}}">
                            </div>
                        </div>
                        <label for="email_address">Nama Jurusan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input disabled type="text" class="form-control" name="nama_jurusan" required="" aria-required="true" value="{{isset($settings) ? $settings['nama_jurusan'] : ''}}">
                            </div>
                        </div>
                        <label for="email_address">Alamat Universitas</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input disabled type="text" class="form-control" name="alamat_universitas" required="" aria-required="true" value="{{isset($settings) ? $settings['alamat_universitas'] : ''}}">
                            </div>
                        </div>
                        <label for="email_address">Telepon</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input disabled type="text" class="form-control" name="telepon" required="" aria-required="true" value="{{isset($settings) ? $settings['telepon'] : ''}}">
                            </div>
                        </div>
                        <label for="email_address">Fax</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input disabled type="text" class="form-control" name="fax" required="" aria-required="true" value="{{isset($settings) ? $settings['fax'] : ''}}">
                            </div>
                        </div>
                        <label for="email_address">Email</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input disabled type="text" class="form-control" name="email" required="" aria-required="true" value="{{isset($settings) ? $settings['email'] : ''}}">
                            </div>
                        </div>
                        <label for="email_address">Lokasi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <div class="gmap" id="map"></div>
                            </div>
                        </div>
                        <input disabled type="text" class="form-control hidden" name="lat_long" value="{{isset($settings) ? $settings['lokasi'] : ''}}">
                        <button type="submit" class="btn bg-green waves-effect simpan hidden" id="simpan">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</section>
@stop
@section('additional-styles')
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo getenv('GMAPS_API_KEY')?>"></script>
@endsection
@section('additional-scripts')
    <script>
        let lokasiTambah;
        let database = '<?php echo isset($settings) ? $settings['lokasi'] : ''?>';
        if(database === ''){
            lokasiTambah = {lat: -7.298784, lng: 112.766861};
        }else{
            let databaseSplit = database.split(' ');
            lokasiTambah = new google.maps.LatLng(parseFloat(databaseSplit[0]), parseFloat(databaseSplit[1]));
        }

        let mapTambah = new google.maps.Map(document.getElementById('map'), {
            zoom: 18,
            center: lokasiTambah,
            draggableCursor: 'default',
            draggingCursor: 'pointer',
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        let marker = new google.maps.Marker({
            position : lokasiTambah,
            map : mapTambah,
            title : 'Universitas 17 Agustus 1945 Surabaya'
        });

        google.maps.event.addListener(mapTambah,'click', function(event){
            let locationClicked = event.latLng;
            let markerTambah = new google.maps.Marker({
                position : locationClicked,
                map : mapTambah
            });
            $("[name='lat_long']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
        })

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

        $('#edit').on('click', function () {
            let data = $(this).data('id');
            if(data === 'edit'){
                $(".simpan").removeClass('hidden');
                $("[name=nama_universitas]").attr('disabled',false);
                $("[name=nama_fakultas]").attr('disabled',false);
                $("[name=nama_jurusan]").attr('disabled',false);
                $("[name=alamat_universitas]").attr('disabled',false);
                $("[name=telepon]").attr('disabled',false);
                $("[name=fax]").attr('disabled',false);
                $("[name=email]").attr('disabled',false);
                $("[name=lat_long]").attr('disabled',false);
                $(this).data('id','cancel')
                $(this).text('CANCEL');
            }else{
                $(".simpan").addClass('hidden');
                $("[name=nama_universitas]").attr('disabled',true);
                $("[name=nama_fakultas]").attr('disabled',true);
                $("[name=nama_jurusan]").attr('disabled',true);
                $("[name=alamat_universitas]").attr('disabled',true);
                $("[name=telepon]").attr('disabled',true);
                $("[name=fax]").attr('disabled',true);
                $("[name=email]").attr('disabled',true);
                $("[name=lat_long]").attr('disabled',true);
                $(this).data('id','edit')
                $(this).text('EDIT');
            }
        });

        $(".simpan").on('click', function () {
            if($('#edit').data('id') == 'cancel'){

            }else{
                $(".simpan").addClass('hidden');
            }
        });
    </script>
@endsection