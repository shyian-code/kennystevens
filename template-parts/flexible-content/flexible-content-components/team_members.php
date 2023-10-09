<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$top_offset = get_sub_field('top_offset');
$bottom_offset = get_sub_field('bottom_offset');
$show = get_sub_field('team_members_show');
$team_members_posts = get_sub_field('members');

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

if ($show == 'chosen') {
	$arg_ppp = sizeof($team_members_posts);
	if (is_array($team_members_posts)) {
		$arg_in = array_values($team_members_posts);
	} else {
		$arg_in = array($team_members_posts);
	}
	$arg_orderby = 'post__in';
	$arg_order = 'ASC';
} else {
	$arg_ppp = -1;
	$arg_in = array();
	$arg_orderby = 'menu_order';
	$arg_order = 'ASC';
}
$team_members_args = array(
	'post_type' => 'team_member',
	'post_status' => 'publish',
	'order' => $arg_order,
	'orderby' => $arg_orderby,
	'post__in' => $arg_in,
	'posts_per_page' => $arg_ppp,
);

$team_members = new WP_Query($team_members_args); ?>
<div class="image-hover-text-cols"<?php echo $offset_style; ?>>
	<?php if ($title || $text) : ?>
		<div class="section">
			<div class="image-hover-text-cols__row--narrow title-text image-hover-text-cols__row">
				<?php kennystevens_title_text('image-hover-text-cols__', 'all'); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($team_members->have_posts()) : ?>
		<div class="image-hover-text-cols__row--no-pad image-hover-text-cols__row">
			<?php while ($team_members->have_posts()) : $team_members->the_post();
				$member_post_id = get_the_ID();
				$first_name = get_field('team_member_name_first', $member_post_id);
				$last_name = get_field('team_member_name_last', $member_post_id);
				$quote = get_field('team_member_quote', $member_post_id);
				$quote_author = get_field('team_member_quote_author', $member_post_id);
				$quote_above = get_field('team_member_hover_txt_above', $member_post_id);
				$dre = get_field('team_member_dre', $member_post_id);
				?>
				<div class="section image-hover-text-cols__col image-hover-text-cols__col--center">
					<div class="image-hover-text-cols__ image-hover-text-cols__top image-hover-text">
						<?php if (get_the_post_thumbnail()) :
							$image_alt = get_post_meta(get_post_thumbnail_id($member_post_id), '_wp_attachment_image_alt', true);
							?>
							<img class="image-hover-text__img"
									 src="<?php echo get_the_post_thumbnail_url($member_post_id); ?>"
									 alt="<?php echo $image_alt; ?>">
						<?php else : ?>
							<img class="image-hover-text__img"
									 src="<?php echo get_template_directory_uri(); ?>/assets/images/default.png"
									 alt="<?php echo get_the_title(); ?>">
						<?php endif; ?>

						<?php if ($quote) : ?>
							<div class="image-hover-text__hover-wrapper image-hover-text__hover-wrapper--text-overflow">
								<?php if ($quote_above) : ?>
									<p class="image-hover-text__text image-hover-text__text--above"><?php echo $quote_above; ?></p>
								<?php endif; ?>
								<p class="image-hover-text__text--center"><?php echo $quote; ?></p>
								<?php if ($quote_author) : ?>
									<p class="image-hover-text__text image-hover-text__text--below"><?php echo $quote_author; ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ($first_name) : ?>
						<h3 class="image-hover-text__name">
							<?php echo $first_name; ?>
							<?php if ($last_name) : ?>
								<span class="image-hover-text__name-inner"><?php echo $last_name; ?></span>
							<?php endif; ?>
							<?php if ($dre) : ?>
								<span class="image-hover-text__name-inner dre">DRE <?php echo $dre; ?></span>
							<?php endif; ?>
						</h3>	
					<?php else : ?>
						<h3 class="image-hover-text__name"><?php echo get_the_title($member_post_id); ?></h3>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif;
	wp_reset_query(); ?>
</div>
