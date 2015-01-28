<div id="lightbox-wrapper">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">


                <div id="map-lightbox">
                    <div id="map-lightbox-text">
                     
                        <p class="map-lightbox-title hneue-bold"><?php echo get_post_meta(get_the_ID(), 'lightbox_title',true); ?> </p>
                        <?php the_content(); ?>
                    </div>
                    <a href="#" id="map-lightbox-close" class="glyphicon glyphicon-remove">
                        <div class=""></div>
                    </a >

                </div>
           </div>
        </div>
    </div>
</div>