<div id="header-wrapper">
    <header id="header" class="header5">
        <div class="container">
            <div id="logo">
                <a href="index.html"> <img src="{{base_url('assets/website/images/logo.png')}}" alt="logo"> </a>
            </div>
            <div id="primary-menu">
                <div class="dt-menu-toggle" id="dt-menu-toggle">Menu<span class="dt-menu-toggle-icon"></span></div>
                <nav id="main-menu">
                    <ul id="menu-main-menu" class="menu">
                        <li class="menu-item menu-item-simple-parent menu-item-depth-0"><a href="{{route('home.index')}}">Home</a></li>
                        <li class="menu-item menu-item-simple-parent menu-item-depth-0">
                            <a href="#">Profil</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('profil.sejarah')}}">Sejarah</a></li>
                                <li><a href="{{route('profil.visi-misi')}}">Visi Misi</a></li>
                                <li><a href="{{route('profil.fasilitas')}}">Fasilitas</a></li>
                            </ul>
                            <a class="dt-menu-expand">+</a>
                        </li>
                        <li class="menu-item menu-item-simple-parent menu-item-depth-0">
                            <a href="#">Akademik</a>
                            <ul class="sub-menu">
                                <li><a href="http://pmb.untag-sby.ac.id" target="_blank">PMB</a></li>
                                <li><a href="{{route('akademik.kurikulum')}}">Kurikulum</a></li>
                                <li><a href="http://alumni.ft.untag-sby.ac.id/beranda" target="_blank">Alumni</a></li>
                            </ul>
                            <a class="dt-menu-expand">+</a>
                        </li>
                        <li class="menu-item menu-item-simple-parent menu-item-depth-0"><a href="{{route('home.hubungi-kami')}}">Kontak</a></li>
                        <li class="menu-item menu-item-simple-parent menu-item-depth-0"><a href="{{route('publikasi.index')}}">Publikasi</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</div> 