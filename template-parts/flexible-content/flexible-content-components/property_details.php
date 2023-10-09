<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$top_offset = get_sub_field('top_offset');
$bottom_offset = get_sub_field('bottom_offset');

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

$p_post_id = get_the_ID();
$price = get_field('property_price', $p_post_id);
$year = get_field('property_year_built', $p_post_id);
$unit_num = get_field('property_unit_num', $p_post_id);
$unit_price = get_field('property_unit_price', $p_post_id);
$sq_ft = get_field('property_sq_ft', $p_post_id);
$sq_ft_price = get_field('property_sq_ft_price', $p_post_id);
$current_cap = get_field('property_current_cap', $p_post_id);
$current_grm = get_field('property_current_grm', $p_post_id);
$proforma_cap = get_field('property_proforma_cap', $p_post_id);
$proforma_grm = get_field('property_proforma_grm', $p_post_id);
$lot_size = get_field('property_lot_size', $p_post_id);
$zoning = get_field('property_zoning', $p_post_id);
$download_locked = get_field('download_file_lock');
$download = get_field('download_file');
$location = get_field('map_location');
$zoom = get_sub_field('map_zoom');

if ($location) {
	$map_parent_class = 'acf-map__parent ';
} else {
	$map_parent_class = '';
}

if (!$download_locked && !$download) {
	$row_class = 'image-hover-text-cols__row--center ';
} else {
	$row_class = '';
}
?>
<div class="image-hover-text-cols"<?php echo $offset_style; ?>>
	<?php if ($title || $text) : ?>
		<div class="image-hover-text-cols__row--narrow title-text image-hover-text-cols__row">
			<?php kennystevens_title_text('post-listing__', 'all'); ?>
		</div>
	<?php endif; ?>
	<div
		class="<?php echo $row_class . $map_parent_class; ?>image-hover-text-cols__row--no-pad image-hover-text-cols__row">
		<div class="image-hover-text-cols__col--md-wide image-hover-text-cols__col">
			<?php if ($price || $year || $unit_num || $unit_price || $sq_ft || $sq_ft_price) : ?>
				<div class="image-hover-text__wrapper image-hover-text__wrapper--txt">
					<div class="attributes image-hover-text__text-wrapper">
						<?php if ($price) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Price', THEME_TD); ?></span>
								<span class="attribute__value">$<?php echo $price; ?></span>
							</p>
						<?php endif; ?>
						<?php if ($year) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Year Built', THEME_TD); ?></span>
								<span class="attribute__value"><?php echo $year; ?></span>
							</p>
						<?php endif; ?>
						<?php if ($unit_num) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('# of Units', THEME_TD); ?></span>
								<span class="attribute__value"><?php echo $unit_num; ?></span>
							</p>
						<?php endif; ?>
						<?php if ($unit_price) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Price P/ Unit', THEME_TD); ?></span>
								<span class="attribute__value">$<?php echo $unit_price; ?></span>
							</p>
						<?php endif; ?>
						<?php if ($sq_ft) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Sq. ft.', THEME_TD); ?></span>
								<span class="attribute__value"><?php echo $sq_ft; ?></span>
							</p>
						<?php endif; ?>
						<?php if ($sq_ft_price) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Price p/ Sq. ft.', THEME_TD); ?></span>
								<span class="attribute__value">$<?php echo $sq_ft_price; ?></span>
							</p>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="image-hover-text-cols__col--md-wide image-hover-text-cols__col">
			<?php if ($current_cap || $proforma_cap || $current_grm || $proforma_grm || $lot_size || $zoning) : ?>
				<div class="image-hover-text__wrapper image-hover-text__wrapper--txt">
					<div class="attributes image-hover-text__text-wrapper">
						<?php if ($current_cap) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Current Cap Rate', THEME_TD); ?></span>
								<span class="attribute__value"><?php echo $current_cap; ?>%</span>
							</p>
						<?php endif; ?>
						<?php if ($proforma_cap) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Proforma Cap Rate', THEME_TD); ?></span>
								<span class="attribute__value"><?php echo $proforma_cap; ?>%</span>
							</p>
						<?php endif; ?>
						<?php 
						//if ($current_grm) : 
						?>
						<?php if (false) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Current GRM', THEME_TD); ?></span>
								<span class="attribute__value"><?php echo $current_grm; ?>%</span>
							</p>
						<?php endif; ?>
						<?php 
						//if ($proforma_grm) : 
						?>
						<?php if (false) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Proforma GRM', THEME_TD); ?></span>
								<span class="attribute__value"><?php echo $proforma_grm; ?>%</span>
							</p>
						<?php endif; ?>
						<?php if ($lot_size) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Lot Size', THEME_TD); ?></span>
								<span class="attribute__value"><?php echo $lot_size; ?></span>
							</p>
						<?php endif; ?>
						<?php if ($zoning) : ?>
							<p class="attribute__wrapper">
								<span class="attribute__label"><?php _e('Zoning', THEME_TD); ?></span>
								<span class="attribute__value"><?php echo $zoning; ?></span>
							</p>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<?php
		if ($download_locked || $download) : ?>
			<div class="image-hover-text-cols__col--md-wide image-hover-text-cols__col">
				<div class="image-hover-text__wrapper image-hover-text__wrapper--form">
					<div class="image-hover-text__text-wrapper download-form">
						<?php
						$rdl_text = get_field('listings_link_rdl_text', 'options');
						$rdl_link_text = get_field('listings_link_rdl_link_text', 'options');
						$sendgrid_list = get_field('single_listings_sendgrid_list', 'options');
						if ($download_locked) :
							echo do_shortcode('[dlm_gf_form gf_field_values="sendgrid_list=sendgrid_list_' . $sendgrid_list . '&property_name=' . get_the_title($p_post_id) . '" gf_title="true" gf_description="true" gf_ajax="true" download_id=' . $download_locked->ID . ']');
						endif; ?>
						<?php if ($download) : ?>
							<div class="download-form__text-wrapper">
								<?php if ($rdl_text) : ?>
									<p class="download-form__text"><?php echo $rdl_text; ?></p>
								<?php endif; ?>
								<?php if ($rdl_link_text) : ?>
									<p class="download-form__text">
										<a class="download-form__link" download
											 href="<?php echo $download["url"]; ?>"><?php echo $rdl_link_text; ?></a>
									</p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if (!empty($location)):
			$location_lat = $location['lat'];
			$location_lng = $location['lng'];
			$location_addr = get_field('property_full_address');
			?>
			<div class="acf-map__wrapper image-hover-text-cols__row">
				<div class="acf-map" data-zoom="<?php echo $zoom; ?>">
					<div class="marker" data-lat="<?php echo $location_lat; ?>"
							 data-lng="<?php echo $location_lng; ?>">
						<?php echo $location_addr; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
