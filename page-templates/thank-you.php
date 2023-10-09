<?php
/**
 * Template Name: Thank You Page Template
 *
 */

get_header(); ?>

<?php
if (wp_get_referer()) :
	get_template_part('template-parts/hero/hero');
else : ?>
	<section id="main" class="page-main" role="main">
		<?php get_template_part('template-parts/content', 'none'); ?>
	</section>
<?php endif; ?>

	<section id="main" class="page-main" role="main">

		<?php get_template_part('template-parts/parts/page-bg'); ?>

		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post();

				get_template_part('template-parts/flexible-content/flexible-content');

			endwhile;

		else :

			get_template_part('template-parts/content', 'none');

		endif; ?>

	</section><!-- #main -->

<?php
get_footer();
