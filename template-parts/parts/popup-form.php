<div class="popup-form">
	<div class="download-form download-form--popup">
		<button class="popup-form__close-btn" type="button"></button>
		<?php
		$sendgrid_list = get_field('flyin_sendgrid_list', 'options');
		$download_locked = get_field('flyin_form_df', 'options');
		echo do_shortcode('[dlm_gf_form gf_field_values="sendgrid_list=sendgrid_list_' . $sendgrid_list . '" gf_title="true" gf_description="true" gf_ajax="true" download_id=' . $download_locked . ']');
		?>
	</div>
</div>
