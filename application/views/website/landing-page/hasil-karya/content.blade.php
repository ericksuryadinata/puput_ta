<div class='with-right-sidebar' id='primary'> 
    <h2>Hasil Karya</h2><hr>
    <div class='tpl-blog-holder apply-isotope'>
    @for ($i = 0; $i < 6; $i++)
        <div class='column dt-sc-one-column blog-thumb'>
            <article class='blog-entry format-link'>
                <div class='entry-thumb'>
                    <a href='#' title=''>
                        <img src='{{base_url('uploads/images/berita/default/untag.png')}}' alt='post-thumb2'/>
                    </a>
                </div>
                <div class='entry-details'>
                    <div class='entry-title'>
                        <h3> <a href='#' title=''>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</a></h3>
                    </div>
                    <div class='entry-body'>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Unde amet non qui ipsa ut! Et....</p>
                    </div>
                    <div class='entry-meta'>
                        <ul>
                            <li><i class='fa fa-clock-o'></i> Tgl :  27 Juni 2016</li>
                            <li><i class='fa fa-user'></i> Dibaca :  211 kali</li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
    @endfor
    </div>
</div>