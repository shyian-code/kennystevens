<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$fw_bg_img = get_sub_field('fw_bg_img');
$fw_bg_img_height = get_sub_field('fw_bg_img_height');

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
<div class="box-heading-icon-txt"<?php echo $offset_style; ?>>
	<?php
	if ($fw_bg_img) : ?>
		<div class="page-main__bg" <?php echo kennystevens_bg_style($fw_bg_img); ?>>
			<?php if ($fw_bg_img_height) : ?>
				<style>
					.page-main__bg {
						height: <?php echo $fw_bg_img_height; ?>px;
					}
				</style>
			<?php endif; ?>
		</div>
	<?php endif;
	?>
	<?php if ($title || $text) : ?>
		<section class="section">
			<div class="box-heading-icon-txt__row--top title-text box-heading-icon-txt__row">
				<?php kennystevens_title_text('box-heading-icon-txt__', 'all'); ?>
			</div>
		</section>
	<?php endif; ?>
	<?php if (have_rows('boxes')) : ?>
		<section class="section">
			<div class="rolling-numbers-cols box-heading-icon-txt__row">
				<?php while (have_rows('boxes')) : the_row();
					$type = get_sub_field('type');
					$box_title = get_sub_field('title');
					$box_subtitle = get_sub_field('subtitle');
					$box_text = get_sub_field('text');
					$col_top_offset = get_sub_field('col_top_offset');
					$move_speed = get_sub_field('move_speed');
					if ($move_speed == 0) {
						$move_attr = '';
					} else {
						$move_attr = ' data-move-speed="' . $move_speed . '" ';
					}

					if ($col_top_offset) {
						$col_offset_style = ' style="padding-top: ' . $col_top_offset . 'px;"';
						$col_offset_class = ' box-heading-icon-txt__col--offset';

					} else {
						$col_offset_style = '';
						$col_offset_class = '';
					}

					$titles_align = get_sub_field('titles_align');
					if ($titles_align == 'center') {
						$titles_align_class = 'box--center';
					} else {
						$titles_align_class = '';
					}

					if ($type == 'rolling') {
						$rolling_col_class = ' rolling-numbers-cols__col';
					} else {
						$rolling_col_class = '';
					}
					?>
					<div
						class="box-heading-icon-txt__col<?php echo $col_offset_class . $rolling_col_class; ?>"<?php echo $col_offset_style; ?>>
						<div class="box box-heading-icon-txt__box <?php echo $titles_align_class; ?>"<?php echo $move_attr; ?>>
							<?php switch ($type) :
								case ('icon') :
									$icon = get_sub_field('icon');
									if ($icon) :?>
										<div class="box-heading-icon-txt__img-wrapper">
											<img src="<?php echo $icon["url"]; ?>"
													 alt="<?php echo $icon["alt"]; ?>">
										</div>
									<?php endif;
									break;
								case ('rolling') :
									$number = get_sub_field('number');
									$number_after = get_sub_field('number_txt');
									if ($number) : ?>
										<div class="box-heading-icon-txt__img-wrapper">
											<p class="box-heading-icon-txt__box-txt-wrap">
										<span class="box-heading-icon-txt__box-txt rolling-numbers-cols__number"
													data-number="<?php echo $number; ?>">0</span><?php if ($number_after) : ?>
													<span class="box-heading-icon-txt__box-txt"><?php echo $number_after; ?></span><?php endif; ?>
											</p>
										</div>
									<?php endif;
									break;
								case ('text') :
									$text = get_sub_field('text_type');
									if ($text) :?>
										<div class="box-heading-icon-txt__img-wrapper">
											<p class="box-heading-icon-txt__box-txt-wrap">
												<span class="box-heading-icon-txt__box-txt"><?php echo $text; ?></span>
											</p>
										</div>
									<?php endif;
									break;
							endswitch; ?>
							<?php if ($box_title || $box_text || $box_subtitle) :
								kennystevens_title_text('box-heading-icon-txt__box-', 'all', 'h3', 'h5');
							endif; ?>
							<?php if ($link) : ?>
								<a class="btn btn--theme"
									 href="<?php echo $link["url"]; ?>"
									 title="<?php echo $link["title"]; ?>"
									 target="<?php echo $link["target"]; ?>"><?php echo $link["title"] ? $link["title"] : __('Learn more'); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
	<?php endif; ?>
</div>
