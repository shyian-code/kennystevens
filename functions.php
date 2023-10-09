<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Text domain definition
 */
defined('THEME_TD') ? THEME_TD : define('THEME_TD', 'kennystevens');

// Load modules

$theme_includes = [
	'/lib/helpers.php',
	'/lib/cleanup.php',                        // Clean up default theme includes
	'/lib/enqueue-scripts.php',                // Enqueue styles and scripts
	'/lib/protocol-relative-theme-assets.php', // Protocol (http/https) relative assets path
	'/lib/framework.php',                      // Css framework related stuff (content width, nav walker class, comments, pagination, etc.)
	'/lib/theme-support.php',                  // Theme support options
	'/lib/template-tags.php',                  // Custom template tags
	'/lib/menu-areas.php',                     // Menu areas
	'/lib/widget-areas.php',                   // Widget areas
	'/lib/customizer.php',                     // Theme customizer
	'/lib/vc_shortcodes.php',                  // Visual Composer shortcodes
	'/lib/jetpack.php',                        // Jetpack compatibility file
	'/lib/acf_field_groups_type.php',          // ACF Field Groups Organizer
	'/lib/functions/title-text.php',           // Theme functions
	'/lib/functions/address-price.php',        // Theme functions
	'/lib/functions/ajax-loadmore.php',        // Theme functions
	'/lib/functions/map.php',     					   // Theme functions
];

foreach ($theme_includes as $file) {
	if (!$filepath = locate_template($file)) {
		continue;
		trigger_error(sprintf(__('Error locating %s for inclusion', THEME_TD), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);


// Theme the TinyMCE editor (Copy post/page text styles in this file)

add_editor_style('assets/dist/css/custom-editor-style.css');


// Custom CSS for the login page

function loginCSS()
{
	echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri(THEME_TD) . 'assets/dist/css/wp-login.css"/>';
}

add_action('login_head', 'loginCSS');


// Add body class for active sidebar
function wp_has_sidebar($classes)
{
	if (is_active_sidebar('sidebar')) {
		// add 'class-name' to the $classes array
		$classes[] = 'has_sidebar';
	}
	// return the $classes array
	return $classes;
}

add_filter('body_class', 'wp_has_sidebar');

// Remove the version number of WP
// Warning - this info is also available in the readme.html file in your root directory - delete this file!
remove_action('wp_head', 'wp_generator');


// Obscure login screen error messages
function wp_login_obscure()
{
	return '<strong>Error</strong>: wrong username or password';
}

add_filter('login_errors', 'wp_login_obscure');


// Disable the theme / plugin text editor in Admin
define('DISALLOW_FILE_EDIT', true);

function add_file_types_to_uploads($file_types)
{
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes);
	return $file_types;
}

add_action('upload_mimes', 'add_file_types_to_uploads');

// ACF Options Pages
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'menu_title' => 'Theme Settings',
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => true
	));
}

/**
 * Add icons to the menu
 * @param $items
 * @param $args
 * @return mixed
 */
function kennystevens_wp_nav_menu_objects($items, $args)
{
	// loop
	foreach ($items as &$item) {
		// vars
		$icon = get_field('menu_social_icon', $item);
		// append icon
		if ($icon) {
			$item->title .= ' <i class="nav-social__icon fa fa-' . $icon . '"></i>';
		}
	}
	return $items;
}

add_filter('wp_nav_menu_objects', 'kennystevens_wp_nav_menu_objects', 10, 2);

function kennystevens_bg_style($image, $style = true)
{
	if ($image) {
		if ($style == true) {
			$style = 'style="background-image: url(' . $image . ');"';
		} else {
			$style = 'background-image: url(' . $image . ');';
		}
	}
	return $style;
}

/**
 * Add automatic image sizes
 */
if (function_exists('add_image_size')) {
	add_image_size('thumbnail_wide', 580);
	add_image_size('img_side_sm', 580, 580);
	add_image_size('img_side_sm', 580, 580, true);
	add_image_size('img_side_lg', 680, 680);
	add_image_size('img_side_lg', 680, 680, true);
	add_image_size('team_member', 380, 380);
	add_image_size('team_member', 380, 380, true);
	add_image_size('success_story', 380, 240);
	add_image_size('success_story', 380, 240, true);
}

function post_remove()
{
	remove_menu_page('edit.php');
}

add_action('admin_menu', 'post_remove');

