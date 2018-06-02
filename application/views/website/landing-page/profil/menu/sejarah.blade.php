<div class="with-right-sidebar" id="primary"> 
    <div class="tpl-blog-holder">
        <h1 style="color:#2971d3">{{isset($sejarah[0]->section) ? ucfirst($sejarah[0]->section) : ''}}</h1>
        <br>
        {!!isset($sejarah[0]->content) ? html_entity_decode($sejarah[0]->content) : ''!!}
    </div>
</div>