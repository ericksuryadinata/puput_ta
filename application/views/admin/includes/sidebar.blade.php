<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="user-info" style="height:50px;padding:5px 5px 5px 15px;">
            <div class="info-container" style="top:1px">
                <div class="name">{{$ctrl->surename}}</div>
                <div class="email">{{$ctrl->email}}</div>
            </div>
        </div>
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{isset($active_dashboard) ? $active_dashboard : ''}}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{isset($active_profil) ? $active_profil : ''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">perm_identity</i>
                        <span>Profil</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{isset($active_profil_sejarah) ? $active_profil_sejarah : ''}}">
                            <a href="{{route('admin.profil.sejarah')}}">Sejarah</a>
                        </li>
                        <li class="{{isset($active_profil_visi_misi) ? $active_profil_visi_misi : ''}}">
                            <a href="{{route('admin.profil.visi-misi')}}">Visi - Misi</a>
                        </li>
                        <li class="{{isset($active_profil_fasilitas) ? $active_profil_fasilitas : ''}}">
                            <a href="{{route('admin.profil.fasilitas')}}">Fasilitas</a>
                        </li>
                    </ul>
                </li>
                <li class="{{isset($active_akademik) ? $active_akademik : ''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">book</i>
                        <span>Akademik</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{isset($active_akademik_kurikulum) ? $active_akademik_kurikulum : ''}}">
                            <a href="{{route('admin.akademik.kurikulum')}}">Kurikulum</a>
                        </li>
                    </ul>
                </li>
                <li class="{{isset($active_berita) ? $active_berita : ''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">chrome_reader_mode</i>
                        <span>Berita</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{isset($active_berita_post) ? $active_berita_post : ''}}">
                            <a href="{{route('admin.berita.post.index')}}">Post Berita</a>
                        </li>
                        <li class="{{isset($active_berita_kategori) ? $active_berita_kategori : ''}}">
                            <a href="{{route('admin.berita.kategori.index')}}">Kategori Berita</a>
                        </li>
                    </ul>
                </li>
                <li class="{{isset($active_pengumuman) ? $active_pengumuman : ''}}">
                    <a href="{{route('admin.pengumuman.index')}}">
                        <i class="material-icons">info</i>
                        <span>Pengumuman</span>
                    </a>
                </li>
                <li class="{{isset($active_hasil_karya) ? $active_hasil_karya : ''}}">
                    <a href="{{route('admin.hasil-karya.index')}}">
                        <i class="material-icons">library_books</i>
                        <span>Hasil Karya</span>
                    </a>
                </li>
                <li class="{{isset($active_kerja_sama) ? $active_kerja_sama : ''}}">
                    <a href="{{route('admin.kerja-sama.index')}}">
                        <i class="material-icons">event_note</i>
                        <span>Kerja Sama</span>
                    </a>
                </li><li class="{{isset($active_publikasi) ? $active_publikasi : ''}}">
                    <a href="{{route('admin.publikasi.index')}}">
                        <i class="material-icons">collections_bookmark</i>
                        <span>Publikasi</span>
                    </a>
                </li>
                <li class="{{isset($active_dosen) ? $active_dosen : ''}}">
                    <a href="{{route('admin.dosen.index')}}">
                        <i class="material-icons">group</i>
                        <span>Daftar Dosen</span>
                    </a>
                </li>
                <li class="{{isset($active_inbox) ? $active_inbox : ''}}">
                    <a href="{{route('admin.inbox.index')}}">
                        <i class="material-icons">inbox</i>
                        <span>Inbox</span>
                    </a>
                </li>
                <li class="{{isset($active_settings) ? $active_settings : ''}}">
                    <a href="javascript:void(0)" class="menu-toggle">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{isset($active_settings_web) ? $active_settings_web : ''}}">
                            <a href="{{route('admin.settings.web.index')}}">Web</a>
                        </li>
                        <li class="{{isset($active_settings_link) ? $active_settings_link : ''}}">
                            <a href="{{route('admin.settings.link.index')}}">Link Partner</a>
                        </li>
                        <li class="{{isset($active_settings_slider) ? $active_settings_slider : ''}}">
                            <a href="{{route('admin.settings.slider.index')}}">Slider</a>
                        </li>
                        <li class="{{isset($active_settings_administrator) ? $active_settings_administrator : ''}}">
                            <a href="{{route('admin.settings.administrator.index')}}">Administrator</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 - 2017 <a href="#">Badan Sistem Informasi</a>.
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>