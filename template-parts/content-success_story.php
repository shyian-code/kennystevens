<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */


$link_text = get_field('success_stories_navigation_link_text', 'options');
$ss_post_id = get_the_ID();
$title = get_the_title($ss_post_id);
$preview = get_field('story_preview', $ss_post_id);
$link = get_the_permalink($ss_post_id);
$term_list = wp_get_post_terms($ss_post_id, 'success_story_location', array('fields' => 'names'));
?>
<article
	id="post-<?php the_ID(); ?>" <?php post_class('post section image-hover-text-cols__col--md-wide image-hover-text-cols__col'); ?>>
	<div class="image-hover-text__wrapper post__inner">
		<div class="image-hover-text-cols__top image-hover-text image-hover-text--no-hover">
			<?php if (get_the_post_thumbnail()) :
				$image_alt = get_post_meta(get_post_thumbnail_id($ss_post_id), '_wp_attachment_image_alt', true);
				?>
				<div class="post__img-wrapper" <?php echo kennystevens_bg_style(get_the_post_thumbnail_url($ss_post_id)); ?>>
					<img class="image-hover-text__img post__img"
							 src="<?php echo get_the_post_thumbnail_url($ss_post_id, 'success_story'); ?>"
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
		<div class="image-hover-text__text-wrapper">
			<h4 class="image-hover-text__title"><?php echo $title; ?></h4>
			<?php foreach ($term_list as $term) : ?>
				<p class="image-hover-text__subtitle image-hover-text__subtitle--uppercase"><?php echo $term; ?></p>
			<?php endforeach; ?>
			<p class="image-hover-text__preview"><?php echo $preview; ?></p>
		</div>
		<div class="image-hover-text__link-wrapper">
			<a class="image-hover-text__link btn btn--black-line" href="<?php echo $link; ?>"><?php echo $link_text; ?></a>
		</div>
	</div>

</article>
