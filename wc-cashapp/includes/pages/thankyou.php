<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$thankyou_html = '';
// $order = wc_get_order( $order_id );
$amount = $order->get_total();
$currency = $order->get_currency();
// $total = "$amount $currency";
// $total = $order->get_total();
$total = $order->get_formatted_order_total();
$note = '';
$payment_url = $this->wc_cashapp_payment_url( $amount, $note );
$qr_code_url = $this->wc_cashapp_qrcode_url( $amount, $note );
$qr_code = $this->wc_cashapp_qrcode_html( $amount, $note );
$thankyou_html .= '<div id="wc-' . esc_attr( $this->id ) . '-form" data-plugin="' . wp_kses_post( WCCASHAPP_PLUGIN_VERSION ) . '">';
$thankyou_html .= '<h2>' . esc_html__( 'Cash App Notice', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . '</h2>';
$thankyou_html .= '<p><strong style="font-size:large;">' . sprintf( esc_html__( 'Please use your Order Number: %s as the payment reference', WCCASHAPP_PLUGIN_TEXT_DOMAIN ), $order_id ) . '.</strong></p>';
// $thankyou_html .= '<p class="wc-cashapp">' . esc_html__('Click', WCCASHAPP_PLUGIN_TEXT_DOMAIN) . ' > ';
// $thankyou_html .= '<a href="https://cash.app/', esc_attr( wp_kses_post( $this->ReceiverCashApp ) ), '/' , esc_attr( wp_kses_post( $amount  ) ), '" target="_blank"><img width="150" height="150" class="logo-qr" alt="Cash App Link" src="' . esc_attr( WCCASHAPP_PLUGIN_DIR_URL . 'assets/images/cashapp.png' ) . '"></a>';
// $thankyou_html .= ' ' . esc_html__( 'or Scan', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . ' > <a href="https://cash.app/', esc_attr( wp_kses_post( $this->ReceiverCashApp ) ), '/' , esc_attr( wp_kses_post( $amount  ) ), '" target="_blank"><img width="150" height="150" class="logo-qr" alt="Cash App Link" src="https://emailreceipts.io/qr?d=100&t=https://cash.app/', esc_attr( wp_kses_post( $this->ReceiverCashApp ) ), '/' , esc_attr( wp_kses_post( $amount  ) ), '"></a></p>';
$thankyou_html .= $qr_code;
$thankyou_html .= '<p><strong>' . esc_html__( 'Disclaimer', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . ': </strong>' . esc_html__( 'Your order will not be processed until funds have cleared in our Cash App account', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . '.</p>';
$thankyou_html .= '</div><br><hr><br>';
// echo wp_kses_post($thankyou_html); // wp_kses_post strips input so we need another way to escape it
echo wp_kses( $thankyou_html, array(
    'h2'       => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'h3'       => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'h4'       => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'p'        => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'fieldset' => array(),
    'label'    => array(
        'for' => true,
    ),
    'input'    => array(
        'id'          => array(),
        'type'        => array(),
        'name'        => array(),
        'value'       => array(),
        'placeholder' => array(),
        'class'       => array(),
        'style'       => array(),
        'checked'     => array(),
        'disabled'    => array(),
    ),
    'div'      => array(
        'align' => true,
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'canvas'   => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'b'        => array(),
    'strong'   => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'em'       => array(),
    'small'    => array(),
    'strike'   => array(),
    'span'     => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'br'       => array(),
    'hr'       => array(),
    'ul'       => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'ol'       => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'li'       => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'pre'      => array(),
    'button'   => array(
        'id'       => array(),
        'class'    => array(),
        'style'    => array(),
        'disabled' => true,
        'name'     => true,
        'type'     => true,
        'value'    => true,
    ),
    'a'        => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
        'href'  => array(),
        'title' => array(),
    ),
    'i'        => array(
        'id'    => array(),
        'class' => array(),
        'style' => array(),
    ),
    'img'      => array(
        'id'      => array(),
        'class'   => array(),
        'style'   => array(),
        'align'   => true,
        'loading' => true,
        'alt'     => true,
        'src'     => true,
        'height'  => true,
        'width'   => true,
    ),
) );