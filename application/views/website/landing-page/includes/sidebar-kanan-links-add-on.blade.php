<aside class="widget widget_categories">
    <h3 class="widgettitle">links</h3>
    <?php
        foreach($ctrl->partner_aktif as $key=>$value){
    ?>
        <a href="{{'http://'.$value->partner_link}}" target='_blank'>
            <img src='{{base_url(upload_path('partner').$value->partner_gambar)}}'>
        </a>
        <br>
        <br>
    <?php
        }    
    ?>
</aside>