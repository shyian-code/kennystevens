<?php
$short_code = get_sub_field('input_shortcode', get_the_ID());

if($short_code) {
	echo do_shortcode($short_code);
}
