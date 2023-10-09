<?php
/**
 * Single Success Story Page Template
 */
get_header(); ?>

<?php get_template_part('template-parts/hero/hero'); ?>

	<section id="main" class="page-main" role="main">

		<?php get_template_part('template-parts/parts/page-bg'); ?>

		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post();

				get_template_part('template-parts/flexible-content/flexible-content');

			endwhile;

		else :

			get_template_part('template-parts/content', 'none');

		endif; ?>

		<?php get_template_part('template-parts/parts/post-navigation'); ?>

	</section><!-- #main -->

<?php
get_footer();
