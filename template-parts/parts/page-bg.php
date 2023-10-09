<?php
$image = get_field('page_bg_image');
$page_bg_image_desktop_height = get_field('page_bg_image_desktop_height');

if ($image) : ?>
	<div class="page-main__bg" <?php echo kennystevens_bg_style($image); ?>>
		<?php if ($page_bg_image_desktop_height) : ?>
			<style>
				.page-main__bg {
					height: <?php echo $page_bg_image_desktop_height; ?>px;
				}
			</style>
		<?php endif; ?>
	</div>
<?php endif;
