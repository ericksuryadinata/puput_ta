<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="user-info" style="height:50px;padding:5px 5px 5px 15px;">
            <div class="info-container" style="top:1px">
                <div class="name">John Doe</div>
                <div class="email">john.doe@example.com</div>                
            </div>
        </div>
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">perm_identity</i>
                        <span>Profil</span>
                    </a>
                    <ul class="ml-menu" style="display: none;">
                        <li>
                            <a href="{{route('admin.profil.sejarah')}}" class=" waves-effect waves-block">Sejarah</a>
                        </li>
                        <li>
                            <a href="{{route('admin.profil.visi-misi')}}" class=" waves-effect waves-block">Visi - Misi</a>
                        </li>
                        <li>
                            <a href="{{route('admin.profil.fasilitas')}}" class=" waves-effect waves-block">Fasilitas</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">book</i>
                        <span>Akademik</span>
                    </a>
                    <ul class="ml-menu" style="display: none;">
                        <li>
                            <a href="{{route('admin.akademik.kurikulum')}}" class=" waves-effect waves-block">Kurikulum</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.berita.index')}}">
                        <i class="material-icons">chrome_reader_mode</i>
                        <span>Berita</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.pengumuman.index')}}">
                        <i class="material-icons">info</i>
                        <span>Pengumuman</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.hasil-karya.index')}}">
                        <i class="material-icons">library_books</i>
                        <span>Hasil Karya</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.kerja-sama.index')}}">
                        <i class="material-icons">event_note</i>
                        <span>Kerja Sama</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.dosen.index')}}">
                        <i class="material-icons">group</i>
                        <span>Daftar Dosen</span>
                    </a>
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