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
 * HTML Template Email Request a Quote
 *
 * @package YITH Woocommerce Request A Quote
 * @since   1.0.0
 * @version 1.3.4
 * @author  YITH
 */
$mail_options      = get_option( 'woocommerce_ywraq_email_settings' );
$order_id          = $raq_data['order_id'];
$order             = wc_get_order( $order_id );
$customer          = $order ? yit_get_prop( $order, '_customer_user', true ) : 0;
$page_detail_admin = $mail_options['quote_detail_link'] == 'editor';
$quote_number      = apply_filters( 'ywraq_quote_number', $raq_data['order_id'] );
do_action( 'woocommerce_email_header', $email_heading, $email );

?>



<p>
    <img src="http://www.tubolaminas.com/wp-content/uploads/2019/03/logo_web_tubolaminas.png"></img><br/><br/>
    <?php echo $email_description ?>
</p>


<?php
wc_get_template( 'emails/request-quote-table.php', array(
	'raq_data' => $raq_data
), '', YITH_YWRAQ_TEMPLATE_PATH . '/' );
?>
<p></p>

<?php if ( ( $customer != 0 && (  get_option( 'ywraq_enable_order_creation', 'yes' ) == 'yes' ) ) || ( $page_detail_admin && get_option( 'ywraq_enable_order_creation', 'yes' ) == 'yes' ) ): ?>
    <p><?php printf( __( 'You can see details here: <a href="%s">#%s</a>', 'yith-woocommerce-request-a-quote' ), YITH_YWRAQ_Order_Request()->get_view_order_url( $order_id, $page_detail_admin ), $quote_number ); ?></p>
<?php endif ?>


<?php if ( ! empty( $raq_data['user_message'] ) ): ?>
    <h2><?php _e( 'Customer\'s message', 'yith-woocommerce-request-a-quote' ); ?></h2>
    <p><?php echo stripslashes( $raq_data['user_message'] ); ?></p>
<?php endif ?>
<h2><?php _e( 'Customer\'s details', 'yith-woocommerce-request-a-quote' ); ?></h2>

<?php
if ( ! isset( $raq_data['from_checkout'] ) ) {
	$country_code = isset( $raq_data['user_country'] ) ? $raq_data['user_country'] : '';

	foreach ( $raq_data as $key => $field ) {

		if ( ! isset( $field['id'] ) ) {
			continue;
		};

		$avoid_key = array(
			'customer_id',
			'raq_content',
			'user_country',
			'user_message',
			'user_email',
			'user_name',
			'order_id',
			'lang',
			'message',
			'user_additional_field',
			'user_additional_field_2',
			'user_additional_field_3'
		);

		if ( in_array( $key, $avoid_key ) ) {
			continue;
		}

		$field_type    = strtolower( $field['type'] );

		switch ( $field_type ) {

			case 'ywraq_heading':
				?><h3><?php echo $field['label'] ?></h3><?php
				break;

			case 'email':
				?><p><strong><?php echo $field['label']; ?></strong>: <a
                    href="mailto:<?php echo $field['value']; ?>"><?php echo $field['value']; ?></a></p><?php
				break;

			case 'country':
				$countries = WC()->countries->get_countries();
				?><p><strong><?php echo $field['label']; ?></strong>: <?php echo $countries[ $country_code ] ?></p><?php
				break;

			case 'state':
				$states = WC()->countries->get_states( $country_code );
				$state = $field['value'] != '' ? $states[ $field['value'] ] : '';

				if ( $state != '' ) {
					?><p><strong><?php echo $field['label']; ?></strong>
                    : <?php echo( $state == '' ? $field['value'] : $state ) ?></p><?php
				}
				break;

			case 'ywraq_multiselect':
				?><p><strong><?php echo $field['label']; ?></strong>: <?php echo implode( ', ', $field['value'] ); ?>
                </p><?php
				break;

			case 'checkbox':
				$value = ( $field['value'] == 1 ) ? apply_filters( 'yith_wraq_checkbox_yes_text', 'Yes' ) : apply_filters( 'yith_wraq_checkbox_no_text', 'No' );
				?>
                <p><strong><?php echo $field['label']; ?></strong>: <?php echo $value; ?></p>
				<?php
				break;

			case 'select':
				$default_form_fields = get_option( 'ywraq_fields_form_options' );
				$value = ! empty( $default_form_fields[ $field['id'] ]['options'][ $field['value'] ] ) ? $default_form_fields[ $field['id'] ]['options'][ $field['value'] ] : '';
				?>
                <p><strong><?php echo $field['label']; ?></strong>: <?php echo $value; ?></p>
				<?php
				break;

			case 'ywraq_acceptance':
				$value = ( $field['value'] == 'on' ? __( 'Accepted', 'yith-woocommerce-request-a-quote' ) : __( 'Not Accepted', 'yith-woocommerce-request-a-quote' ) );
				?>
                <p><strong><?php echo $field['label']; ?></strong>: <?php echo $value; ?></p>
				<?php
				break;

			default:
				if ( $field_type != 'ywraq_upload' ) { ?><p><strong><?php echo $field['label']; ?></strong>
                    : <?php echo $field['value']; ?></p><?php

				}
		}

	}
} else {
	do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );
}
?>

<?php if ( ! empty( $raq_data['user_additional_field'] ) || ! empty( $raq_data['user_additional_field_2'] ) || ! empty( $raq_data['user_additional_field_3'] ) ): ?>
    <h2><?php _e( 'Customer\'s additional fields', 'yith-woocommerce-request-a-quote' ); ?></h2>

	<?php if ( ! empty( $raq_data['user_additional_field'] ) ): ?>
        <p><?php printf( '<strong>%s</strong>: %s', get_option( 'ywraq_additional_text_field_label' ), $raq_data['user_additional_field'] ) ?></p>
	<?php endif ?>

	<?php if ( ! empty( $raq_data['user_additional_field_2'] ) ): ?>
        <p><?php printf( '<strong>%s</strong>: %s', get_option( 'ywraq_additional_text_field_label_2' ), $raq_data['user_additional_field_2'] ) ?></p>
	<?php endif ?>

	<?php if ( ! empty( $raq_data['user_additional_field_3'] ) ): ?>
        <p><?php printf( '<strong>%s</strong>: %s', get_option( 'ywraq_additional_text_field_label_3' ), $raq_data['user_additional_field_3'] ) ?></p>
	<?php endif ?>

<?php endif ?>
<?php

do_action( 'woocommerce_email_footer', $email );

?>
