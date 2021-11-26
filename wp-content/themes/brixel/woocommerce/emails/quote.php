<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * HTML Template Email Send Quote
 *
 * @since   1.0.0
 * @author  YITH
 * @version 2.0.8
 * @package YITH Woocommerce Request A Quote
 */

do_action( 'woocommerce_email_header', $email_heading, $email );


$order_id = yit_get_prop( $order, 'id', true );
$exdata   = yit_get_prop( $order, '_ywcm_request_expire', true );

if ( function_exists( 'wc_format_datetime' ) ) {
	$order_date = wc_format_datetime( $order->get_date_created() );
	$exdata     = new WC_DateTime( $exdata, new DateTimeZone( 'UTC' ) );
	$exp_date   = wc_format_datetime( $exdata );
} else {
	$date_format = isset( $raq_data['lang'] ) ? ywraq_get_date_format( $raq_data['lang'] ) : wc_date_format();
	$order_date  = date_i18n( $date_format, strtotime( yit_get_prop( $order, 'date_created', true ) ) );
	$exp_date    = date_i18n( $date_format, strtotime( $exdata ) );
}

?>

    <h2><?php printf( __( '%s n. %s', 'yith-woocommerce-request-a-quote' ), apply_filters( 'wpml_translate_single_string', $email_title, 'admin_texts_woocommerce_ywraq_send_quote_settings', '[woocommerce_ywraq_send_quote_settings]email-title', $raq_data['lang'] ), $raq_data['order-number'] ) ?></h2>

    <p><?php echo apply_filters( 'wpml_translate_single_string', $email_description, 'admin_texts_woocommerce_ywraq_send_quote_settings', '[woocommerce_ywraq_send_quote_settings]email-description', $raq_data['lang'] ); ?></p>

<?php if ( get_option( 'ywraq_hide_table_is_pdf_attachment' ) == 'no' || empty( get_option( 'ywraq_hide_table_is_pdf_attachment' ) ) ): ?>
    <p><strong><?php _e( 'Request date', 'yith-woocommerce-request-a-quote' ) ?></strong>: <?php echo $order_date ?></p>
	<?php if ( $raq_data['expiration_data'] != '' ): ?>
        <p><strong><?php _e( 'Expiration date', 'yith-woocommerce-request-a-quote' ) ?></strong>: <?php echo $exp_date ?></p>
	<?php endif ?>

	<?php if ( ! empty( $raq_data['admin_message'] ) ): ?>
        <p><?php echo $raq_data['admin_message'] ?></p>
	<?php endif ?>

	<?php
	wc_get_template( 'emails/quote-table.php', array(
		'order' => $order
	), '', YITH_YWRAQ_TEMPLATE_PATH . '/' );
	?>
    <p></p>
<?php endif ?>
    <p>
		<?php if ( get_option( 'ywraq_show_accept_link' ) != 'no' ): ?>
            <a href="<?php echo esc_url( ywraq_get_accepted_quote_page( $order ) ) ?>"><?php ywraq_get_label( 'accept', true ) ?></a>
		<?php endif;
		echo ( get_option( 'ywraq_show_accept_link' ) != 'no' && get_option( 'ywraq_show_reject_link' ) != 'no' ) ? ' | ' : '';
		if ( get_option( 'ywraq_show_reject_link' ) != 'no' ): ?>
            <a href="<?php echo esc_url( ywraq_get_rejected_quote_page( $order ) ) ?>"><?php ywraq_get_label( 'reject', true ) ?></a>
		<?php endif; ?>
    </p>

<?php if ( ( $after_list = yit_get_prop( $order, '_ywraq_request_response_after', true ) ) != '' ): ?>
    <p><?php echo apply_filters( 'ywraq_quote_after_list', nl2br( $after_list ), $order_id ) ?></p>
<?php endif; ?>

<?php

$user_name         = yit_get_prop( $order, 'ywraq_customer_name', true );
$user_email        = yit_get_prop( $order, 'ywraq_customer_email', true );
$formatted_address = $order->get_formatted_billing_address();
$billing_name      = yit_get_prop( $order, '_billing_first_name', true );
$billing_surname   = yit_get_prop( $order, '_billing_last_name', true );
$billing_phone     = yit_get_prop( $order, 'ywraq_billing_phone', true );
$billing_phone     = empty( $billing_phone ) ? yit_get_prop( $order, '_billing_phone', true ) : $billing_phone;
$billing_vat       = yit_get_prop( $order, 'ywraq_billing_vat', true );
$billing_vat       = empty( $billing_vat ) ? yit_get_prop( $order, '_billing_vat', true ) : $billing_vat;

?>

    <h2><?php _e( 'Customer\'s details', 'yith-woocommerce-request-a-quote' ); ?></h2>
<?php if ( empty( $billing_name ) && empty( $billing_surname ) ): ?>
    <p><strong><?php _e( 'Name:', 'yith-woocommerce-request-a-quote' ); ?></strong> <?php echo $user_name ?></p>
<?php endif; ?>

    <p><?php echo $formatted_address ?></p>

    <p><strong><?php _e( 'Email:', 'yith-woocommerce-request-a-quote' ); ?></strong>
        <a href="mailto:<?php echo $raq_data['user_email']; ?>"><?php echo $raq_data['user_email']; ?></a>
    </p>

<?php if ( $billing_vat != '' ): ?>
    <p><strong><?php _e( 'Billing VAT:', 'yith-woocommerce-request-a-quote' ); ?></strong> <?php echo $billing_vat ?></p>
<?php endif; ?>

<?php if ( $billing_phone != '' ): ?>
    <p><strong><?php _e( 'Billing Phone:', 'yith-woocommerce-request-a-quote' ); ?></strong> <?php echo $billing_phone ?></p>
<?php endif;

//Retro compatibility
$af1 = yit_get_prop( $order, 'ywraq_customer_additional_field', true );
if ( ! empty( $af1 ) ) {
	printf( '<p><strong>%s</strong>: %s</p>', get_option( 'ywraq_additional_text_field_label' ), $af1 );
}

$af2 = yit_get_prop( $order, 'ywraq_customer_additional_field_2', true );
if ( ! empty( $af2 ) ) {
	printf( '<p><strong>%s</strong>: %s</p>', get_option( 'ywraq_additional_text_field_label_2' ), $af2 );
}

$af3 = yit_get_prop( $order, 'ywraq_customer_additional_field_3', true );
if ( ! empty( $af3 ) ) {
	printf( '<p><strong>%s</strong>: %s</p>', get_option( 'ywraq_additional_text_field_label_3' ), $af3 );
}

$af4 = yit_get_prop( $order, 'ywraq_customer_other_email_content', true );
if ( ! empty( $af4 ) ) {
	printf( '<p>%s</p>', $af4 );
}


do_action( 'woocommerce_email_footer', $email );
?>