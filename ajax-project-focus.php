<div class="row">
	<div class="col-xs-6">

        <?php
        require_once( TEMPLATEPATH .'/projects-functions.php' );
        oipa_generate_results($objects, $meta, null, false);
        $project_count = 0;
        foreach($objects AS $idx=>$project) {
        ?>

          <div data-slide-id="<?php echo $project_count; ?>" class="project-focus-slide-content <?php if($project_count == 0){ echo "active"; } ?>">
            <?php   
            if(!empty($project->documents)) {
            	$image_url = $project->documents[0]->url;
            	if (strpos($image_url,'docx') !== false) {
					$image_url = get_stylesheet_directory_uri() . '/images/no-project-image.png';
				} 
              ?>
                <img class="pf-project-image" src="<?php echo $image_url; ?>" alt="" />
              <?php
            } else {
              ?>
                <img class="pf-project-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-project-image.png" alt="" />
              <?php
            }
            ?>

            <div class="pf-project-info">
              <span>Countries: </span>   <?php 

              if(!empty($project->countries)) {
                $sep = '';
                foreach($project->countries AS $country) {
                  echo  $sep . $country->name;
                  $sep = ', ';
                }
              }
              ?><br>
              <span>Sector: </span>   <?php 
                if(!empty($project->sectors)) {
                  $sep = '';
                  foreach($project->sectors AS $sector) {
                    if($sector->code > 1000){
                      echo  $sep . $sector->name;
                      $sep = ', ';
                    }
                  }   
                } else {
                  echo "No information available";
                } ?><br>
              <span>Budget: </span>   <?php if(!empty($project->total_budget)) {
              if(!empty($project->default_currency)) { 
                echo currencyCodeToSign($project->default_currency->code); }
                echo format_custom_number($project->total_budget);
            } else {
              echo "-";
            } ?><br>
              <span>Participating organisations: </span> <?php 
            if(!empty($project->participating_organisations)) {

              $part_org_count = count($project->participating_organisations);
              echo (string)$part_org_count . " partners";

            } else {
              echo "0 partners";
            }
            ?> <br>
              <span>IATI ID: </span> <?php if(!empty($project->iati_identifier)) { echo $project->iati_identifier; } ?><br>
              <hr>
              <div class="pf-project-description">
                
                <?php
                $desc_found = 0;
                // get descriptions from rsr
                if (!empty($project->descriptions)){ 
                  if (count($project->descriptions) > 2){
                    $desc = $project->descriptions[2];
                    $description_text = $desc->description;
                    echo substr($description_text, 0, 200) . "...";
                    $desc_found = 1; 
                  }
                }
                if ($desc_found == 0) {
                  echo "No summary found.";
                }?>


                <a target="_blank" href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>" alt="See project details">Read more</a>

              </div>
            </div>
          </div>

        <?php $project_count++;
      } ?>
			</div>
			<div class="col-xs-6 project-focus-slider-wrapper">

        <ul class="project-focus-slider">


          <?php 
          $project_count = 0;
          foreach($objects AS $idx=>$project) {
          ?>

              <div data-slide-id="<?php echo $project_count; ?>" class="row project-focus-item <?php if (($project_count % 2) == 0){ echo "uneven"; } else { echo "even"; } ?> <?php if ($project_count == 0){ echo "active"; } ?>">
                <div class="col-sm-3">
                  <div class="row">
                    <div class="col-sm-12 project-focus-slider-sector">
                      &nbsp;
                    </div>
                  </div>
                  <div class="projects-focus-image">
                      <?php   
                      if(!empty($project->documents)) {
                        $image_url = $project->documents[0]->url;
                        if (strpos($image_url,'docx') !== false) {
							$image_url = get_stylesheet_directory_uri() . '/images/no-project-image.png';
						} 
                        ?>
                          <img src="<?php echo $image_url; ?>" alt="" />
                        <?php
                      } else {
                        ?>
                          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-project-image.png" alt="" />
                        <?php
                      }
                      ?>
                  </div>
                  
                </div>

                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-12 project-focus-slider-sector">
                      <?php 
                      if(!empty($project->sectors)) {
                        $sep = '';
                        foreach($project->sectors AS $sector) {
                          if($sector->code > 1000){
                            echo  $sep . $sector->name;
                            $sep = ', ';
                          }
                        }   
                      } else {
                        echo "No information available";
                      } ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="projects-focus-title-wrapper">
                        <?php if (!empty($project->titles)){ 
                          echo $project->titles[0]->title; 
                        } else {
                          echo get_post_meta( $the_id, 'projects-no-title', true );
                        }?>
                      </div>
                      <div class="projects-focus-description-wrapper">
                      	<?php 
                      	if (!empty($project->descriptions)){ 
		                  if (count($project->descriptions) > 2){
		                    $desc = $project->descriptions[2];
		                    $description_text = $desc->description;
		                    echo substr($description_text, 0, 60) . "...";
		                    $desc_found = 1; 
		                  }
		                }
		                if ($desc_found == 0) {
		                  echo "No summary found.";
		                } 
		                ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          <?php $project_count++; 
        } ?>

        </ul>
	</div>
</div>