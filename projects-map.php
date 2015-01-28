<div id="map-wrapper">

   
    <?php if(is_page("projects") || is_page("projets")){ get_template_part( "projects", "lightbox" ); } ?>
    <div id="map-filter-overlay">
        <div class="container">
            <div class="row-fluid map-filter-list">
                   
                    <div id="countries-filters"></div>
                    <div id="regions-filters"></div>
                    <div id="sectors-filters" class="ipad-newrow"></div>
                    <div id="budgets-filters"></div>

            </div>
        </div>
        <div id="map-filters-buttons">
            <div class="container">
                <div class="row-fluid">
                    <div class="span9">

                        <button id="map-filter-save" class="hneue-bold"><?php echo get_post_meta( get_the_ID(), 'projects-save', true ); ?></button>
                        <button id="map-filter-cancel" class="hneue-bold"><?php echo get_post_meta( get_the_ID(), 'projects-cancel', true ); ?></button>
                        <div id="map-filter-errorbox"></div>
                        

                    </div>
                    <div class="span3 hneue-bold">
                        <div id="map-filter-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $hide_map = (!is_page("projects") && !is_home() && !is_page("projets")); ?>

    <div id="map-loader">
        <div id="map-loader-text"></div>
        <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="" />
    </div>
    <div id="map" <?php if($hide_map){ echo 'style="height:13.5em"'; }?>></div>
</div>

