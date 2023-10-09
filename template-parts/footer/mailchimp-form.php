<!-- Begin Mailchimp Signup Form -->
<?php
$form_action = get_field('mailchimp_subscribe_action', 'option');
$form_disable_bot_signups = get_field('mailchimp_subscribe_disable_bot_signups', 'option');
?>
<div class="footer-signup__form form__wrapper" id="mc_embed_signup">
	<form action="<?php echo $form_action; ?>"
				method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank"
				novalidate>
		<div id="mc_embed_signup_scroll" class="form__inner">
			<div class="form__input-wrap form__input-wrap--sm mc-field-group">
				<label class="form__input-label" for="mce-FNAME"><?php _e('First Name', THEME_TD); ?></label>
				<input type="text" value="" name="FNAME" class="form__input" id="mce-FNAME" placeholder="<?php _e('First Name', THEME_TD); ?>">
			</div>
			<div class="form__input-wrap form__input-wrap--sm mc-field-group">
				<label class="form__input-label" for="mce-LNAME"><?php _e('Last Name', THEME_TD); ?></label>
				<input type="text" value="" name="LNAME" class="form__input" id="mce-LNAME" placeholder="<?php _e('Last Name', THEME_TD); ?>">
			</div>
			<div class="form__input-wrap mc-field-group">
				<label class="form__input-label" for="mce-EMAIL"><?php _e('Email Address', THEME_TD); ?></label>
				<input type="email" value="" name="EMAIL" class="form__input required email" id="mce-EMAIL" placeholder="<?php _e('Email', THEME_TD); ?>">
			</div>
			<?php if ($form_disable_bot_signups) : ?>
				<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
				<div style="position: absolute; left: -5000px;" aria-hidden="true">
					<input type="text"
								 name="<?php echo $form_disable_bot_signups; ?>"
								 tabindex="-1" value="">
				</div>
			<?php endif; ?>
			<div class="form__btn btn btn--white-flat">
				<input type="submit" value="<?php _e('Sign Up', THEME_TD); ?>" name="subscribe" id="mc-embedded-subscribe"
							 class="form__input-submit">
			</div>
		</div>
		<div id="mce-responses">
			<div class="form__response response" id="mce-error-response" style="display:none"></div>
			<div class="form__response response" id="mce-success-response" style="display:none"></div>
		</div>
	</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
<script type='text/javascript'>(function ($) {
		window.fnames = new Array();
		window.ftypes = new Array();
		fnames[1] = 'FNAME';
		ftypes[1] = 'text';
		fnames[2] = 'LNAME';
		ftypes[2] = 'text';
		fnames[0] = 'EMAIL';
		ftypes[0] = 'email';
	}(jQuery));
	var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->
