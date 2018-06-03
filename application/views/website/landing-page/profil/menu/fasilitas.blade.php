<div class="with-right-sidebar" id="primary"> 
    <div class="tpl-blog-holder">
        <h1 style="color:#2971d3">{{isset($fasilitas[0]->section) ? ucfirst($fasilitas[0]->section) : ''}}</h1>
        <br>
        {!!isset($fasilitas[0]->content) ? html_entity_decode($fasilitas[0]->content) : ''!!}
    </div>
</div>