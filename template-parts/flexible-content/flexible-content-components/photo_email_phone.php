<?php
$title = get_sub_field('title');
$choose_from = get_sub_field('choose_from');

if ($choose_from == 'custom') {
	$name = get_sub_field('name');
	$image_obj = get_sub_field('photo');
	$image_url = $image_obj["url"];
	$image_alt = $image_obj["alt"];
	$email = get_sub_field('email');
	$phone = get_sub_field('phone');
} else {
	$tm_id = get_sub_field('team_member');
	if ($tm_id) {
		$name = get_the_title($tm_id);
		$image_url = get_the_post_thumbnail_url($tm_id);
		$image_alt = get_post_meta(get_post_thumbnail_id($tm_id), '_wp_attachment_image_alt', true);
		$email = get_field('team_member_email', $tm_id);
		$phone = get_field('team_member_phone', $tm_id);
	} else {
		$name = __('us', THEME_TD);
		$image_url = get_the_post_thumbnail_url(get_the_ID());
		$image_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
		$email = get_field('links_list_btn', 'options');
	}
}
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

if ($name || $image_url || $email || $phone) :?>
	<section class="section">
		<div class="photo-email-phone"<?php echo $offset_style; ?>>
			<div class="photo-email-phone__row">
				<div class="photo-email-phone__col photo-email-phone__col--narrow">
					<?php if ($image_url) : ?>
						<img class="photo-email-phone__img" src="<?php echo $image_url; ?>"
								 alt="<?php echo $image_alt; ?>">
					<?php endif; ?>
				</div>
				<div class="photo-email-phone__col photo-email-phone__col--wide">
					<?php if ($title) : ?>
						<h2 class="photo-email-phone__title"><?php echo $title; ?></h2>
					<?php endif; ?>
					<?php if ($name) : ?>
						<p class="photo-email-phone__text"><?php _e('Contact ' . $name . ' about it!', THEME_TD); ?></p>
					<?php endif; ?>
					<div class="photo-email-phone__links">
						<?php if ($email) : ?>
							<a href="mailto:<?php echo $email; ?>"
								 class="photo-email-phone__link btn btn--black"><?php _e('Email', THEME_TD); ?></a>
						<?php endif; ?>
						<?php if ($phone) : ?>
							<a href="tel:<?php echo $phone; ?>" class="btn btn--black"><?php _e('Call', THEME_TD); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif;
