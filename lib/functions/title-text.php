<?php
function kennystevens_title_text($parent_class = '', $apply_class_to = '', $title_tag = 'h2', $subtitle_tag = 'h3')
{
	$title = get_sub_field('title');
	$subtitle = get_sub_field('subtitle');
	$text = get_sub_field('text');
	$subtitle_before = get_sub_field('subtitle_before');

	if ($title && $subtitle && $text && !$subtitle_before) {
		$animate_1 = 'animate-up--1';
		$animate_2 = 'animate-up--2';
		$animate_3 = 'animate-up--3';
	} elseif ($title && $subtitle && !$text && !$subtitle_before) {
		$animate_1 = 'animate-up--1';
		$animate_2 = 'animate-up--2';
		$animate_3 = '';
	} elseif ($title && !$subtitle && $text && !$subtitle_before) {
		$animate_1 = 'animate-up--1';
		$animate_2 = '';
		$animate_3 = 'animate-up--2';
	} elseif (!$title && $subtitle && $text && !$subtitle_before) {
		$animate_1 = '';
		$animate_2 = 'animate-up--1';
		$animate_3 = 'animate-up--2';
	} elseif ($title && $subtitle_before && $text && !$subtitle) {
		$animate_1 = 'animate-up--2';
		$animate_2 = 'animate-up--1';
		$animate_3 = 'animate-up--3';
	} else {
		$animate_1 = 'animate-up--1';
		$animate_2 = 'animate-up--1';
		$animate_3 = 'animate-up--1';
	}

	if ($parent_class == '') {
		$title_parent_class = '';
		$subtitle_parent_class = '';
		$text_parent_class = '';
	} else {
		if ($apply_class_to == 'title') {
			$title_parent_class = $parent_class . 'title ';
			$subtitle_parent_class = '';
			$text_parent_class = '';
		} elseif ($apply_class_to == 'subtitle') {
			$title_parent_class = '';
			$subtitle_parent_class = $parent_class . 'subtitle ';
			$text_parent_class = '';
		} elseif ($apply_class_to == 'text') {
			$title_parent_class = '';
			$subtitle_parent_class = '';
			$text_parent_class = $parent_class . 'text ';
		} elseif ($apply_class_to == 'all') {
			$title_parent_class = $parent_class . 'title ';
			$subtitle_parent_class = $parent_class . 'subtitle ';
			$text_parent_class = $parent_class . 'text ';
		} else {
			$title_parent_class = '';
			$subtitle_parent_class = '';
			$text_parent_class = '';
		}
	}
	if ($subtitle_before) :
		echo '<' . $subtitle_tag . ' class="' . $subtitle_parent_class . 'title-text__subtitle animate-up subtitle-above-press ' . $animate_2 . '">' . $subtitle_before . '</' . $subtitle_tag . '>';
	endif;
	if ($title) :
		echo '<' . $title_tag . ' class="' . $title_parent_class . 'title-text__title animate-up ' . $animate_1 . '">' . $title . '</' . $title_tag . '>';
	endif;
	if ($subtitle) :
		echo '<' . $subtitle_tag . ' class="' . $subtitle_parent_class . 'title-text__subtitle animate-up ' . $animate_2 . '">' . $subtitle . '</' . $subtitle_tag . '>';
	endif;
	if ($text) :
		echo '<div class="' . $text_parent_class . 'title-text__text text-content animate-up ' . $animate_3 . '">' . $text . '</div>';
	endif;
}
