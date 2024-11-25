<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$checkout_html = '';
global $woocommerce;
$amount = $woocommerce->cart->total;
$total = $woocommerce->cart->get_total();
$note = '';
$payment_url = $this->wc_cashapp_payment_url( $amount, $note );
$qr_code_url = $this->wc_cashapp_qrcode_url( $amount, $note );
$qr_code = $this->wc_cashapp_qrcode_html( $amount, $note );
$checkout_html .= '<fieldset id="wc-' . esc_attr( $this->id ) . '-form" data-plugin="' . wp_kses_post( WCCASHAPP_PLUGIN_VERSION ) . '">';
// Add this action hook if you want your custom payment gateway to support it
do_action( 'woocommerce_form_start', $this->id );
// upgrade display_cashapp
if ( $this->display_cashapp === 'no' ) {
    $this->update_option( 'display_cashapp', '1' );
} else {
    if ( $this->display_cashapp === 'yes' ) {
        $this->update_option( 'display_cashapp', '2' );
    }
}
if ( empty( $this->ReceiverCashApp ) ) {
    $checkout_html .= '<p>' . wp_kses_post( __( 'Please finish setting up this payment method or contact the admin to do so.', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) ) . '</p>';
    do_action( 'woocommerce_form_end', $this->id );
    $checkout_html .= '<input name="do_not_checkout" type="hidden" value="true"><div class="clear"></div></fieldset>';
    return;
}
$checkout_html .= '<p>' . esc_html__( 'Send', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . ' <a style="color: #00d632" href="' . $payment_url . '" target="_blank">' . $total . " " . esc_html__( 'to', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . " " . esc_attr( wp_kses_post( $this->ReceiverCashApp ) ) . '</a> ' . esc_html__( 'or click/scan the Cash App button below', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . '</p>';
$checkout_html .= '<p>' . wp_kses_post( __( 'Please <strong>use your Order Number (available once you place order)</strong> as the payment reference', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) ) . '.</p>';
// $checkout_html .= '<p class="wc-cashapp">' . esc_html__('Click', WCCASHAPP_PLUGIN_TEXT_DOMAIN) . ' > ';
// $checkout_html .= '<a href="https://cash.app/', esc_attr( wp_kses_post( $this->ReceiverCashApp ) ), '/' , esc_attr( wp_kses_post( $amount  ) ), '" target="_blank"><img width="150" height="150" class="logo-qr" alt="Cash App Link" src="' . esc_attr( WCCASHAPP_PLUGIN_DIR_URL . 'assets/images/cashapp.png' ) . '"></a>';
// $checkout_html .= ' ' . esc_html__( 'or Scan', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . ' > <a href="https://cash.app/', esc_attr( wp_kses_post( $this->ReceiverCashApp ) ), '/' , esc_attr( wp_kses_post( $amount  ) ), '" target="_blank"><img width="150" height="150" class="logo-qr" alt="Cash App Link" src="https://emailreceipts.io/qr?d=100&t=https://cash.app/', esc_attr( wp_kses_post( $this->ReceiverCashApp ) ), '/' , esc_attr( wp_kses_post( $amount  ) ), '"></a></p>';
$checkout_html .= $qr_code;
$checkout_html .= '<p>' . wp_kses_post( __( '<strong>After paying, please come back here and place the order</strong> below so we can start processing your order', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) ) . '.</p>';
$call = esc_html__( 'call', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . ' <a href="tel:' . esc_attr( $this->ReceiverCASHAPPNo ) . '" target="_blank">' . esc_html( $this->ReceiverCASHAPPNo ) . '</a>.';
$email = ' ' . esc_html__( 'You can also email', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . ' <a href="mailto:' . esc_attr( $this->ReceiverCASHAPPEmail ) . '" target="_blank">' . esc_html( $this->ReceiverCASHAPPEmail ) . '</a>';
$checkout_html .= '<p>' . esc_html__( 'If you are having an issue', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . ', ' . wp_kses_post( ( $call ? $call : '' ) ) . wp_kses_post( ( $email ? $email : '' ) ) . '</p>';
// toggleTutorial
if ( 'yes' === $this->toggleTutorial ) {
    $checkout_html .= '<p><a href="https://theafricanboss.com/cashappdemo" style="text-decoration: underline" target="_blank">' . esc_html__( 'See this 1min video demo explaining how this works', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . '.</a></p>';
}
// // toggleCredits
// if ( 'yes' === $this->toggleCredits ) {
// 	$checkout_html .= '<p><a href="https://theafricanboss.com/cashapp" style="text-decoration: underline;" target="_blank">' . sprintf(  esc_html__( 'Powered by %s', WCCASHAPP_PLUGIN_TEXT_DOMAIN ), 'The African Boss' ) . '</a></p>';
// }
do_action( 'woocommerce_form_end', $this->id );
$checkout_html .= '<div class="clear"></div></fieldset>';
echo wp_kses_post( $checkout_html );
//return wp_kses_post($checkout_html);