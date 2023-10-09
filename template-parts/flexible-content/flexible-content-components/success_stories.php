<?php
$top_offset = get_sub_field('top_offset');
$bottom_offset = get_sub_field('bottom_offset');
$show = get_sub_field('stories_to_show');
$success_stories_posts = get_sub_field('stories');

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
	$arg_ppp = sizeof($success_stories_posts);
	if (is_array($success_stories_posts)) {
		$arg_in = array_values($success_stories_posts);
	} else {
		$arg_in = array($success_stories_posts);
	}
	$arg_orderby = 'post__in';
	$arg_order = 'ASC';
} elseif ($show == 'all') {
	$arg_ppp = -1;
	$arg_in = array();
	$arg_orderby = 'date';
	$arg_order = 'DESC';
} elseif ($show == 'six') {
	$arg_ppp = 6;
	$arg_in = array();
	$arg_orderby = 'date';
	$arg_order = 'DESC';
} else {
	$arg_ppp = 3;
	$arg_in = array();
	$arg_orderby = 'date';
	$arg_order = 'DESC';
}
$success_stories_args = array(
	'post_type' => 'success_story',
	'post_status' => 'publish',
	'order' => $arg_order,
	'orderby' => $arg_orderby,
	'post__in' => $arg_in,
	'posts_per_page' => $arg_ppp,
);

$success_stories = new WP_Query($success_stories_args); ?>
<div class="image-hover-text-cols"<?php echo $offset_style; ?>>
	<?php if ($success_stories->have_posts()) : ?>
		<div class="image-hover-text-cols__row--no-pad image-hover-text-cols__row">
			<?php while ($success_stories->have_posts()) : $success_stories->the_post(); ?>
				<?php get_template_part('/template-parts/content', get_post_type()); ?>
			<?php endwhile; ?>
		</div>
	<?php endif;
	wp_reset_query(); ?>
</div>
