<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
?>
<p class="dlm-nf-download-link"><a class="download-form__confirm-link" href="<?php echo $download->get_the_download_link(); ?>"><?php echo apply_filters( 'dlm_nf_download_link_label', __( 'Download Now', 'dlm-gravity-forms' ) ); ?></a></p>