function kennystevens_curl($url, $header, $fields = '', $post = false)
{
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	if ($fields) {
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	}
	if ($post == true) {
		curl_setopt($ch, CURLOPT_POST, 1);
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_exec($ch);
	curl_close($ch);
}

add_action('gform_after_submission', 'kennystevens_post_to_third_party', 10, 2);
function kennystevens_post_to_third_party($gf_entry, $form)
{

	$form_fields = $form["fields"];
	$form_entry_email_id = '';
	$form_entry_first_name_id = '';
	$form_entry_last_name_id = '';
	$form_entry_phone_id = '';
	$form_entry_textarea_id = '';
	$form_entry_checkbox_value = '';

	foreach ($form_fields as $field) {
		if ($field->type == 'email') {
			$form_entry_email_id = $field->id;
		}
		if ($field->type == 'name') {
			$form_entry_first_name_id = $field->inputs[1]["id"];
			$form_entry_last_name_id = $field->inputs[3]["id"];
		}
		if ($field->type == 'phone') {
			$form_entry_phone_id = $field->id;
		}
		if ($field->type == 'textarea') {
			$form_entry_textarea_id = $field->id;
		}
		if ($field->type == 'checkbox') {
			$form_entry_checkbox_id = $field->id;
			$field = RGFormsModel::get_field($form, $form_entry_checkbox_id);
			$form_entry_checkbox_value = is_object($field) ? $field->get_value_export($gf_entry) : '';
		}
	}


	$form_fields_count = count($gf_entry);
	$prefix = 'sendgrid_list_';
	$prefix_len = strlen($prefix);
	$sendgrid_list_id = '';

	for ($i = 1; $i <= $form_fields_count; $i++) {
		$field_value = rgar($gf_entry, $i);
		$sl_field = strpos($field_value, $prefix);
		if ($sl_field !== false) {
			$sendgrid_list_id = substr($field_value, $prefix_len);
		}
	}

	if ($sendgrid_list_id) {
		$api_key = get_field('sendgrid_api_key', 'options');

		$recipient_id = base64_encode(rgar($gf_entry, $form_entry_email_id));

		$post_recipients_url = 'https://api.sendgrid.com/v3/contactdb/recipients';
		$post_recipients_to_list_url = 'https://api.sendgrid.com/v3/contactdb/lists/' . $sendgrid_list_id . '/recipients/' . $recipient_id;

		$header = [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $api_key,
		];

		$body = [
			[
				'first_name' => rgar($gf_entry, $form_entry_first_name_id),
				'last_name' => rgar($gf_entry, $form_entry_last_name_id),
				'email' => rgar($gf_entry, $form_entry_email_id),
				'phone' => rgar($gf_entry, $form_entry_phone_id),
				'message' => rgar($gf_entry, $form_entry_textarea_id),
				'contact_by' => $form_entry_checkbox_value,
			],
		];

		$json_data = json_encode($body);

		kennystevens_curl($post_recipients_url, $header, $json_data, false);
		kennystevens_curl($post_recipients_to_list_url, $header, '', true);
	}
}

function kennystevens_get_int_from_string($str) {
	preg_match_all('!\d+!', $str, $matches);
	$matches_str = implode('',$matches[0]);
	$result_int = intval($matches_str);
	return $result_int;
}

/**
 * Enable neighborhood query "n" in the url
 * @param $qvars
 * @return $qvars
 */
function kennystevens_accept_neighborhood_query( $qvars ) {
    $qvars[] = 'n';
    return $qvars;
}
add_filter( 'query_vars', 'kennystevens_accept_neighborhood_query' );

/**
 * Ajax: Update featured neighborhood map
 * @param
 * @return
 */
function kennystevens_get_properties() {
	if(isset($_POST['n'])) {
		$neighborhood_query = $_POST['n'];

		// get properties
		$allPostsWPQuery = new WP_Query(array(
			'post_type'=>'property',
			'post_status'=>'publish',
			'posts_per_page'=>-1,
			'tax_query' => array(
					array(
						'taxonomy' => 'property_status',
						'field'    => 'slug',
						'terms'    => 'closed',
					),
				),
		));

		// get results
		if ( $allPostsWPQuery->have_posts() ) {
			$properties = $allPostsWPQuery->posts;
			$map_details = array();

			foreach($properties as $property) {
				$neighborhood_slugs = array();
				$neighborhoods = get_the_terms($property->ID, "property_neighborhood");

				if (is_array($neighborhoods) || is_object($neighborhoods)) {
					foreach ($neighborhoods as $neighborhood) {
						$neighborhood_slugs[] = $neighborhood->slug;
					}
				}

				if(in_array($neighborhood_query, $neighborhood_slugs)) {
					$location_meta = get_post_meta($property->ID, "map_location");
// 					$map_details[] = array(
// 						"property_name" => $property->post_title,
// 						"address" => $location_meta[0]["address"],
// 						"lat" => $location_meta[0]["lat"],
// 						"lng" => $location_meta[0]["lng"],
// 						"state" => $location_meta[0]["state"],
// 						"city" => $location_meta[0]["city"]
// 					);
					$map_details[] = array(
						$property->post_title,
						$location_meta[0]["lat"],
						$location_meta[0]["lng"],
 						"address" => $location_meta[0]["address"],
					);
				}
			}

			wp_reset_postdata();

			echo json_encode($map_details);
		}
	}
	die();
}
add_action('wp_ajax_fetch_properties_ajax', 'kennystevens_get_properties');
add_action('wp_ajax_nopriv_fetch_properties_ajax', 'kennystevens_get_properties');//for users that are not logged in.

// Add submenu for Active Listings in Properties menu

add_action('admin_menu', 'kennystevens_property_status_filter_menu');
add_action('admin_head-edit.php', 'kennystevens_property_status_filter_menu_highlight');

function kennystevens_property_status_filter_menu() {
    add_submenu_page('edit.php?post_type=property', 'Active Listings', '<span id="menu-active-listings">Active</span>', 'manage_options', 'edit.php?post_type=property&property_status=active',"",1);
	add_submenu_page('edit.php?post_type=property', 'Closed Listings', '<span id="menu-closed-listings">Closed</span>', 'manage_options', 'edit.php?post_type=property&property_status=closed',"",2);
}

function kennystevens_property_status_filter_menu_highlight()
{
    global $current_screen;

    // Not our post type, exit earlier
    if( 'property' != $current_screen->post_type )
        return;

    if( isset( $_GET['property_status'] ) )
    {
		$property_status = $_GET['property_status'];

        ?>
        <script type="text/javascript">
            jQuery(document).ready( function($)
            {
                var reference = jQuery('#menu-<?php echo $property_status; ?>-listings').parent().parent();

                // add highlighting to our custom submenu
                reference.addClass('current');

                //remove higlighting from the default menu
                reference.parent().find('.wp-first-item').removeClass('current');
            });
        </script>
        <?php
    }
}
