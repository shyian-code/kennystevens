<?php
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

<?php if (have_rows('boxes')) : ?>

	<div class="box-titles-txt-link"<?php echo $offset_style; ?>>
		<div class="box-titles-txt-link__row">
			<?php while (have_rows('boxes')) : the_row();
				$title = get_sub_field('title');
				$subtitle = get_sub_field('subtitle');
				$text = get_sub_field('text');
				$link = get_sub_field('link');
				$col_top_offset = get_sub_field('col_top_offset');
				$move_speed = get_sub_field('move_speed');
				if ($move_speed == 0) {
					$move_attr = '';
				} else {
					$move_attr = ' data-move-speed="' . $move_speed . '" ';
				}

				if ($col_top_offset) {
					$col_offset_style = ' style="padding-top: ' . $col_top_offset . 'px;"';
					$col_offset_class = ' box-titles-txt-link__col--offset';

				} else {
					$col_offset_style = '';
					$col_offset_class = '';
				}

				?>
				<div class="box-titles-txt-link__col<?php echo $col_offset_class; ?>"<?php echo $col_offset_style; ?>>
					<div class="box box-titles-txt-link__box"<?php echo $move_attr; ?>>
						<?php if ($title || $text || $subtitle) :
							kennystevens_title_text();
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
	</div>
<?php endif;
