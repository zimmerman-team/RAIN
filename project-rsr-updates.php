<?php 
$rsr_id = "";
if (!empty($project->other_identifier)){
	foreach($project->other_identifier as $otheridentifier){
		if ($otheridentifier->owner_name == "akvorsr"){
			$rsr_id = $otheridentifier->owner_ref;
		}
	}
}

if ($rsr_id != ""){
	if(isset($_REQUEST['limit'])){
		$limit = $_REQUEST['limit'];
	} else{
		$limit = 20;
	}

	$rsr_content = file_get_contents("http://rsr.akvo.org/api/v1/project_update/?format=json&limit=" . $limit . "&project=" . $rsr_id);
	$rsr_result = json_decode($rsr_content);
	$rsr_meta = $rsr_result->meta;
	$rsr_objects = $rsr_result->objects;

	function rsr_custom_excerpt ($str, $length=250, $trailing='...'){
		$length-=mb_strlen($trailing);
		if (mb_strlen($str)> $length) {
			return mb_substr($str,0,$length).$trailing;
		} else {
			$res = $str;
		}

		return $res;
	}
	$rsr_update_count = 0;
	foreach($rsr_objects as $rsr_update){
		$rsr_update_count++;
		if($rsr_update_count == 3){
			echo "<div id='hidden-rsr-updates'>";
		}
	?>

	<div class="row rsr-header">
		<div class="col-sm-3">	
			

		</div>
		<div class="col-sm-9">
			<?php
			echo date("d-M-Y", strtotime($rsr_update->time));
			?>
		</div>
	</div>
	<div class="row rsr-body">
		<div class="col-sm-3 rsr-image-wrapper">	
			<?php

			if(!empty($rsr_update->photo)){
				echo '<img src="http://rsr.akvo.org/' . $rsr_update->photo . '" />';
			} else {
				?>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-project-image-rsr.png" alt="" />
				<?php
			}
			?>
		</div>
		<div class="col-sm-9">	
			<div class="row">
				<div class="col-sm-12 rsr-title">
					<a target="_blank" href="<?php echo 'http://rsr.akvo.org' . $rsr_update->absolute_url; ?>">
						<?php echo $rsr_update->title; ?>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 rsr-description">
					<?php 
					$trail = '<a target="_blank" href="http://rsr.akvo.org' . $rsr_update->absolute_url . '">' . get_post_meta( get_the_ID(), 'project_read_more', true ) . '</a>';
					echo rsr_custom_excerpt($rsr_update->text, 250, $trail); 
					?>
				</div>
			</div>
		</div>
	</div>

	<?php
	}

	if($rsr_update_count > 1){
		echo "</div>";
	}

	if ($rsr_meta->total_count > 2){ ?>
		<div class="row">
			<a href='#' id='load-more-rsr-updates'>
				<?php echo get_post_meta( get_the_ID(), 'project_view_more_updates', true ); ?>
			</a>
		</div>
	<?php
	}

} else {
	?>
		<div class='no-rsr-updates'>
			<?php echo get_post_meta( get_the_ID(), 'project_no_rsr_updates', true ); ?>
		</div>
	<?php
}
?>