<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$image = get_sub_field('image');
$background = get_sub_field('background');

if ($background == 'white') {
	$color_style_class = '';
} elseif ($background == 'silver') {
	$color_style_class = ' title-txt-img-fw--silver';
} else {
	$color_style_class = ' title-txt-img-fw--dark';
}
?>

<div class="title-txt-img-fw<?php echo $color_style_class; ?>">
	<?php if ($title || $text) : ?>
		<div class="title-txt-img-fw__row--top title-text title-txt-img-fw__row">
			<?php kennystevens_title_text(); ?>
		</div>
	<?php endif; ?>
	<div class="title-txt-img-fw__row">
		<?php if ($image) : ?>
			<div class="title-txt-img-fw__img-wrap">
				<img src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>">
			</div>
		<?php endif; ?>
	</div>
</div>
