<?php
$image = get_sub_field('image');
$title = get_sub_field('title');
$text = get_sub_field('text');
$link = get_sub_field('link');
$top_offset = get_sub_field('top_offset');
$bottom_offset = get_sub_field('bottom_offset');
$whichdirection = get_sub_field('which_direction');
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
if ($whichdirection == 'textimage') {
	$flexflow = 'style="flex-flow: row-reverse;"';
} else {
	$flexflow = '';
}

?>


<div class="cols-img-txt"<?php echo $offset_style; ?>>
	<div class="cols-img-txt__row" <?php echo $flexflow; ?>>
		<div class="cols-img-txt__col">
			<style>
			@media(max-width: 640px){
				.cols-img-txt__row{
					flex-flow: row wrap!important;
				}
			}
			</style>
			<?php if ($image) : ?>
				<div class="cols-img-txt__img-wrapper">
					<img src="<?php echo $image["url"]; ?>"
							 alt="<?php echo $image["alt"]; ?>">
				</div>
			<?php endif; ?>
		</div>
		<div class="cols-img-txt__col cols-img-txt__text">
			<?php if ($title || $text) :
				kennystevens_title_text('cols-img-txt__', 'title');
			endif; ?>
			<?php if ($link) : ?>
				<a class="btn btn--black"
					 href="<?php echo $link["url"]; ?>"
					 title="<?php echo $link["title"]; ?>"
					 target="<?php echo $link["target"]; ?>"><?php echo $link["title"] ? $link["title"] : __('Learn more'); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
