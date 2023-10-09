<?php
$show = get_sub_field('testimonial_to_show');
$chosen_testimonial_ids_arr = get_sub_field('testimonial');
$testimonial_bg_img = get_sub_field('testimonials_bg_img');
$main_testimonial_ids_arr = get_field('testimonials_main', 'options');
$default_testimonial_bg_img = get_field('testimonials_bg_img', 'options');

if ($show == 'main') {
	$testimonials_arr = $main_testimonial_ids_arr;
} else {
	$testimonials_arr = $chosen_testimonial_ids_arr;
}

if ($testimonial_bg_img) {
	$image = $testimonial_bg_img;
} else {
	$image = $default_testimonial_bg_img;
}

if (count($testimonials_arr) > 1) {
	$slider_class = 'bg-img-text__slider ';
} else {
	$slider_class = '';
}
?>

<section class="bg-img-text">
	<div class="bg-img-text__bg" <?php echo kennystevens_bg_style($image); ?>></div>
	<div class="<?php echo $slider_class; ?>bg-img-text__row">
		<?php foreach ($testimonials_arr as $testimonial_id) : ?>
			<div class="bg-img-text__text-wrapper">
				<div class="bg-img-text__text">
					<?php echo apply_filters('the_content', get_post_field('post_content', $testimonial_id)); ?>
				</div>
				<p class="bg-img-text__author">- <?php echo get_the_title($testimonial_id); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
