<?php
/**
 * Plugin Name: Flat rate regulator
 * Plugin URI: https://github.com/charade
 * Description: Flat rate fixe les bugg liés à wooCommerce en affichant uniquement les livraisons gratuites s'il y en a, sinon affichera uniquement les frais de livraisons
 * Plugin Version: 1.0
 * Author: Charles.Ek
 * Author URL: https://github.com/charad
 * Text Domain: Flat-rate-by-Charles-Ek
 */

function hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return !empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 100 );

