<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$title = get_field('not_found_title', 'options');
$text = get_field('not_found_text', 'options');
$bg_img = get_field('not_found_bg_image', 'options');
$image_opacity = get_field('not_found_image_opacity', 'options');
?>
<div class="not-found">
	<?php if ($bg_img) : ?>
		<div class="not-found__bg"
				 style="opacity: <?php echo $image_opacity; ?>; <?php echo kennystevens_bg_style($bg_img, false); ?>"></div>
	<?php endif; ?>

	<div class="not-found__row">
		<div class="text-content">
			<?php if ($title) : ?>
				<h1 class="footer-cta__title"><?php echo $title; ?></h1>
			<?php else : ?>
				<h1 class="page-title"><?php esc_html_e('Nothing Found', THEME_TD); ?></h1>
			<?php endif; ?>
		</div>
	</div>

	<div class="not-found__row">
		<div class="text-content text-content--black">
			<?php if ($text) : ?>
				<p class="footer-cta__text"><?php echo $text; ?></p>
			<?php else : ?>
				<?php if (is_home() && current_user_can('publish_posts')) : ?>

					<p><?php printf(wp_kses(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', THEME_TD), array('a' => array('href' => array()))), esc_url(admin_url('post-new.php'))); ?></p>

				<?php else : ?>

					<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', THEME_TD); ?></p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
