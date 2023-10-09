<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$text = get_sub_field('text');

if ($title && $subtitle && $text) {
	$animate_1 = 'animate-up--1';
	$animate_2 = 'animate-up--2';
	$animate_3 = 'animate-up--3';
} elseif ($title && $subtitle && !$text) {
	$animate_1 = 'animate-up--1';
	$animate_2 = 'animate-up--2';
	$animate_3 = '';
} elseif ($title && !$subtitle && $text) {
	$animate_1 = 'animate-up--1';
	$animate_2 = '';
	$animate_3 = 'animate-up--2';
} elseif (!$title && $subtitle && $text) {
	$animate_1 = '';
	$animate_2 = 'animate-up--1';
	$animate_3 = 'animate-up--2';
} else {
	$animate_1 = 'animate-up--1';
	$animate_2 = 'animate-up--1';
	$animate_3 = 'animate-up--1';
}
?>
<?php if ($title) : ?>
	<h2 class="title-text__title animate-up <?php echo $animate_1;?>"><?php echo $title; ?></h2>
<?php endif; ?>
<?php if ($subtitle) : ?>
	<h3 class="title-text__subtitle animate-up <?php echo $animate_2;?>"><?php echo $subtitle; ?></h3>
<?php endif; ?>
<?php if ($text) : ?>
	<div class="title-text__text text-content animate-up <?php echo $animate_3;?>"><?php echo $text; ?></div>
<?php endif; ?>
