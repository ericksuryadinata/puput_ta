@section('additional-styles')
    <style>
        #ul-remove-margin{
            margin-bottom:10px;
        }
    </style>
@endsection
<div class="dt-sc-hr-invisible"></div>
<div class="fullwidth-section">
    <div class="fullwidth-bg">
        <div class="container">
            <div class="column dt-sc-one-fourth first" id="">
                <div class="dt-sc-toggle-set">
                    <div class="dt-sc-toggle-frame">
                        <h5 class="dt-sc-toggle-accordion active">
                            <a href="#">Pendaftaran Mahasiswa Baru</a>
                        </h5>
                        <div class="dt-sc-toggle-content">
                            <div class="block">
                                Alur dan Biaya Pendaftaran Mahasiswa Baru Teknik Informatika Untag Surabaya
                                <a class="dt-sc-button  small  ocean"  href="http://pmb.untag-sby.ac.id" target="_blank">PMB</a>
                            </div>
                        </div>
                    </div>
                    <div class="dt-sc-toggle-frame">
                        <h5 class="dt-sc-toggle-accordion">
                            <a href="#">Kurikulum Akademik</a>
                        </h5>
                        <div class="dt-sc-toggle-content">
                            <div class="block">
                                Mata Kuliah yang diajarkan di Teknik Informatika Untag Surabaya
                                <a class="dt-sc-button small ocean"  href="{{base_url('kurikulum')}}" target="_blank">Kurikulum</a>
                            </div>
                        </div>
                    </div>
                    <div class="dt-sc-toggle-frame">
                        <h5 class="dt-sc-toggle-accordion">
                            <a href="#">Hasil Karya</a>
                        </h5>
                        <div class="dt-sc-toggle-content">
                            <div class="block">
                                Hasil Karya Mahasiswa & Dosen Teknik Informatika Untag Surabaya
                                <a class="dt-sc-button small ocean" href="#" target="_blank">Hasil Karya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column dt-sc-one-half">
                <div id="slider">
                    <div id="rev_slider_24_1_wrapper" class="rev_slider_wrapper fullscreen-container" style="padding:0px;">
                        <div id="rev_slider_24_1" class="rev_slider fullscreenbanner" style="display:none;">
                            <ul>	
                                <li class="rs-slide1" data-transition="random">
                                    <img src="{{base_url('uploads/images/slider/IMG_9919.JPG')}}" alt="bg1" data-bgrepeat="no-repeat" data-bgfit="contain" data-bgposition="center center">
                                </li> 
                
                                <li class="rs-slide1" data-transition="random" >
                                    <img src="{{base_url('uploads/images/slider/sdf2.jpg')}}" alt="bg2" data-bgrepeat="no-repeat" data-bgfit="contain" data-bgposition="center center">
                                </li> 
                
                                <li class="rs-slide1" data-transition="random" >
                                    <img src="{{base_url('uploads/images/slider/robot.jpg')}}" alt="bg3" data-bgrepeat="no-repeat" data-bgfit="contain" data-bgposition="center center">
                                </li> 
                
                                <li class="rs-slide1" data-transition="random" >
                                    <img src="{{base_url('uploads/images/slider/ramadhan2_-_Copy.jpg')}}" alt="bg4" data-bgrepeat="no-repeat" data-bgfit="contain" data-bgposition="center center">
                                </li> 
                            </ul>
                
                            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                
                        </div>
                    </div>
                </div>                    
            </div>
            <div class="column dt-sc-one-fourth">
                <div class="dt-sc-titled-box ocean">
                    <h6 class="dt-sc-titled-box-title">Informasi</h6>
                    <div class="dt-sc-titled-box-content">
                        <ul class="dt-sc-fancy-list  electricblue  arrow" id="ul-remove-margin">
                            <li><a href="http://untag-sby.ac.id">Home Site</a></li>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Berita</a></li>
                            <li><a href="#">Pengumuman</a></li>
                            <li><a href="#">Kerja Sama</a></li>
                            <li><a href="#">Daftar Dosen</a></li>
                            <li><a href="#">Daftar Staff</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
