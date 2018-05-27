<div class="container">
    <div class="content-full-width" id="primary"> 
        <div class="dt-sc-two-third column first">                                                       
            <h2 class="hr-border-title"><span>Hubungi Kami</span></h2>
            <div id="ajax_contact_msg"></div>
            <form class="contactForm" action="" method="POST">
                <fieldset>
                    <label>Nama :</label>
                    <input type="text" name="nama" class="text">
                    <br>
                    <label>Email :</label>
                    <input type="text" name="email" class="text">
                    <br>
                    <label>Subjek :</label>
                    <input type="text" name="subjek" class="text">
                    <br>
                    <label>Pesan :</label>
                    <textarea name="pesan" class="textarea"> </textarea>
                    <br>
                    <div class="g-recaptcha" data-sitekey="{{getenv('GOOGLE_RECAPTCHA_SITE_KEY')}}"></div>
                    <button type="submit" class="submit btn-big">&nbsp;&nbsp;Kirim&nbsp;&nbsp;</button>
                </fieldset>
            </form>
        </div>
        <div class="dt-sc-one-third column">
            <h2 class="hr-border-title"><span>kontak</span></h2>
            <div class="contact-info">
                <div class="textwidget">
                    <p>Teknik Informatika
                    <br>Fakultas Teknik
                    <br>Universitas 17 Agustus 1945 Surabaya
                    <br>Jl. Semolowaru 45 Surabaya</p>
                </div>
                <p> <i class="fa fa-phone"> </i> <span>Phone</span> :  031-5921516 </p>
                <p> <i class="fa fa-print"> </i> <span>Fax</span> :  031-5921516 </p>
                <p> <i class="fa fa-envelope"> </i> <span>Email</span> : ft@untag-sby.ac.id </p>
            </div>
            <hr>
            <div id="peta"></div>
        </div>    
    </div>    
</div>

@section('additional-scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ getenv('GMAPS_API_KEY') }}"></script>
<script>
    function initialize() {
        var posisi = new google.maps.LatLng(-7.298784, 112.766861);
        var pengaturan = {
            zoom: 17,
            center: posisi
        }
        var map = new google.maps.Map(document.getElementById('peta'), pengaturan);
        var tanda = new google.maps.Marker({
            map: map,
            position: posisi,
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection
@section('additional-styles')
<script src='https://www.google.com/recaptcha/api.js'></script>
<style>
    h1{
        text-align: center;
    }
    #peta {
        height: 250px;
        width: 350px;
        
    }
</style>
@endsection