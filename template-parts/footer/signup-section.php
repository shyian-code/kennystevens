<?php
$form_text = get_field('form_text', 'option');
$mail_service = get_field('mail_service', 'option');
if ($form_text) : ?>
	<section class="footer-signup">
		<div class="footer-signup__row">
			<div class="footer-signup__text"><?php echo $form_text ?></div>
			<?php
			if ($mail_service == "mailchimp") {
				get_template_part('template-parts/footer/mailchimp-form');
			} else {
				get_template_part('template-parts/footer/sendgrid-form');
			}?>
		</div>
	</section>
<?php endif;
