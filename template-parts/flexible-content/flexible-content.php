<?php if (have_rows('flexible_content')) : ?>
	<?php while (have_rows('flexible_content')) : the_row(); ?>
		<?php switch (get_row_layout()) :
			case 'boxes_titles_txt_btn': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/boxes_titles_txt_btn'); ?>
				</section>
				<?php break; ?>
			<?php case 'boxes_heading_icons_txt': ?>
				<?php get_template_part('/template-parts/flexible-content/flexible-content-components/boxes_heading_icons_txt'); ?>
				<?php break; ?>
			<?php case 'cols_image_text': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/cols_image_text'); ?>
				</section>
				<?php break; ?>
			<?php case 'cols_links_image': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/cols_links_image'); ?>
				</section>
				<?php break; ?>
			<?php case 'cols_property_details': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/cols_property_details'); ?>
				</section>
				<?php break; ?>
			<?php case 'properties': ?>
				<?php get_template_part('/template-parts/flexible-content/flexible-content-components/properties'); ?>
				<?php break; ?>
                <?php case 'shortcode_field': ?>
				<?php get_template_part('/template-parts/flexible-content/flexible-content-components/shortcode_field'); ?>
				<?php break; ?>
			<?php case 'map': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/map'); ?>
				</section>
				<?php break; ?>
			<?php case 'success_stories': ?>
				<?php get_template_part('/template-parts/flexible-content/flexible-content-components/success_stories'); ?>
				<?php break; ?>
			<?php case 'team_members': ?>
				<?php get_template_part('/template-parts/flexible-content/flexible-content-components/team_members'); ?>
				<?php break;
			case 'testimonials': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/testimonials'); ?>
				</section>
				<?php break;
			case 'title_txt_img_fw': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/title_txt_img_fw'); ?>
				</section>
				<?php break;
			case 'press': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/press'); ?>
				</section>
				<?php break; ?>
			<?php endswitch; ?>
	<?php endwhile; ?>
<?php
endif;