<?php
$title = get_field('cta_section_title', 'option');
$text = get_field('cta_section_text', 'option');
$btn_type = get_field('cta_section_button_type', 'option');
$link = get_field('cta_section_link', 'option');
$image = get_field('cta_section_image', 'option');
$image_opacity = get_field('cta_section_image_opacity', 'option');
?>

<section class="footer-cta">
	<div class="footer-cta__bg" style="opacity: <?php echo $image_opacity; ?>; <?php echo kennystevens_bg_style($image, false); ?>"></div>
	<div class="footer-cta__row">
		<?php if ($title) : ?>
			<h2 class="footer-cta__title"><?php echo $title; ?></h2>
		<?php endif; ?>
		<?php if ($text) : ?>
			<p class="footer-cta__text"><?php echo $text; ?></p>
		<?php endif; ?>
		<?php
		if ($btn_type == 'link') :?>
			<?php if ($link) : ?>
				<a class="footer-cta__cta btn btn--black" href="<?php echo $link["url"]; ?>"
					 title="<?php echo $link["title"]; ?>"
					 target="<?php echo $link["target"]; ?>"><?php echo $link["title"]; ?></a>
			<?php endif; ?>
		<?php else :
			$id = 'options';
			$btn = get_field('cta_section_email', $id);
			$btn_text = get_field('cta_section_email_txt', $id);
			$at = strpos($btn, '@');
			$username = substr($btn, 0, $at);
			$domain = substr($btn, $at + 1);

			if ($btn) :?>
				<a class="links-list-image__btn btn btn--black btn-cta"
					 href="#"><?php echo $btn_text ? $btn_text : $btn; ?></a>
			<?php endif;
		endif; ?>
	</div>
</section>
