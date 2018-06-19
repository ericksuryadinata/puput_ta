<div class="fullwidth-section">
    <div class="container">
        <h2 class="hr-border-title center"><span>Berita Terbaru</span></h2>
        <div class="content-full-width" id="primary"> 
            @if (count($post) != 0)
                {{-- <div class="tpl-blog-holder apply-isotope"> --}}
                    @foreach ($post as $key => $post)
                        @if ($key == 0)
                            <div class='column dt-sc-one-fourth first'>
                                <article class='blog-entry format-image'>                
                                    <div class='entry-thumb'>
                                        <a href='{{route('berita.detail',['slug' => $post->berita_slug])}}' title=''>
                                            <img src='{{base_url(image_path_for("berita","thumb").$post->berita_gambar)}}' />
                                        </a>
                                    </div>
                                    <div class='entry-details'>                        
                                        <div class='entry-title'>
                                            <h3><a href='{{route('berita.detail',['slug' => $post->berita_slug])}}' title=''>{!!ucwords(strtolower($post->berita_judul))!!}</a></h3>
                                        </div>
                                        <div class='entry-body'>
                                            <p>{!!word_limiter($post->berita_isi,10)!!}</p>
                                        </div>
                                        <div class='entry-meta'>
                                            <ul>
                                                <li><i class='fa fa-clock-o'></i> tgl :  {{tgl_indo($post->created_at)}}</li>
                                                <li><i class='fa fa-user'></i> Dibaca : {{$post->berita_views}} kali</li>
                                            </ul>
                                        </div>                                        
                                    </div>
                                </article>
                            </div>
                        @else
                            <div class='column dt-sc-one-fourth'>
                                <article class='blog-entry format-image'>                
                                    <div class='entry-thumb'>
                                        <a href='{{route('berita.detail',['slug' => $post->berita_slug])}}' title=''>
                                            <img src='{{base_url(image_path_for("berita","thumb").$post->berita_gambar)}}' />
                                        </a>
                                    </div>
                                    <div class='entry-details'>                        
                                        <div class='entry-title'>
                                            <h3><a href='{{route('berita.detail',['slug' => $post->berita_slug])}}' title=''>{!!ucwords(strtolower($post->berita_judul))!!}</a></h3>
                                        </div>
                                        <div class='entry-body'>
                                            <p>{!!word_limiter($post->berita_isi,10)!!}</p>
                                        </div>
                                        <div class='entry-meta'>
                                            <ul>
                                                <li><i class='fa fa-clock-o'></i> tgl :  {{tgl_indo($post->created_at)}}</li>
                                                <li><i class='fa fa-user'></i> Dibaca : {{$post->berita_views}} kali</li>
                                            </ul>
                                        </div>                                        
                                    </div>
                                </article>
                            </div>
                        @endif
                    @endforeach
                {{-- </div> --}}
                <div class="aligncenter call-out">
                    <a class="dt-sc-button medium" href="{{route('berita.index')}}" target="_blank">Semua Berita</a>
                </div>
                <div class="dt-sc-hr-invisible"></div>
            @else
                <div class="call-out type4">
                    <h2>Tidak Ada Berita Baru</h2>
                </div>
            @endif
        </div>
    </div>

</div>