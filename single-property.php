<?php
/**
 * Single Property Page Template
 */
get_header(); ?>

<?php
$property_id = get_the_ID();
$story_description = kennystevens_address_price('property', 'property_location', 'listings_', $property_id, false, 'address');
?>
	<section class="section single-property__header">
		<div class="title-text title-text__row">
			<h1 class="title-text__title animate-up animate-up--1"><?php echo get_the_title($property_id); ?></h1>
			<?php if ($story_description) : ?>
				<?php echo $story_description; ?>
			<?php endif; ?>
		</div>
	</section>

<?php get_template_part('template-parts/hero/hero'); ?>

	<section id="main" class="page-main" role="main">

		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post();

				get_template_part('template-parts/flexible-content/flexible_content_property');

			endwhile;

		else :

			get_template_part('template-parts/content', 'none');

		endif; ?>

	</section><!-- #main -->

<?php
get_footer();
