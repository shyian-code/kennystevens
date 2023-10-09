<?php if (have_rows('featured_neighborhoods')) : ?>
	<?php $assigned_featured_neighborhoods = array(); ?>
	<?php while (have_rows('featured_neighborhoods')) : the_row();
		$assigned_featured_neighborhoods[] = get_sub_field('neighborhood_slug');
	?>
<?php endwhile; ?>
<?php endif; ?>

<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$top_offset = get_sub_field('top_offset');
$bottom_offset = get_sub_field('bottom_offset');
$covid_listings = get_sub_field('covid19_listings');

if ($top_offset || $bottom_offset) {
	if ($top_offset && !$bottom_offset) {
		$offset_style = ' style="padding-top: ' . $top_offset . 'px;"';
	} elseif ($bottom_offset && !$top_offset) {
		$offset_style = ' style="padding-bottom: ' . $bottom_offset . 'px;"';
	} else {
		$offset_style = ' style="padding-top: ' . $top_offset . 'px; padding-bottom: ' . $bottom_offset . 'px;"';
	}
} else {
	$offset_style = '';
}

if($covid_listings[0] == "show") {

} else {
	$neighborhood_terms = get_terms([
		'taxonomy' => "property_neighborhood",
		'hide_empty' => true,
	]);

	$first_neighborhood = $assigned_featured_neighborhoods[0];

	$neighborhood_query = get_query_var("n");

	if($neighborhood_query == "") {
		$neighborhood_query = $first_neighborhood;
	}
}

?>

<div id="map-section" class="map"<?php echo $offset_style; ?>>
	<?php if ($title || $text) : ?>
		<div class="map__row--narrow map__row">
			<?php kennystevens_title_text('post-listing__', 'all'); ?>
		</div>
	<?php endif; ?>

<?php if ($covid_listings[0] == "show") : ?>

	<?php
		// wp-query to get all properties without pagination
		$allPostsWPQuery = new WP_Query(array(
			'post_type'=>'property',
			'post_status'=>'publish',
			'posts_per_page'=>-1,
			'meta_query' => array (
				array (
					'key' => 'covid19_listing',
					'value' => "yes",
					'compare' => 'LIKE'
				)
		  )
		)); ?>

		<?php if ( $allPostsWPQuery->have_posts() ) : ?>
			<?php
				$properties = $allPostsWPQuery->posts;
				$map_details = array();

				foreach($properties as $property) {
					$location_meta = get_post_meta($property->ID, "map_location");
					$map_details[] = array(
						"property_name" => $property->post_title,
						"address" => $location_meta[0]["address"],
						"lat" => $location_meta[0]["lat"],
						"lng" => $location_meta[0]["lng"],
						"state" => $location_meta[0]["state"],
						"city" => $location_meta[0]["city"]
					);
				}
			?>
			<?php wp_reset_postdata(); ?>
		 <?php else : ?>
			<p><?php _e( 'There no posts to display.' ); ?></p>
		<?php endif; ?>

<?php else : ?>
	<?php if (have_rows('featured_neighborhoods')) : ?>
		<h4>Featured Neighborhoods</h4>
		<div class="featured-neighborhoods__row">
		<?php while (have_rows('featured_neighborhoods')) : the_row();
			$neighborhood_name = get_sub_field('neighborhood_name');
			$neighborhood_slug = get_sub_field('neighborhood_slug');
			$neighborhood_thumbnail = get_sub_field('neighborhood_thumbnail');
		?>

				<a class="featured-neighborhood-item ft_<?php echo $neighborhood_slug; ?>" href="<?php echo $neighborhood_slug; ?>">
					<span class="neighborhood_thumbnail" style="background-image: url('<?php echo $neighborhood_thumbnail["url"]; ?>')">
						<span class="star-selection <?php echo ($neighborhood_query == $neighborhood_slug ? "selected" : ""); ?>"><span>☆</span></span>
					</span>
					<span class="neighborhood_name">
						<?php echo $neighborhood_name; ?>
					</span>
				</a>

		<?php endwhile; ?>
		</div>
	<?php endif; ?>

	<?php
