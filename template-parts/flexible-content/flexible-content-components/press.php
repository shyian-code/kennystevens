<?php
$image = get_sub_field('image');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle_before');
$text = get_sub_field('text');
$button_text = get_sub_field('button_text');
$pdf_or_link = get_sub_field('pdf_or_link');
if ($pdf_or_link == 'pdf') {
	$link = get_sub_field('pdf');
} else {
	$link = get_sub_field('link');
}
$top_offset = get_sub_field('section_top_offset');
$bottom_offset = get_sub_field('section_bottom_offset');

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

?>

<div class="cols-img-press cols-img-txt" <?php echo $offset_style; ?>>
	<div class="cols-img-txt__row">
		<div class="cols-img-txt__col">
			<?php if ($image) : ?>
				<div class="cols-img-txt__img-wrapper">
					<img src="<?php echo $image["url"]; ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="cols-img-txt__col cols-img-txt__text">
			<?php if ($subtitle || $title || $text ) :
				kennystevens_title_text('cols-img-txt__', 'title');
			endif; ?>
			<?php if ($link) : ?>
				<a class="btn btn--black" href="<?php echo $link; ?>" target="_blank">
					<?php echo $button_text; ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>
