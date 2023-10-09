<?php
$show = get_sub_field('show');
$btn_type = get_sub_field('links_list_btn_type');

if ($show == 'preset') {
	$id = 'options';
	$image = get_field('links_list_image', $id);
	$title = get_field('links_list_title', $id);
} else {
	$id = get_the_ID();
	$image = get_sub_field('links_list_image', $id);
	$title = get_sub_field('links_list_title', $id);
}
?>

<div class="links-list-image">
	<div class="links-list-image__row">
		<div class="links-list-image__col">
			<?php if ($title) : ?>
				<h2 class="links-list-image__title"><?php echo $title; ?></h2>
			<?php endif; ?>

			<?php if (have_rows('links_list', $id)) : ?>
				<?php while (have_rows('links_list', $id)) : the_row();
					if ($show != 'preset') {
						$title = get_sub_field('title', $id);
						$link = get_sub_field('link', $id);
					} else {
						$title = get_sub_field('title', $id);
						$link = get_sub_field('link', $id);
					}
					?>
					<div class="links-list-image__link-wrapper">
						<h5 class="links-list-image__title-sm"><?php echo $title; ?></h5>
						<?php if ($link) : ?>
							<a class="links-list-image__link" href="<?php echo $link["url"]; ?>"
								 title="<?php echo $link["title"]; ?>"
								 target="<?php echo $link["target"]; ?>"><?php echo $link["title"]; ?></a>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php if ($show == 'preset') :
				$id = 'options';
				$btn = get_field('links_list_btn', $id);
				$btn_text = get_field('links_list_btn_txt', $id);
				$at = strpos($btn, '@');
				$username = substr($btn, 0, $at);
				$domain = substr($btn, $at + 1);

				if ($btn) :?>
					<a class="links-list-image__btn btn btn--black btn-cta"
						 href="#"><?php echo $btn_text ? $btn_text : $btn; ?></a>
				<?php endif;
			endif; ?>
			<?php if ($show != 'preset') :
				$id = get_the_ID();
				$btn = get_sub_field('links_list_btn', $id);
				$btn_text = get_sub_field('links_list_btn_txt', $id);

				if ($btn) :
					if ($btn_type == 'custom') :?>
						<a class="btn btn--black" href="<?php echo $link["url"]; ?>"
							 title="<?php echo $link["title"]; ?>"
							 target="<?php echo $link["target"]; ?>"><?php echo $link["title"]; ?></a>
					<?php else :
						$id = 'options';
						$btn = get_field('links_list_btn', $id);
						$btn_text = get_field('links_list_btn_txt', $id);
						$at = strpos($btn, '@');
						$username = substr($btn, 0, $at);
						$domain = substr($btn, $at + 1);

						if ($btn) :?>
							<a class="links-list-image__btn btn btn--black btn-cta"
								 href="#"><?php echo $btn_text ? $btn_text : $btn; ?></a>
						<?php endif;
					endif;
				endif;
			endif; ?>
		</div>
		<div class="links-list-image__col links-list-image__img-wrapper">
			<img class="links-list-image__img" src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>">
			<div class="links-list-image__bg" <?php echo kennystevens_bg_style($image["url"]); ?>></div>
		</div>
	</div>