// wp-query to get all properties without pagination
$allPostsWPQuery = new WP_Query(array(
	'post_type'=>'property',
	'post_status'=>'publish',
	'posts_per_page'=>-1,
	'tax_query' => array(
			array(
				'taxonomy' => 'property_status',
				'field'    => 'slug',
				'terms'    => 'closed',
			),
		),
)); ?>

<?php if ( $allPostsWPQuery->have_posts() ) : ?>
	<?php
		$properties = $allPostsWPQuery->posts;
		$map_details = array();

		foreach($properties as $property) {
			$neighborhood_slugs = array();
			$neighborhoods = get_the_terms($property->ID, "property_neighborhood");

			if (is_array($neighborhoods) || is_object($neighborhoods)) {
				foreach ($neighborhoods as $neighborhood) {
					$neighborhood_slugs[] = $neighborhood->slug;
				}
			}

			if(in_array($neighborhood_query, $neighborhood_slugs)) {
				$location_meta = get_post_meta($property->ID, "map_location");
				$map_details[] = array(
					"property_name" => $property->post_title,
					"address" => $location_meta[0]["address"],
					"lat" => $location_meta[0]["lat"],
					"lng" => $location_meta[0]["lng"],
					"state" => $location_meta[0]["state"],
					"city" => $location_meta[0]["city"]
				);
			}
		}


	?>
    <?php wp_reset_postdata(); ?>
 <?php else : ?>
    <p><?php _e( 'There no posts to display.' ); ?></p>
<?php endif; ?>

	<div class="map__wrapper" id="featuredMap">
		<?php
			$neighborhood_terms = get_terms([
				'taxonomy' => "property_neighborhood",
				'hide_empty' => false,
			]);
		?>

		<?php if(!empty($neighborhood_terms)) : ?>
			<div class="featured-neighborhoods-dropdown__row">
			<select id="dropdown-neighborhood" name="n">
				<?php foreach($neighborhood_terms as $neighborhood_term) : ?>
					<option value="<?php echo $neighborhood_term->slug; ?>" <?php echo ($neighborhood_query == $neighborhood_term->slug ? "selected" : ""); ?>><?php echo $neighborhood_term->name; ?></option>
				<?php endforeach; ?>
			</select>
			</div>

		<?php endif; ?>
<?php endif; ?> <!-- If not covid listings -->

		<?php if ($map_details) : ?>
			<div class="acf-map" id="propertyMap">
				<?php foreach ($map_details as $map_detail) : ?>
					<div class="marker" data-lat="<?php echo $map_detail["lat"]; ?>" data-lng="<?php echo $map_detail["lng"]; ?>">
						<div class="marker__wrapper">
							<p class="marker__text">
								<strong style="font-weight: 800;"><?php echo $map_detail["property_name"]; ?></strong><br>
								<?php echo $map_detail["address"]; ?>
							</p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>

	<!-- Backup
	<div class="map__wrapper">
		<?php if (have_rows('locations')) : ?>
			<div class="acf-map">
				<?php while (have_rows('locations')) : the_row();
					$location = get_sub_field('location');
					$image = get_sub_field('image');
					$text = get_sub_field('text');
					$location_lat = $location['lat'];
					$location_lng = $location['lng'];
					$location_address = $location['address']; ?>
					<div class="marker" data-lat="<?php echo $location_lat; ?>"
							 data-lng="<?php echo $location_lng; ?>">
						<div class="marker__wrapper">
							<?php if ($image) : ?>
								<div class="marker__image">
									<img src="<?php echo $image; ?>" alt="">
								</div>
							<?php endif; ?>
							<div class="marker__text-wrapper<?php if (!$image) {
								echo " marker__text-wrapper--full";
							} ?>">
								<?php if ($text) : ?>
									<p class="marker__text marker__text--bold"><?php echo $text; ?></p>
								<?php endif; ?>
								<p class="marker__text"><?php echo $location_address; ?></p>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>-->
</div>
