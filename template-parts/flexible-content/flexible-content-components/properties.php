<?php
$off_market = get_sub_field('off_market');
$off_market_args = array();
if($off_market) {
	$off_market_args = array(
		"off_market_listing" => true,
		"popup_class" => "contact-agent-popup"
	);
}
$title = get_sub_field('title');
$text = get_sub_field('text');
$top_offset = get_sub_field('top_offset');
$bottom_offset = get_sub_field('bottom_offset');
$show = get_sub_field('show');
$chosen_posts = get_sub_field('properties');
$number_recent = get_sub_field('number_recent');
$link = get_sub_field('button');

if ($top_offset || $bottom_offset) {
	if ($top_offset && !$bottom_offset) {
		$offset_style = ' style="padding-top: ' . $top_offset . 'px;"';
	} elseif ($bottom_offset && !$top_offset) {
		$offset_style = ' style="padding-bottom: ' . $bottom_offset . 'px;"';
	} else {
		$offset_style = ' style="padding-top: ' . $top_offset . 'px; padding-bottom: ' . $bottom_offset . 'px;"';
	}
} else {
	$offset_style = '';
}

if ($show == 'certain') {
	$arg_ppp = sizeof($chosen_posts);
	if (is_array($chosen_posts)) {
		$arg_in = array_values($chosen_posts);
	} else {
		$arg_in = array($chosen_posts);
	}
	$arg_orderby = 'post__in';
	$arg_order = 'ASC';
	$ajax_loader_data = '';
} else {
	$arg_ppp = $number_recent;
	$arg_in = array();
	$arg_orderby = 'date';
	$arg_order = 'DESC';
	$ajax_loader_data = '';
}
if ($show == 'tax') {
	$properties_args = array(
		'post_type' => 'property',
		'post_status' => 'publish',
		'order' => $arg_order,
		'orderby' => $arg_orderby,
		'post__in' => $arg_in,
		'posts_per_page' => $arg_ppp,
		'tax_query' => array(
			array(
				'taxonomy' => 'property_status',
				'field'    => 'slug',
				'terms'    => 'active',
			),
		),
	);
} else {
	$properties_args = array(
		'post_type' => 'property',
		'post_status' => 'publish',
		'order' => $arg_order,
		'orderby' => $arg_orderby,
		'post__in' => $arg_in,
		'posts_per_page' => $arg_ppp,
	);
}

$properties = new WP_Query($properties_args); ?>
<div class="image-hover-text-cols"<?php echo $offset_style; ?>>
	<?php if ($title || $text) : ?>
		<section class="section">
			<div class="image-hover-text-cols__row--narrow title-text image-hover-text-cols__row">
				<?php kennystevens_title_text('post-listing__', 'all'); ?>
			</div>
		</section>
	<?php endif; ?>
	<?php if ($properties->have_posts()) :
		if ($show == 'ajax') {
			global $wp_query;
			$ajax_args = array(
				'post_type' => 'property',
				'posts_per_page' => $arg_ppp,
				'offset' => $arg_ppp
			);
		}
		?>
		<div
			class="<?php if ($off_market) : ?>off-market-listings <?php endif; ?><?php if ($show == 'ajax') : ?>post-listing <?php endif; ?>image-hover-text-cols__row--no-pad image-hover-text-cols__row"<?php if ($show == 'ajax') : ?> data-query-vars=<?php echo json_encode($ajax_args); ?> data-total="<?php echo $wp_query->found_posts; ?>"<?php endif; ?>>
			<?php while ($properties->have_posts()) : $properties->the_post(); ?>
				<?php get_template_part('/template-parts/content', get_post_type(), $off_market_args); ?>
			<?php endwhile; ?>

			<?php if ($link && $show !== 'ajax') : ?>
				<div class="post-listing__btn-wrap image-hover-text-cols__row--narrow title-text image-hover-text-cols__row">
					<a class="btn btn--black-line"
						 href="<?php echo $link["url"]; ?>"
						 title="<?php echo $link["title"]; ?>"
						 target="<?php echo $link["target"]; ?>"><?php echo $link["title"] ? $link["title"] : __('Learn more'); ?></a>
				</div>
			<?php endif; ?>
		</div>
	<?php endif;
	wp_reset_query(); ?>
</div>
<style>
	.property_status-in-escrow .post__img-wrapper:after{
		content: 'In Escrow';
		display: block;
		position: absolute;
		top: 10px;
		right: 10px;
		color: #FFF;
	}
</style>

<?php if($off_market) : ?>
<script type="text/javascript">
	jQuery(".off-market-listings a.post__link").on("click", function(e) {
		e.preventDefault();
	});
</script>
<?php endif; ?>
