<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$embed_code = get_sub_field('embed_code');

?>

<div class="title-txt-img-fw">
	<?php if ($title || $text) : ?>
		<div class="title-txt-img-fw__row--top title-text title-txt-img-fw__row">
			<?php kennystevens_title_text(); ?>
		</div>
	<?php endif; ?>
	<div class="title-txt-img-fw__row">
		<?php if ($embed_code) : ?>
			<?php echo $embed_code; ?>
		<?php endif; ?>
	</div>
</div>
