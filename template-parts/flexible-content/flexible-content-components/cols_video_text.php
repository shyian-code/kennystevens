<?php
$video = get_sub_field('video');
$vimeo_video_or_virtual_walkthrough_embed = get_sub_field('vimeo_video_or_virtual_walkthrough_embed');
$virtual_walkthrough_embed_code = get_sub_field('virtual_walkthrough_embed_code');
$title = get_sub_field('title');
$text = get_sub_field('text');
$link = get_sub_field('link');
$top_offset = get_sub_field('top_offset');
$bottom_offset = get_sub_field('bottom_offset');

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

<div class="cols-img-txt"<?php echo $offset_style; ?>>
	<div class="cols-img-txt__row">
		<div class="cols-img-txt__col">

			<?php if ($vimeo_video_or_virtual_walkthrough_embed == 'vimeo_video') : ?>
				<iframe src="https://player.vimeo.com/video/<?php echo $video; ?>?color=ffffff&title=0&byline=0&portrait=0" width="100%" height="1000" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
				<style>
				.cols-img-txt__col iframe{
					width: 100%;
				}
				@media(min-width: 640px){
					.cols-img-txt__col iframe{
						height: 175px;
					}
				}
				@media(min-width: 940px){
					.cols-img-txt__col iframe{
						height: 250px;
					}
				}
				@media(min-width: 1100px){
					.cols-img-txt__col iframe{
						height: 300px;
					}
				}
				@media(min-width: 1400px){
					.cols-img-txt__col iframe{
						height: 327px;
					}
				}
				</style>
			<?php endif; ?>
			<?php if ($vimeo_video_or_virtual_walkthrough_embed == 'virtual_walkthrough_embed') : ?>
				<?php if ($virtual_walkthrough_embed_code) : ?>
					<?php echo $virtual_walkthrough_embed_code; ?>
					<style>
					.cols-img-txt__col iframe{
						width: 100%;
					}
					@media(min-width: 640px){
						.cols-img-txt__col iframe{
							height: 218px;
						}
					}
					@media(min-width: 940px){
						.cols-img-txt__col iframe{
							height: 273px;
						}
					}
					@media(min-width: 1100px){
						.cols-img-txt__col iframe{
							height: 332px;
						}
					}
					</style>
				<?php endif; ?>
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
