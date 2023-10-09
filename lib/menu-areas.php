<?php
/**
 * Register navigation menus
 *
 * @link https://codex.wordpress.org/Function_Reference/register_nav_menus
 */
add_action('after_setup_theme', 'register_theme_menus');
function register_theme_menus()
{
	register_nav_menus(array(
		'primary_left' => __('Header Left Menu', THEME_TD),
		'primary_right' => __('Header Right Menu', THEME_TD),
		'language_switcher_menu' => __('Language Switcher Menu', THEME_TD),
		'mobile_menu' => __('Mobile Menu', THEME_TD),
		'social_menu' => __('Social Menu', THEME_TD)
	));
}
