<div class='with-right-sidebar' id='primary'> 
    <h2>Kerja Sama</h2><hr>
    @if (count($post) != 0)
        <div class='tpl-blog-holder apply-isotope'>
            @foreach ($post as $key => $post)
                <div class='column dt-sc-one-column blog-thumb'>
                    <article class='blog-entry format-link'>                
                        <div class='entry-thumb'>
                            <a href='{{route('kerja-sama.detail',['slug' => $post->kerja_sama_slug])}}' title=''>
                                <img src='{{base_url(image_path_for("kerja_sama","medium").$post->kerja_sama_gambar)}}' />
                            </a>
                        </div>
                        <div class='entry-details'>                        
                            <div class='entry-title'>
                                <h3><a href='{{route('kerja-sama.detail',['slug' => $post->kerja_sama_slug])}}' title=''>{!!ucwords(strtolower($post->kerja_sama_judul))!!}</a></h3>
                            </div>
                            <div class='entry-body'>
                                <p>{!!word_limiter($post->kerja_sama_isi,10)!!}</p>
                            </div>
                            <div class='entry-meta'>
                                <ul>
                                    <li><i class='fa fa-clock-o'></i> tgl :  {{tgl_indo($post->created_at)}}</li>
                                    <li><i class='fa fa-user'></i> Dibaca : {{$post->kerja_sama_views}} kali</li>
                                </ul>
                            </div>                                        
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
        @if (isset($page))
            {!!$page!!}
        @endif
    @else
        <div class="call-out type4">
            <h2>Tidak Ada Kerja Sama Baru</h2>
        </div>
    @endif
</div>