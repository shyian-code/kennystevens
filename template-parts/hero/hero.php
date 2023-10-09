<?php if (have_rows('hero_slides')) :
	$cur_page_id = get_the_ID();
	$slider_repeater = get_field('hero_slides');
	$rows_count = count($slider_repeater);
	if ($rows_count > 1) {
		$slider_class = ' hero-slider';
		$bg_layer_active = '';
		$txt_left_one_slide = '';
		$txt_bottom_one_slide = '';
	} else {
		$slider_class = '';
		$bg_layer_active = ' hero__bg-layer--one-slide';
		$txt_left_one_slide = ' hero__text-left--one-slide';
		$txt_bottom_one_slide = ' hero__text-bottom--one-slide';
	}
	?>
	<section class="load-later hero<?php echo $slider_class; ?>">
		<?php $i = 0; ?>
		<?php while (have_rows('hero_slides')) : the_row();
			$bottom_box_show = get_sub_field('bottom_box_show');
			$bottom_box_bg_color = get_sub_field('bottom_box_bg_color');
			$bottom_box_title = get_sub_field('bottom_box_title');
			$bottom_box_subtitle = get_sub_field('bottom_box_subtitle');
			$bottom_box_text = get_sub_field('bottom_box_text');
			$bottom_box_link = get_sub_field('bottom_box_button');
			$left_box_show = get_sub_field('left_box_show');
			$left_box_text_above = get_sub_field('left_box_text_above');
			$left_box_title = get_sub_field('left_box_title');
			$left_box_subtitle = get_sub_field('left_box_subtitle');
			$left_box_text = get_sub_field('left_box_text');
			$make_this_image_half_height = get_sub_field('make_this_image_half_height');
			$image_or_video = get_sub_field('image_or_video');
			$video = get_sub_field('video');

			if ($bottom_box_bg_color == 'theme') {
				$bottom_box_color_class_flag = '--white';
			} else {
				$bottom_box_color_class_flag = '--theme';
			}

			if (($bottom_box_show == true) && ($bottom_box_title || $bottom_box_subtitle || $bottom_box_text || $bottom_box_link)) {
				$bottom_box_layer_class_flag = '--bigger';
				$bg_class = '';
				$bg_layer_class = '';
			} else {
				$bottom_box_layer_class_flag = '';
				$bg_class = ' hero__bg--height';
				$bg_layer_class = ' hero__bg-layer--height';
			}

			if (($left_box_show == true) && ($left_box_title || $left_box_subtitle || $left_box_text || $left_box_link)) {
				$bottom_box_layer_class_flag = '--bigger';
				$bg_class = '';
				$bg_layer_class = '';
			} else {
				$bottom_box_layer_class_flag = '';
				$bg_class = ' hero__bg--height';
				$bg_layer_class = ' hero__bg-layer--height';
			}

			$property_id = get_sub_field('property');
			$hero_image = get_sub_field('hero_image');
			if ($property_id && $hero_image == 'featured') {
				$image = get_the_post_thumbnail_url($property_id);
			} else {
				$image = get_sub_field('img');
			}
			$active_label = get_field('property_listing_active_label');
			$listings_link_label = get_field('listings_link_label', 'options');
			$link_to = get_sub_field('left_box_link_to');

			if ($property_id && $link_to == 'property') {
				$left_box_link = [
					"url" => get_the_permalink($property_id),
					"title" => $listings_link_label ? $listings_link_label : 'Learn more',
					"target" => ''
				];
			} else {
				$left_box_link = get_sub_field('left_box_button');
			}

			if ($property_id) {
				$story_description = kennystevens_address_price('property', 'property_location', 'listings', $property_id);
				$story_description_show = get_sub_field('property_addr_price');
			} else {
				$story_description = kennystevens_address_price('story', 'success_story_location', 'success_stories', get_the_ID());
				$story_description_show = get_field('story_description_show', $cur_page_id);
			}

			if (($left_box_show == false) && ($bottom_box_show == false)) {
				$bg_class_height = ' hero__bg--no-text';
			} else {
				$bg_class_height = '';
			}

			if ($make_this_image_half_height == true) {
				$bg_class_half_or_full = ' half-height';
			} else {
				$bg_class_half_or_full = '';
			}

			if (($left_box_show == true) && ($bottom_box_show == true)) {
				$bg_layer_all_txt_class = ' hero__bg-layer--smaller';
			} else {
				$bg_layer_all_txt_class = '';
			}

			?>
			<div class="hero__slide">
				<div class="hero__row">
					<?php if ($image_or_video == 'video' && $video) : ?>
						<div class="image-bg hero__bg<?php echo $bg_class . $bg_class_height . $bg_class_half_or_full; ?>">
							<div class="vimeo-wrapper" style="background-size: cover; background-image: url(<?php echo get_sub_field('img');?>);">
							   <iframe src="https://player.vimeo.com/video/<?php echo $video; ?>?background=1&autoplay=1&loop=1&byline=0&title=0"
							           frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							</div>
							<style>
							.image-bg{
								padding: 0;
							}
							.vimeo-wrapper {
								position: relative;
							  top: 0;
							  left: 0;
							  width: 100%;
							  height: calc(100% + 145px);
							  /* z-index: -1; */
							  pointer-events: none;
							  overflow: hidden;
								transform: scale(0.95);
							}
							.vimeo-wrapper iframe {
								width: 100vw;
								height: 56.25vw; /* Given a 16:9 aspect ratio, 9/16*100 = 56.25 */
								min-height: 100vh;
								min-width: 177.77vh; /* Given a 16:9 aspect ratio, 16/9*100 = 177.77 */
								position: absolute;
								top: 50%;
								left: 50%;
								transform: translate(-50%, -50%);
							}
							</style>
						</div>
					<?php endif; ?>
					<?php if ( ($image_or_video == 'image' || !$image_or_video) && $image) : ?>
						<div class="hero__bg<?php echo $bg_class . $bg_class_height . $bg_class_half_or_full; ?>">
							<div <?php echo kennystevens_bg_style($image); ?>
									class="load-img hero__bg-layer hero__bg-layer<?php echo $bottom_box_layer_class_flag . $bg_layer_all_txt_class. $bg_layer_class . $bg_layer_active; ?>"></div>


						</div>
						<?php if (($left_box_show == true) && ($left_box_title || $left_box_subtitle || $left_box_text || $left_box_link)) :
								$bottom_txt_class = ' hero__text-bottom--mobile';
								?>
								<div class="hero__text-left hero__text-left_new text-box text-box--theme<?php echo $txt_left_one_slide; ?>">
									<div class="left_content_text">
										<?php if ($left_box_text_above == true && $active_label) :
											if ($i == 0) {
												$h_above_tag = '1';
											} else {
												$h_above_tag = '2';
											}
											?>
											<h<?php echo $h_above_tag; ?>
												class="text-box__text-above"><?php echo $active_label; ?></h<?php echo $h_above_tag; ?>>
										<?php endif; ?>
										<?php if ($left_box_title) :
											if ($left_box_text_above == false) {
												if (!$bottom_box_title) {
													if ($i == 0) {
														$h_left_tag = '1';
													} else {
														$h_left_tag = '2';
													}
												} else {
													$h_left_tag = '2';
												}
											} else {
												if ($active_label) {
													$h_left_tag = '2';
												} else {
													if (!$bottom_box_title) {
														if ($i == 0) {
															$h_left_tag = '1';
														} else {
															$h_left_tag = '2';
														}
													} else {
														$h_left_tag = '2';
													}
												}
											}

											?>
											<h<?php echo $h_left_tag; ?>
												class="text-box__title text-box__title--theme"><?php echo $left_box_title; ?></h<?php echo $h_left_tag; ?> >
										<?php endif; ?>
										<?php if ($left_box_subtitle) : ?>
											<h3 class="text-box__subtitle text-box__subtitle--theme"><?php echo $left_box_subtitle; ?></h3>
										<?php endif; ?>
										<?php if ($story_description && ($story_description_show == true)) : ?>
											<?php echo $story_description; ?>
										<?php endif; ?>
										<?php if ($left_box_text) : ?>
											<div class="text-box__text text-content text-content--theme"><?php echo $left_box_text; ?></div>
										<?php endif; ?>
									</div>
									<?php if ($left_box_link) : ?>
										<div class="left_content_link">
											<a class="hero__btn btn btn--theme" href="<?php echo $left_box_link["url"]; ?>"
											 title="<?php echo $left_box_link["title"]; ?>"
											 target="<?php echo $left_box_link["target"]; ?>"><?php echo $left_box_link["title"]; ?></a>
										</div>
									<?php endif; ?>
								</div>
							<?php else :
								$bottom_txt_class = '';
							endif; ?>
					<?php endif; ?>
					<?php if (($bottom_box_show == true) && ($bottom_box_title || $bottom_box_subtitle || $bottom_box_text || $bottom_box_link)) : ?>
						<div class="hero__text-bottom text-box text-box<?php echo $bottom_box_color_class_flag . $bottom_txt_class . $txt_bottom_one_slide; ?>">
							<?php if ($bottom_box_title) :
								if ($i == 0) {
									$h_tag = '1';
								} else {
									$h_tag = '2';
								} ?>
								<h<?php echo $h_tag; ?>
									class="text-box__title text-box__title<?php echo $bottom_box_color_class_flag; ?>"><?php echo $bottom_box_title; ?></h<?php echo $h_tag; ?>>
							<?php endif; ?>
							<?php if ($bottom_box_subtitle) : ?>
								<h3
									class="text-box__subtitle text-box__subtitle<?php echo $bottom_box_color_class_flag; ?>"><?php echo $bottom_box_subtitle; ?></h3>
							<?php endif; ?>
							<?php if ($bottom_box_text) : ?>
								<div
									class="text-box__text text-content text-content<?php echo $bottom_box_color_class_flag; ?>"><?php echo $bottom_box_text; ?></div>
							<?php endif; ?>
							<?php if ($bottom_box_link) : ?>
								<a class="hero__btn btn btn<?php echo $bottom_box_color_class_flag; ?>"
									 href="<?php echo $bottom_box_link["url"]; ?>"
									 title="<?php echo $bottom_box_link["title"]; ?>"
									 target="<?php echo $bottom_box_link["target"]; ?>"><?php echo $bottom_box_link["title"]; ?></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php $i++; ?>
		<?php endwhile; ?>
	</section>
<?php endif; ?>


<style>
	.hero__text-left.hero__text-left_new {
		display: flex;
		align-items: center;
		justify-content: space-between;
		flex-wrap: wrap;
		flex-direction: row;
	}
	.left_content_link .hero__btn {
		margin-top: 0;
	}
	.hero__text-left.hero__text-left_new {
		/*margin-top:145px;*/
	}
	.hero__text-left.hero__text-left_new .left_content_text {
		width: 100%;
	}
	@media print,
	screen and (min-width: 40em) {
		.hero__text-left.hero__text-left_new {
			/*margin-top:145px;*/
		}
		.hero__text-left.hero__text-left_new .left_content_text {
			width: 50%;
		}
	}
</style>
