<div class="with-right-sidebar" id="primary"> 
    <div class="tpl-blog-holder">
        <h1 style="color:#2971d3">
            <?php
                $visimisi = explode('-',$visi_misi[0]->section);
                $visimisi = implode(' ',$visimisi);
                echo ucwords($visimisi);
            ?>
        </h1>
        <br>
        {!!isset($visi_misi[0]->content) ? html_entity_decode($visi_misi[0]->content) : ''!!}
</div>
</div>