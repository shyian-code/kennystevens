<?php
function kennystevens_address_price($prefix, $taxonomy, $options_prefix, $field_post_id, $sub = false, $show = 'all')
{

	if ($sub == true) {
		if ($show == 'all') {
			$address = get_sub_field($prefix . '_address', $field_post_id);
			$price = get_sub_field($prefix . '_price', $field_post_id);
		} else {
			if ($show == 'address') {
				$address = get_sub_field($prefix . '_address', $field_post_id);
				$price = '';
			} else {
				$price = get_sub_field($prefix . '_price', $field_post_id);
				$address = '';
			}
		}
	} else {
		if ($show == 'all') {
			$address = get_field($prefix . '_address', $field_post_id);
			$price = get_field($prefix . '_price', $field_post_id);
		} else {
			if ($show == 'address') {
				$address = get_field($prefix . '_address', $field_post_id);
				$price = '';
			} else {
				$price = get_field($prefix . '_price', $field_post_id);
				$address = '';
			}
		}
	}

	if ($address || $price) {
		if ($address) {
			$term_list = wp_get_post_terms($field_post_id, $taxonomy, array('fields' => 'names'));
			if ($term_list) {
				$location = '';
				foreach ($term_list as $term) {
					$location = $term;
				}
			} else {
				$location = '';
			}
			$desc_line_addr = $address . ($location ? ', ' . $location : '');
		}
		if ($price) {
			$price_label = get_field($options_prefix . '_price_label', 'options');
			$desc_line_price = ($address ? '<br>' : '') . $price_label . $price;
		}
		$description = '<h6 class="text-box__description text-box__subtitle--theme animate-up animate-up--2">' . $desc_line_addr . $desc_line_price . '</h6>';

	} else {
		$description = '';
	}

	return $description;
}
