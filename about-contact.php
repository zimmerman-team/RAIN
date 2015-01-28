<div id="contact-wrapper">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
							<strong><?php echo get_post_meta( get_the_ID(), 'subtitle', true ); ?></strong>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div id="about-contact-text">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div id="about-contact-block">
					<div id="about-contact-block-name"><?php echo get_post_meta( get_the_ID(), 'right-block-rain-name', true ); ?></div>
					<div id="about-contact-block-address"><?php echo get_post_meta( get_the_ID(), 'right-block-address', true ); ?></div>
					<div id="about-contact-block-telephone"><?php echo get_post_meta( get_the_ID(), 'right-block-telephone', true ); ?></div>
					<div id="about-contact-block-email"><?php echo get_post_meta( get_the_ID(), 'right-block-email', true ); ?></div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div id="about-contact-map-title"><?php echo get_post_meta( get_the_ID(), 'map-title', true ); ?></div>
			</div>
		</div>

	</div>

	<div id="contact-map"></div>

</div>

  <script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
  <script>
    $(document).ready(function () {
      var map = L.map('contact-map', {
          attributionControl: false, 
          scrollWheelZoom: false,
          zoom: 16,
      }).setView([52.389233, 4.890734], 16);

      L.tileLayer('https://{s}.tiles.mapbox.com/v3/zimmerman2014.hpk7c4k4/{z}/{x}/{y}.png').addTo(map);

      var marker = L.marker([52.389233, 4.890734]).addTo(map);
      marker.bindPopup("<b>RAIN<br>Barentzplein 7 1013 NJ<br>Amsterdam<br>The Netherlands<br><a target='_blank' href='https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=rain+foundation,+amsterdam&aq=&sll=38.747346,-85.008852&sspn=2.069216,3.817749&vpsrc=0&ie=UTF8&hq=&hnear=&t=m&z=17&cid=9999472455585284520&iwloc=A'> Plan your route.</a></b>").openPopup();

    });
  </script>