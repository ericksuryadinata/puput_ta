<div id="secondary" class="right-sidebar">
    <aside class='widget widget_categories'>
        <h3 class='widgettitle'>Berita</h3>
        <ul>
            @if (count($ctrl->post_berita)!= 0)
                @foreach ($ctrl->post_berita as $key => $value)
                <li>
                    <a href='{{route('berita.detail',['slug' => $value->berita_slug])}}' title=''> {{ucwords(strtolower($value->berita_judul))}}</a>
                </li>
                @endforeach
            @else
                <p>Tidak ada berita terbaru</p>    
            @endif
        </ul>
    </aside>
    <aside class='widget widget_categories'>
        <h3 class='widgettitle'>Pengumuman</h3>
        <ul>
            @if (count($ctrl->pengumuman)!= 0)
                @foreach ($ctrl->pengumuman as $key => $value)
                <li>
                    <a href='{{route('pengumuman.detail',['slug' => $value->pengumuman_slug])}}' title=''> {{ucwords(strtolower($value->pengumuman_judul))}}</a>
                </li>
                @endforeach
            @else
                <p>Tidak ada pengumuman terbaru</p>    
            @endif
        </ul>
    </aside>
</div>