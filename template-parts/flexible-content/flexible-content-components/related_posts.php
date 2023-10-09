<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$top_offset = get_sub_field('top_offset');
$bottom_offset = get_sub_field('bottom_offset');
$posts_in = get_sub_field('posts');

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

if ($posts_in) :

	$related_posts_args = array(
		'post_type' => 'property',
		'posts_per_page' => 3,
		'post_status' => 'publish',
		'order' => 'menu_order',
		'post__in' => $posts_in,
	);

	$related_posts = new WP_Query($related_posts_args); ?>
	<?php if ($related_posts->have_posts()) : ?>
	<div class="image-hover-text-cols"<?php echo $offset_style; ?>>
		<?php if ($title || $text) : ?>
			<div class="image-hover-text-cols__row--narrow title-text image-hover-text-cols__row">
				<?php kennystevens_title_text('post-listing__', 'all'); ?>
			</div>
		<?php endif; ?>
		<div class="image-hover-text-cols__row--no-pad image-hover-text-cols__row">
			<?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
				<?php get_template_part('/template-parts/content', get_post_type()); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif;
	wp_reset_query();
endif;

