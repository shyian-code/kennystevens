<?php
$nav_title = get_field('success_stories_navigation_title', 'options');
$nav_link_text = get_field('success_stories_navigation_link_text', 'options');

$next_post = get_previous_post();

if ($next_post) :
	$story_post_id = $next_post->ID;
	$story_description = kennystevens_address_price('story', 'success_story_location', 'success_stories', $story_post_id);
	$nav_post_link = get_the_permalink($story_post_id);
	$nav_post_title = get_the_title($story_post_id);

	if (has_post_thumbnail($story_post_id)) {
		$image = get_the_post_thumbnail_url($story_post_id, 'full');
		$image_alt = get_post_meta(get_post_thumbnail_id($story_post_id), '_wp_attachment_image_alt', true);
	} else {
		$image = get_template_directory_uri() . '/assets/images/default.png';
		$image_alt = $nav_post_title;
	}
	?>

	<div class="links-list-image">
		<div class="links-list-image__row">
			<div class="links-list-image__col">
				<h2 class="links-list-image__title links-list-image__title--bigger"><?php echo $nav_title ? $nav_title : $nav_post_title; ?></h2>
				<?php if ($story_description) : ?>
					<h6 class="links-list-image__description"><?php echo $story_description; ?></h6>
				<?php endif; ?>
				<a class="links-list-image__btn btn btn--black-line"
					 href="<?php echo $nav_post_link; ?>"><?php echo $nav_link_text ? $nav_link_text : $nav_post_title; ?></a>
			</div>
			<div class="links-list-image__col links-list-image__img-wrapper">
				<img class="links-list-image__img" src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
				<div class="links-list-image__bg" <?php echo kennystevens_bg_style($image); ?>></div>
			</div>
		</div>
	</div>
<?php endif;
