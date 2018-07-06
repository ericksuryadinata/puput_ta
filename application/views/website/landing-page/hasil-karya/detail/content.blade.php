<div class='with-right-sidebar' id='primary'> 
    <div class='column dt-sc-one-column blog-fullwidth with-sidebar'>
        <article class='blog-entry single format-image'>
            <a href='{{route('hasil-karya.detail',['slug' => $post->hasil_karya_slug])}}' class='title'>
                <h2>{{$post->hasil_karya_judul}}</h2>
            </a>
            <p>{{tgl_indo($post->created_at,'berita')}}</p>
            <p>Dibaca: <b>{{$post->hasil_karya_views}}</b> kali</p>
            <div class='section'>    
                <div class='addthis_toolbox addthis_default_style'>
                    <a class='addthis_button_preferred_1'></a>
                    <a class='addthis_button_preferred_2'></a>
                    <a class='addthis_button_preferred_3'></a>
                    <a class='addthis_button_preferred_4'></a>
                    <a class='addthis_button_compact'></a>
                    <a class='addthis_counter addthis_bubble_style'></a>
                </div>
                <script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f8aab4674f1896a'></script>
            </div>

            <div class='entry-body'>
                <div class='entry-details'>
                    <p>
                        <img src='{{base_url(image_path_for('hasil_karya','large').$post->hasil_karya_gambar)}}'>
                    </p>
                    <p>&nbsp;</p>
                    <div style="text-align: justify">
                        {!!$post->hasil_karya_isi!!}
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>