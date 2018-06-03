<div class="with-right-sidebar" id="primary"> 
    <div class="tpl-blog-holder">
            <h1 style="color:#2971d3">{{isset($kurikulum[0]->judul) ? ucfirst($kurikulum[0]->judul) : ''}}</h1>
            <br>
            {!!isset($kurikulum[0]->content) ? html_entity_decode($kurikulum[0]->content) : ''!!}
    </div>
</div>