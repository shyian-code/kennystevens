<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$text_position = get_sub_field('text_position');
$table_title = get_sub_field('table_title');
$top_offset = get_sub_field('top_offset');
$bottom_offset = get_sub_field('bottom_offset');

if ($top_offset || $bottom_offset) {
	if ($top_offset && !$bottom_offset) {
		$offset_style = ' style="padding-top: ' . $top_offset . 'px;"';
		$offset_class = ' pt';
	} elseif ($bottom_offset && !$top_offset) {
		$offset_style = ' style="padding-bottom: ' . $bottom_offset . 'px;"';
		$offset_class = ' pb';
	} else {
		$offset_style = ' style="padding-top: ' . $top_offset . 'px; padding-bottom: ' . $bottom_offset . 'px;"';
		$offset_class = ' pt pb';
	}
} else {
	$offset_style = '';
	$offset_class = '';
}

if ($text_position == true) {
	$txt_pos_class = 'cols-details__row--reverse ';
} else {
	$txt_pos_class = '';
}

$table = get_sub_field('table');
$attrs = [];
if ($table == 'existing') {
	$p_post_id = get_sub_field('property');
	$price = get_field('property_price', $p_post_id);
	$year = get_field('property_year_built', $p_post_id);
	$unit_price = get_field('property_unit_price', $p_post_id);
	$sq_ft = get_field('property_sq_ft', $p_post_id);
	$sq_ft_price = get_field('property_sq_ft_price', $p_post_id);
	$lot_size = get_field('property_lot_size', $p_post_id);
	$zoning = get_field('property_zoning', $p_post_id);
	$unit_num = get_field('property_unit_num', $p_post_id);
	$current_cap = get_field('property_current_cap', $p_post_id);
	$current_grm = get_field('property_current_grm', $p_post_id);
	$proforma_cap = get_field('property_proforma_cap', $p_post_id);
	$proforma_grm = get_field('property_proforma_grm', $p_post_id);
	$term_list = wp_get_post_terms($p_post_id, 'property_location', array('fields' => 'names'));
	$location = '';
	$img = get_the_post_thumbnail_url($p_post_id, 'full');
	$image_alt = get_post_meta(get_post_thumbnail_id($p_post_id), '_wp_attachment_image_alt', true);
	$attrs = get_sub_field('property_attributes');
} else {
	$price = get_sub_field('property_price');
	$year = get_sub_field('property_year_built');
	$unit_price = get_sub_field('property_unit_price');
	$sq_ft = get_sub_field('property_sq_ft');
	$sq_ft_price = get_sub_field('property_sq_ft_price');
	$lot_size = get_sub_field('property_lot_size');
	$zoning = get_sub_field('property_zoning');
	$unit_num = get_sub_field('property_unit_num');
	$current_cap = get_sub_field('property_current_cap');
	$current_grm = get_sub_field('property_current_grm');
	$proforma_cap = get_sub_field('property_proforma_cap');
	$proforma_grm = get_sub_field('property_proforma_grm');
	$term_list = '';
	$location = get_sub_field('property_location');
	$img = get_sub_field('property_img');
	$image_alt = '';
	$attrs = get_sub_field('property_attributes');
}
?>

<div class="cols-details<?php echo $offset_class; ?>"<?php echo $offset_style; ?>>
	<div class="<?php echo $txt_pos_class; ?>cols-details__row">
		<div class="cols-details__col cols-details__col--img" style="background-image: url(<?php echo $img; ?>)">
			<img class="cols-details__img"
					 src="<?php echo $img; ?>"
					 alt="<?php echo $image_alt; ?>">
		</div>
		<div class="cols-details__col cols-details__col--txt">
			<?php if ($title || $text) :
				kennystevens_title_text('cols-details__', 'title');
			endif; ?>

			<?php if ($table_title) : ?>
				<h4 class="cols-details__title-sm"><?php echo $table_title; ?></h4>
			<?php endif; ?>

			<div class="cols-details__table attributes">
				<?php if ($price && in_array('property_price', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Price', THEME_TD); ?></span>
						<span class="attribute__value">$<?php echo $price; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($year && in_array('property_year_built', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Year Built', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $year; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($term_list) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('City', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $term_list[0]; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($location && in_array('property_location', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('City', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $location; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($sq_ft && in_array('property_sq_ft', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Sq. ft.', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $sq_ft; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($unit_num && in_array('property_unit_num', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Units', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $unit_num; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($current_cap && in_array('property_current_cap', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Current CAP', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $current_cap . '%'; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($current_grm && in_array('property_current_grm', $attrs) && false) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Current GRM', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $current_grm . '%'; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($proforma_cap && in_array('property_proforma_cap', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Proforma CAP', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $proforma_cap . '%'; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($proforma_grm && in_array('property_proforma_grm', $attrs) && false) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Proforma GRM', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $proforma_grm . '%'; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($sq_ft_price && in_array('property_sq_ft_price', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Price p/ Sq. ft.', THEME_TD); ?></span>
						<span class="attribute__value">$<?php echo $sq_ft_price; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($unit_price && in_array('property_unit_price', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Price P/ Unit', THEME_TD); ?></span>
						<span class="attribute__value">$<?php echo $unit_price; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($lot_size && in_array('property_lot_size', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Lot Size', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $lot_size; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($zoning && in_array('property_zoning', $attrs)) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Zoning', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $zoning; ?></span>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
