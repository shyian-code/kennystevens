<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>

</main><!-- #content -->

<footer class="footer">
	<?php
	$hide_pages_arr = get_field('footer_cta_hide', 'options');
	$curr_page_id = get_the_ID();
	if (!in_array($curr_page_id, $hide_pages_arr)) {
		get_template_part('template-parts/footer/cta-section');
	}
	?>

	<?php get_template_part('template-parts/footer/signup-section'); ?>

	<section class="footer-details">
		<div class="footer__row">
			<a class="footer__logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
				<?php
				$logo = get_field('desktop_white_logo', 'options');
				if ($logo) : ?>
					<img class="logo__img" src="<?php echo $logo; ?>"
							 alt="<?php bloginfo('name'); ?>"/>
				<?php elseif (get_header_image() && !$logo) : ?>
					<img class="logo__img" src="<?php echo get_header_image(); ?>"
							 alt="<?php bloginfo('name'); ?>"/>
				<?php else :
					bloginfo('name');
				endif; ?>
			</a>
		</div>
		<div class="footer__row">
			<?php
			$address_link = get_field('address_link', 'options');
			$address_link_title = get_field('address_link_title', 'options'); ?>
			<?php if ($address_link) : ?>
				<p class="footer__text">
				<span class="footer__text-icon">
					<i class="fa fa-map-marker"></i>
				</span>
					<a href="<?php echo $address_link["url"]; ?>"
						 title="<?php echo $address_link_title ? $address_link_title : $address_link["title"]; ?>"
						 target="<?php echo $address_link["target"]; ?>"><?php echo $address_link["title"]; ?></a>
				</p>
			<?php endif; ?>
			<?php if (have_rows('phone_numbers', 'options')) : ?>
				<p class="footer__text">
				<span class="footer__text-icon">
					<i class="fa fa-phone"></i>
				</span>
					<?php while (have_rows('phone_numbers', 'options')) : the_row();
						$phone = get_sub_field('phone', 'options');
						$phone_link_title = get_sub_field('phone_link_title', 'options');
						?>
						<?php if ($phone) : ?>
							<span class="footer__text-link">
						<a href="<?php echo $phone["url"]; ?>"
							 title="<?php echo $phone_link_title ? $phone_link_title : $phone["title"]; ?>"
							 target="<?php echo $phone["target"]; ?>">
							<?php echo $phone["title"]; ?>
						</a>
							</span>
						<?php endif; ?>
					<?php endwhile; ?>
				</p>
			<?php endif; ?>
		</div>
		<div class="footer__row">
			<?php if (has_nav_menu('social_menu')) :
				wp_nav_menu([
					'theme_location' => 'social_menu',
					'menu_class' => 'footer__social nav-social'
				]);
			endif; ?>
		</div>
		<div class="footer__row">
			<?php
			$bottom_link = get_field('footer_bottom_link', 'options');
			$bottom_image = get_field('footer_bottom_img', 'options');
			?>

			<?php if ($bottom_link) : ?>
			<a class="footer__image-link" href="<?php echo $bottom_link["url"]; ?>"
				 title="<?php echo $bottom_link["title"]; ?>"
				 target="<?php echo $bottom_link["target"]; ?>">
				<?php endif; ?>
				<?php if ($bottom_image) : ?>
					<img src="<?php echo $bottom_image["url"]; ?>" alt="<?php echo $bottom_image["alt"]; ?>">
				<?php endif; ?>
				<?php if ($bottom_link) : ?>
			</a>
		<?php endif; ?>
		</div>
		<div class="footer__row">
			<p class="copyright">
				<?php
				$c_text = get_field('copyright_text', 'options');
				$c_link = get_field('copyright_link', 'options'); ?>
				<span
					class="copyright__item"><?php echo '&copy;&#160;' . ($c_text ? $c_text : 'Copyright') . '&#160;' . date("Y") . '&#160;|&#160;'; ?></span>
				<?php if ($c_link) : ?>
					<a class="copyright__item" href="<?php echo $c_link["url"]; ?>"
						 title="<?php echo $c_link["title"]; ?>"
						 target="<?php echo $c_link["target"]; ?>"><?php echo $c_link["title"]; ?></a>
				<?php endif; ?>
			</p>
		</div>
		<?php 
			$legal_copy_text = get_field('legal_copy_text', 'options'); 
			if($legal_copy_text){ ?>
			<div class="footer__row">
				<div class="legal_copy"><?php echo $legal_copy_text; ?></div>
			</div>
		<?php } ?>
	</section>
</footer>

<?php wp_footer(); ?>
</body>
</html>
