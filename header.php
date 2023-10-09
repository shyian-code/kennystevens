<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php wp_head(); ?>
	<?php if (is_page_template("page-templates/thank-you.php")) : ?>
		<meta name="robots" content="noindex"/>
	<?php endif; ?>
</head>

<body <?php body_class(); ?>>

<header class="header">
	<?php if (!get_field('display_top_bar') || get_field('display_top_bar') == true) { ?>
		<?php
			if (get_field('top_bar_background_color')){
				$topbarbgcolor = get_field('top_bar_background_color');
			} else {
				$topbarbgcolor = get_field('top_bar_background_color', 'option');
			}
			if (get_field('top_bar_text_color')){
				$topbartextcolor = get_field('top_bar_text_color');
			} else {
				$topbartextcolor = get_field('top_bar_text_color', 'option');
			}

			if (get_field('top_bar_text')){
				$topbartext = get_field('top_bar_text');
			} else {
				$topbartext = get_field('top_bar_text', 'option');
			}

			if (get_field('top_bar_button_link')){
				$topbarbuttonlink = get_field('top_bar_button_link');
			} else {
				$topbarbuttonlink = get_field('top_bar_button_link', 'option');
			}

			if (get_field('top_bar_text_color')){
				$topbarbuttontext = get_field('top_bar_button_text');
			} else {
				$topbarbuttontext = get_field('top_bar_button_text', 'option');
			}

		?>
		<div class="top-bar" style="background-color: <?php echo $topbarbgcolor; ?>; color:<?php echo $topbartextcolor; ?>; padding: 8px;">
			<div class="top-bar__row" style="display: flex; justify-content: center; align-items: center;">
				<h6 id="top-bar-text" style="padding-right: 25px; font-size: 16px; font-weight: 300;"><?php echo $topbartext; ?></h6>
				<a class="btn" style="padding: 4px 20px; font-size: 16px; font-weight: 300; letter-spacing: 0; border-color: <?php echo $topbartextcolor; ?>" href="<?php echo $topbarbuttonlink; ?>"><?php echo $topbarbuttontext; ?></a>
			</div>
			<style>
				@media(max-width: 768px){
					#top-bar-text{
						flex: 1;
					}
				}
			</style>
		</div>
	<?php } ?>
	<nav class="nav-primary header__nav header__row">

		<?php
		if (has_nav_menu('primary_left')) :
			wp_nav_menu([
				'theme_location' => 'primary_left',
				'menu_id' => 'primary-menu-left',
				'container' => false,
				'menu_class' => 'nav-primary__menu nav-primary__menu--desktop menu',
				'items_wrap' => '<ul id="%1$s" class="%2$s" data-disable-hover="true" data-dropdown-menu data-alignment="left">%3$s</ul>',
				'walker' => new kennystevens_navwalker()
			]);
		endif;
		?>

		<a class="header__brand" href="<?php echo esc_url(home_url()); ?>">
			<?php
			$mobile_logo = get_field('mobile_logo', 'options');
			if ($mobile_logo) : ?>
				<img class="header__brand--mobile" src="<?php echo $mobile_logo; ?>" alt="<?php bloginfo('name'); ?>"/>
			<?php elseif (get_header_image() && !$mobile_logo) : ?>
				<img class="header__brand--mobile" src="<?php echo(get_header_image()); ?>" alt="<?php bloginfo('name'); ?>"/>
			<?php else :
				bloginfo('name');
			endif; ?>
			<?php
			if (get_header_image()) : ?>
				<img class="header__brand--desktop" src="<?php echo(get_header_image()); ?>" alt="<?php bloginfo('name'); ?>"/>
			<?php else :
				bloginfo('name');
			endif; ?>
		</a><!-- /.brand -->

		<?php if (has_nav_menu('primary_right')) :
			wp_nav_menu([
				'theme_location' => 'primary_right',
				'menu_id' => 'primary-menu-right',
				'container' => false,
				'menu_class' => 'nav-primary__menu nav-primary__menu--desktop menu',
				'items_wrap' => '<ul id="%1$s" class="%2$s" data-disable-hover="true" data-dropdown-menu data-alignment="left">%3$s</ul>',
				'walker' => new kennystevens_navwalker()
			]);
		endif; ?>

		<?php
		if (has_nav_menu('mobile_menu')) : ?>
			<div class="nav-primary__menu--mobile">
				<?php wp_nav_menu([
					'theme_location' => 'mobile_menu',
					'menu_id' => 'mobile-menu',
					'container' => false,
					'menu_class' => 'nav-primary__menu menu',
				]); ?>
				<ul class="nav-primary__menu menu mobile-language-switcher">
					<li class="menu-item menu-item-has-children menu-item-gtranslate">
						<?php echo do_shortcode('[gtranslate]'); ?>
					</li>
				</ul>
			</div>
		<?php endif; ?>

		<?php $link = get_field('mobile_header_link', 'options'); ?>
		<?php if ($link) : ?>
			<div class="header__btn header__btn--mobile">
				<a class="btn btn--black" href="<?php echo $link["url"]; ?>"
					 title="<?php echo $link["title"]; ?>"
					 target="<?php echo $link["target"]; ?>"><?php echo $link["title"]; ?></a>
			</div>
		<?php endif; ?>

		<div class="hamburger">
			<button class="menu-btn" id="mobile-menu-btn" type="button">
				<span class="menu-btn__i menu-btn__i--t"></span>
				<span class="menu-btn__i menu-btn__i--m"></span>
				<span class="menu-btn__i menu-btn__i--b"></span>
			</button>
		</div>
	</nav><!-- /.header__row -->
</header><!-- /.header -->
<main id="content" class="site-content animate-sections">
	<?php
	$show_form_global = get_field('popup_show', 'options');
	$show_form_popup = get_field('show_form_popup');
	$show_form_popup_property = get_field('show_form_popup_property');

	if (is_singular('property')) {
		$show_popup = $show_form_popup_property;
	} else {
		$show_popup = $show_form_popup;
	}

	if ($show_form_global == true) :
	if ($show_popup == true) : ?>
	<div class="popup-form">
		<div class="download-form download-form--popup">
			<button class="popup-form__close-btn" type="button"></button>
			<?php
			$sendgrid_list = get_field('flyin_sendgrid_list', 'options');
			$download_locked = get_field('flyin_form_df', 'options');

			echo do_shortcode('[dlm_gf_form gf_field_values="sendgrid_list=sendgrid_list_' . $sendgrid_list . '" gf_title="true" gf_description="true" gf_ajax="true" download_id=' . $download_locked . ']');
			?>
		</div>
	</div>
<?php
endif;
endif;