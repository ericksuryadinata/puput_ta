<div class="partner-carousel-wrapper">
    <div class="container">                  
        <ul class="partner-carousel">
            <?php
                foreach($ctrl->partner_aktif as $key=>$value){
            ?>
                <li>
                    <a href="{{'http://'.$value->partner_link}}" target='_blank'>
                        <img src='{{base_url(upload_path('partner').$value->partner_gambar)}}'>
                    </a>
                </li>
            <?php
                }    
            ?>
        </ul>           
    </div>
</div>
<div class="dt-sc-hr-invisible-very-small"></div>
<div class="dt-sc-clear"></div>