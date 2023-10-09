<?php
$list_id = get_field('footer_sendgrid_list', 'options');
$form_id = get_field('footer_sendgrid_form_id', 'options');
?>
<div class="footer-signup__form form__wrapper">
	<?php echo do_shortcode('[gravityform id="' . $form_id . '" field_values="sendgrid_list=sendgrid_list_'.$list_id.'" title="false" description="false" ajax="true"]'); ?>
</div>
