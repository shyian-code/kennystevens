<?php
/**
 * Enqueue all styles and scripts.
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style}
 */
if (!function_exists('kennystevens_scripts')) :
	function kennystevens_scripts()
	{
		//avoid bugs with watcher and foundation mediaquery.js
		if (getenv('APP_ENV') == 'development') {
			wp_enqueue_style('foundation', 'https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.4-rc1/css/foundation.min.css', false, null, 'all');
		}
		// Enqueue the main Stylesheet.
		wp_enqueue_style('main-stylesheet', asset_path('styles/main.css'), false, null, 'all');

		// Deregister the jquery version bundled with WordPress.
		//wp_deregister_script('jquery');

		//Google Maps
		$key = get_field('google_maps_api_key', 'options');
		wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . $key);

		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
		//wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-1.9.1.min.js', array(), '1.9.1', false);

		// Enqueue the main JS file.
		wp_enqueue_script('kennystevens_scripts', asset_path('scripts/main.js'), array('jquery'), null, true);

		// Throw variables from back to front end.
		$btn = get_field('links_list_btn', 'options');
		$popup_appear_time = get_field('popup_appear_time', 'options');
		$popup_hide_for = get_field('popup_hide_for', 'options');
		$marker_pin =  get_field('google_maps_pin_icon', 'options');

		switch ($popup_hide_for) :
			case 'minutes' :
				$popup_hide_for_minutes = get_field('popup_hide_for_minutes', 'options');
				$popup_hide_for_hours = '0';
				$popup_hide_for_days = '0';
				break;
			case 'hours' :
				$popup_hide_for_minutes = '0';
				$popup_hide_for_hours = get_field('popup_hide_for_hours', 'options');
				$popup_hide_for_days = '0';
				break;
			case 'days' :
				$popup_hide_for_minutes = '0';
				$popup_hide_for_hours = '0';
				$popup_hide_for_days = get_field('popup_hide_for_days', 'options');
				break;
			default:
				$popup_hide_for_minutes = '0';
				$popup_hide_for_hours = '0';
				$popup_hide_for_days = '0';
				break;
		endswitch;

		if ($btn) {
			$at = strpos($btn, '@');
			$username = substr($btn, 0, $at);
			$domain = substr($btn, $at + 1);
		} else {
			$username = '';
			$domain = '';
		}
		$themeVars = array(
			"adminUrl" => admin_url('admin-ajax.php', $scheme = 'http'),
			'home' => get_home_url(),
			'isHome' => is_front_page(),
			'markerPin' => $marker_pin,
			'mailtoUsername' => $username,
			'mailtoDomain' => $domain,
			'popupAppearTime' => $popup_appear_time,
			'popupHideForMinutes' => $popup_hide_for_minutes,
			'popupHideForHours' => $popup_hide_for_hours,
			'popupHideForDays' => $popup_hide_for_days,
		);
		wp_localize_script('kennystevens_scripts', 'themeVars', $themeVars);

		// Comments reply script
		if (is_singular() && comments_open()):
			wp_enqueue_script("comment-reply");
		endif;
	}

	add_action('wp_enqueue_scripts', 'kennystevens_scripts');
endif;

if (file_exists(get_template_directory() . '/feedback/feedback.php')) :
	require_once get_template_directory() . '/feedback/feedback.php';
endif;
