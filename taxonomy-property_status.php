<?php
/**
 * The template for displaying archive pages.
 *
 */

get_header(); ?>

<?php //get_template_part('template-parts/hero/hero'); ?>

	<section id="main" class="page-main" role="main">

		<header class="section single-property__header">
			<div class="title-text title-text__row">
				<?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
			</div>
		</header>

		<?php if (have_posts()) : ?>

			<main class="image-hover-text-cols__row--no-pad image-hover-text-cols__row">

				<?php while (have_posts()) : the_post();

					get_template_part('/template-parts/content', get_post_type());

				endwhile; ?>

			</main>

		<?php else :

			get_template_part('template-parts/content', 'none');

		endif; ?>

	</section><!-- #main -->

<?php
get_footer();
