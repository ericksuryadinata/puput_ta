<script type="text/javascript" src="{{base_url('assets/website/js/modernizr-2.6.2.min.js')}}"></script> 
    
<script type="text/javascript">
var mytheme_urls = {
     scroll : 'disable'
};
</script>

<script type="text/javascript" src="{{base_url('assets/website/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/jquery-migrate-1.2.1.min.js')}}"></script>

<script type="text/javascript" src="{{base_url('assets/website/js/pace.min.js')}}"></script>    

<script type="text/javascript" src="{{base_url('assets/website/js/jquery.sticky.js')}}"></script>    
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.dlmenu.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/inview.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.tabs.min.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.tipTip.minified.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.donutchart.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.ui.totop.min.js')}}"></script>    
<script type="text/javascript" src="{{base_url('assets/website/js/twitter/jquery.tweet.min.js')}}"></script>

<script type="text/javascript" src="{{base_url('assets/website/js/jquery-easing-1.3.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.isotope.min.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.prettyPhoto.js')}}"></script>

<script type="text/javascript" src="{{base_url('assets/website/js/jquery.carouFredSel-6.2.0-packed.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.fitvids.js')}}"></script>        
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.bxslider.js')}}"></script>

<script type="text/javascript" src="{{base_url('assets/website/js/jquery.animateNumber.min.js')}}"></script>    
<script type="text/javascript" src="{{base_url('assets/website/js/jquery.parallax-1.1.3.js')}}"></script>    

<script type="text/javascript" src="{{base_url('assets/website/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/custom.js')}}"></script>     

<script type="text/javascript" src="{{base_url('assets/website/js/revslider/jquery.themepunch.tools.min.js')}}"></script>
<script type="text/javascript" src="{{base_url('assets/website/js/revslider/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#staff').DataTable();
});
</script>
<script type="text/javascript">

    /******************************************
        -	PREPARE PLACEHOLDER FOR SLIDER	-
    ******************************************/
    

    var setREVStartSize = function() {
        var	tpopt = new Object();
        tpopt.startwidth = 600;
        tpopt.startheight = 300;
        tpopt.container = jQuery('#rev_slider_24_1');
        tpopt.fullScreen = "off";
        tpopt.forceFullWidth="off";

        tpopt.container.closest(".rev_slider_wrapper").css(
            {height:tpopt.container.height()}
        );
        tpopt.width=parseInt(tpopt.container.width(),0);
        tpopt.height=parseInt(tpopt.container.height(),0);
        tpopt.bw=tpopt.width/tpopt.startwidth;
        tpopt.bh=tpopt.height/tpopt.startheight;
        if(tpopt.bh>tpopt.bw)
        tpopt.bh=tpopt.bw;
        if(tpopt.bh<tpopt.bw)
        tpopt.bw=tpopt.bh;
        if(tpopt.bw<tpopt.bh)
        tpopt.bh=tpopt.bw;
        if(tpopt.bh>1){
            tpopt.bw=1;
            tpopt.bh=1
        }
        if(tpopt.bw>1){
            tpopt.bw=1;
            tpopt.bh=1
        }
        tpopt.height=Math.round(tpopt.startheight*(tpopt.width/tpopt.startwidth));
        if(tpopt.height>tpopt.startheight&&tpopt.autoHeight!="on")
        tpopt.height=tpopt.startheight;
        if(tpopt.fullScreen=="on"){
            tpopt.height=tpopt.bw*tpopt.startheight;
            var cow=tpopt.container.parent().width();
            var coh=jQuery(window).height();
            if(tpopt.fullScreenOffsetContainer!=undefined){
                try{
                    var offcontainers=tpopt.fullScreenOffsetContainer.split(",");
                    jQuery.each(offcontainers,function(e,t){
                        coh=coh-jQuery(t).outerHeight(true);
                        if(coh<tpopt.minFullScreenHeight)
                        coh=tpopt.minFullScreenHeight
                    })
                }catch(e){

                }
            }
            tpopt.container.parent().height(coh);
            tpopt.container.height(coh);
            tpopt.container.closest(".rev_slider_wrapper").height(coh);
            tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(coh);
            tpopt.container.css({height:"100%"});
            tpopt.height=coh;
        }else{
            tpopt.container.height(tpopt.height);
            tpopt.container.closest(".rev_slider_wrapper").height(tpopt.height);
            tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(tpopt.height);
        }
    };

    /* CALL PLACEHOLDER */
    setREVStartSize();

    var tpj=jQuery;
    tpj.noConflict();
    var revapi24;

    tpj(document).ready(function() {

        if(tpj('#rev_slider_24_1').revolution == undefined)
            revslider_showDoubleJqueryError('#rev_slider_24_1');
        else
            revapi24 = tpj('#rev_slider_24_1').show().revolution({
                dottedOverlay:"none",
                delay:9000,
                startwidth:600,
                startheight:300,
                hideThumbs:200,

                thumbWidth:100,
                thumbHeight:50,
                thumbAmount:3,

                navigationType:"none",
                navigationArrows:"solo",
                navigationStyle:"round",

                touchenabled:"on",
                onHoverStop:"off",

                swipe_velocity: 0.7,
                swipe_min_touches: 1,
                swipe_max_touches: 1,
                drag_block_vertical: false,
                
                keyboardNavigation:"off",

                navigationHAlign:"center",
                navigationVAlign:"bottom",
                navigationHOffset:0,
                navigationVOffset:20,

                soloArrowLeftHalign:"left",
                soloArrowLeftValign:"center",
                soloArrowLeftHOffset:20,
                soloArrowLeftVOffset:0,

                soloArrowRightHalign:"right",
                soloArrowRightValign:"center",
                soloArrowRightHOffset:20,
                soloArrowRightVOffset:0,

                shadow:0,
                fullWidth:"off",
                fullScreen:"off",

                spinner:"spinner0",

                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,
                shuffle:"off",
                
                forceFullWidth:"off",
                fullScreenAlignForce:"on",
                minFullScreenHeight:"",
                hideTimerBar:"on",
                hideThumbsOnMobile:"off",
                hideNavDelayOnMobile:1500,
                hideBulletsOnMobile:"off",
                hideArrowsOnMobile:"off",
                hideThumbsUnderResolution:0,

                fullScreenOffsetContainer: "",
                fullScreenOffset: "",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                startWithSlide:0
            });
            
    });	/*ready*/

</script>

<script type="text/javascript">
    
    jQuery(window).load(function() {
        
        //PAGE SLIDER...
        if(jQuery('.right-slide').length) {
            jQuery('.right-slide').each(function(){
                var $this = jQuery(this).find('.page-slider');
                $this.carouFredSel({
                    responsive: true,
                    auto: false,
                    width: '100%',
                    height: 'auto',
                    scroll: {
                        fx: "uncover-fade",
                        duration: 800
                    },
                    items: { width: $this.find("li").width(),  visible: { min: 1, max: 1 } },
                    pagination: {
                        container: ".right-slide-nav-links",
                        anchorBuilder: false
                    }
                });
            });		
        }	
        
    });

</script>