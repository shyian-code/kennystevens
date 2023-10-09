<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>

<?php
// Set defaults.
$args = wp_parse_args(
    $args,
    array(
		"off_market_listing" => false,
        'popup_class' => ''
    )
);

$p_post_id = get_the_ID();
$address = get_field('property_full_address', $p_post_id);
$price = get_field('property_price', $p_post_id);
$unit_num = get_field('property_unit_num', $p_post_id);
$year_built = get_field('property_year_built', $p_post_id);
$bldg_sq_ft = get_field('property_sq_ft', $p_post_id);
$lot_sq_ft = get_field('property_lot_size', $p_post_id);
$current_cap = get_field('property_current_cap', $p_post_id);
$current_grm = get_field('property_current_grm', $p_post_id);
$proforma_cap = get_field('property_proforma_cap', $p_post_id);
$proforma_grm = get_field('property_proforma_grm', $p_post_id);
$term_list = wp_get_post_terms($p_post_id, 'property_location', array('fields' => 'names'));

$agent_name = get_field('agent_name', $p_post_id);
$agent_photo = get_field('agent_photo', $p_post_id);
$agent_email = get_field('agent_email', $p_post_id);
$agent_phone = get_field('agent_phone', $p_post_id);
?>
<article
	id="post-<?php the_ID(); ?>" <?php post_class('post section image-hover-text-cols__col--md-wide image-hover-text-cols__col'); ?>>
	<div class="image-hover-text__wrapper post__inner">
		<a class="post__link <?php echo $args['popup_class']; ?>" href="<?php echo get_the_permalink($p_post_id); ?>"></a>
		<div class="image-hover-text-cols__top image-hover-text image-hover-text--no-hover">
			<?php if (get_the_post_thumbnail($p_post_id)) :
				$image_alt = get_post_meta(get_post_thumbnail_id($p_post_id), '_wp_attachment_image_alt', true);
				?>
				<div class="post__img-wrapper" <?php echo kennystevens_bg_style(get_the_post_thumbnail_url($p_post_id)); ?>>
					<img class="image-hover-text__img post__img"
							 src="<?php echo get_the_post_thumbnail_url($p_post_id, 'success_story'); ?>"
							 alt="<?php echo $image_alt; ?>">
				</div>
			<?php else : ?>
				<div class="post__img--default">
					<img class="image-hover-text__img"
							 src="<?php echo get_template_directory_uri(); ?>/assets/images/default.png"
							 alt="<?php echo get_the_title(); ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="image-hover-text__text-wrapper attributes__wrapper">
			<div>
				<h4 class="image-hover-text__title"><?php echo get_the_title($p_post_id); ?></h4>
				<?php if ($address) : ?>
					<div class="image-hover-text__subtitle">
						<?php echo $address; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="attributes">
				<?php if ($price) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Price', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo (is_numeric(substr($price, 0, 1)) ? "$" : "") . $price; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($term_list) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('City', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $term_list[0]; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($unit_num) : ?>
					<p class="attribute__wrapper">
						<span class="attribute__label"><?php _e('Units', THEME_TD); ?></span>
						<span class="attribute__value"><?php echo $unit_num; ?></span>
					</p>
				<?php endif; ?>
				<?php if ($args['off_market_listing']) : ?>
					<?php if ($year_built) : ?>
						<p class="attribute__wrapper">
							<span class="attribute__label"><?php _e('Year built', THEME_TD); ?></span>
							<span class="attribute__value"><?php echo $year_built; ?></span>
						</p>
					<?php endif; ?>
					<?php if ($bldg_sq_ft) : ?>
						<p class="attribute__wrapper">
							<span class="attribute__label"><?php _e('Bldg. SF', THEME_TD); ?></span>
							<span class="attribute__value"><?php echo $bldg_sq_ft; ?></span>
						</p>
					<?php endif; ?>
					<?php if ($lot_sq_ft) : ?>
						<p class="attribute__wrapper">
							<span class="attribute__label"><?php _e('Lot SF', THEME_TD); ?></span>
							<span class="attribute__value"><?php echo $lot_sq_ft; ?></span>
						</p>
					<?php endif; ?>
					<?php if ($current_cap) : ?>
						<p class="attribute__wrapper">
							<span class="attribute__label"><?php _e('Current Cap Rate', THEME_TD); ?></span>
							<span class="attribute__value"><?php echo $current_cap; ?></span>
						</p>
					<?php endif; ?>
				
					<?php // Store agent info data ?>
					<?php if ($agent_name) : ?>
						<input class="field-agent-name" type="hidden" value="<?php echo $agent_name; ?>" >
					<?php endif; ?>
					<?php if ($agent_photo) : ?>
						<input class="field-agent-photo" type="hidden" value="<?php echo $agent_photo; ?>" >
					<?php endif; ?>
					<?php if ($agent_email) : ?>
						<input class="field-agent-email" type="hidden" value="<?php echo $agent_email; ?>" >
					<?php endif; ?>
					<?php if ($agent_phone) : ?>
						<input class="field-agent-phone" type="hidden" value="<?php echo $agent_phone; ?>" >
					<?php endif; ?>
				<?php endif; ?>
				<?php 
				//if ($current_cap || $current_grm) : 
				?>
				<?php if (false) : ?>
					<p class="attribute__wrapper">
									<span
										class="attribute__label"><?php _e('Current ' . ($current_cap ? 'CAP' : '') . ($current_cap && $current_grm ? ' / ' : '') . ($current_grm ? 'GRM' : ''), THEME_TD); ?></span>
						<span
							class="attribute__value"><?php echo ($current_cap ? $current_cap . '%' : '') . ($current_cap && $current_grm ? ' / ' : '') . ($current_grm ? $current_grm . '%' : ''); ?></span>
					</p>
				<?php endif; ?>
				<?php 
				//if ($proforma_cap || $proforma_grm) :
				?>
				<?php if (false) : ?>
					<p class="attribute__wrapper">
									<span
										class="attribute__label"><?php _e('Proforma ' . ($proforma_cap ? 'CAP' : '') . ($proforma_cap && $proforma_grm ? ' / ' : '') . ($proforma_grm ? 'GRM' : ''), THEME_TD); ?></span>
						<span
							class="attribute__value"><?php echo ($proforma_cap ? $proforma_cap . '%' : '') . ($proforma_cap && $proforma_grm ? ' / ' : '') . ($proforma_grm ? $proforma_grm . '%' : ''); ?></span>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>
