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
                                <a class="dt-sc-button small ocean"  href="{{route('akademik.kurikulum')}}" target="_blank">Kurikulum</a>
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
                                <a class="dt-sc-button small ocean" href="{{route('hasil-karya.index')}}" target="_blank">Hasil Karya</a>
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
                                @if (count($slider) != 0)
                                    @foreach ($slider as $key=>$value)
                                        <li class="rs-slide1" data-transition="random">
                                            <img src="{{base_url(image_path_for('slider').$value->slider_gambar)}}" alt="{{$value->slider_nama}}" data-bgrepeat="no-repeat" data-bgfit="contain" data-bgposition="center center">
                                        </li>
                                    @endforeach
                                @else
                                    <li class="rs-slide1" data-transition="random">
                                        <img src="{{base_url(default_image_for('untag'))}}" alt="bg1" data-bgrepeat="no-repeat" data-bgfit="contain" data-bgposition="center center">
                                    </li>
                                @endif
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
                            <li><a href="{{route('admin.auth.index')}}">Login</a></li>
                            <li><a href="{{route('berita.index')}}">Berita</a></li>
                            <li><a href="{{route('pengumuman.index')}}">Pengumuman</a></li>
                            <li><a href="{{route('kerja-sama.index')}}">Kerja Sama</a></li>
                            <li><a href="{{route('dosen.index')}}">Daftar Dosen</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
