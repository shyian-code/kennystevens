<?php
/**
 * Register Google API Key
 *
 * @param $api
 *
 * @return mixed
 */
function kennystevens_acf_map_init()
{

	$key = get_field('google_maps_api_key', 'options');
	acf_update_setting('google_api_key', $key);
}

add_action('acf/init', 'kennystevens_acf_map_init');