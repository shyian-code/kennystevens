<?php

function kennystevens_loadmore_ajax_handler()
{
	global $post;

	$query_vars = $_POST['queryVars'];

	$args = array(
		'post_type' => $query_vars['post_type'],
		'posts_per_page' => $query_vars['posts_per_page'],
		'offset' => $query_vars['offset'],
		'update_post_term_cache' => false, // Improves Query performance
		'update_post_meta_cache' => false, // Improves Query performance
	);
	$posts = get_posts($args);
	$payload = array(
		'posts' => array(),
		'query_vars' => $query_vars // Here for debugging purposes
	);

	if ($posts) :
		foreach ($posts as $post) : setup_postdata($post);
			// Use object buffering to send each post as a separate string instead of all at once.
			ob_start();
			get_template_part('template-parts/content', get_post_type());
			array_push($payload['posts'], ob_get_clean());
		endforeach;
		wp_reset_postdata();
	endif;

	echo json_encode($payload);
	die();

}

add_action('wp_ajax_nopriv_loadmore', 'kennystevens_loadmore_ajax_handler');
add_action('wp_ajax_loadmore', 'kennystevens_loadmore_ajax_handler');

