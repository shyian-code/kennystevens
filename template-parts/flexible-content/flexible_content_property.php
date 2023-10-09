<?php if (have_rows('flexible_content_property')) : ?>
	<?php while (have_rows('flexible_content_property')) : the_row(); ?>
		<?php switch (get_row_layout()) :
			case 'boxes_titles_txt_btn': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/boxes_titles_txt_btn'); ?>
				</section>
				<?php break;
			case 'boxes_heading_icons_txt': ?>
				<?php get_template_part('/template-parts/flexible-content/flexible-content-components/boxes_heading_icons_txt'); ?>
				<?php break;
			case 'cols_image_text': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/cols_image_text'); ?>
				</section>
				<?php break;
			case 'cols_video_text': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/cols_video_text'); ?>
				</section>
				<?php break;
			case 'cols_links_image': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/cols_links_image'); ?>
				</section>
				<?php break;
			case 'photo_email_phone': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/photo_email_phone'); ?>
				</section>
				<?php break;
			case 'properties': ?>
				<?php get_template_part('/template-parts/flexible-content/flexible-content-components/properties'); ?>
				<?php break;
			case 'property_details': ?>
				<section class="section">
					<?php get_template_part('/template-parts/flexible-content/flexible-content-components/property_details'); ?>
				</section>
				<?php break;
			case 'related_properties': ?>
				<section class="section">
					<?php get_template_part('template-parts/flexible-content/flexible-content-components//related_posts'); ?>
				</section>
				<?php break;
			case 'success_stories': ?>
				<?php get_template_part('/template-parts/flexible-content/flexible-content-components/success_stories'); ?>
				<?php break;
			case 'team_members': ?>
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
			case 'virtual_walkthrough': ?>
			<section class="section">
				<?php get_template_part('/template-parts/flexible-content/flexible-content-components/virtual_walkthrough'); ?>
			</section>
			  <?php break;
		endswitch; ?>
	<?php endwhile; ?>
<?php endif;
