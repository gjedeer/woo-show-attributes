<?php
/*
 * Plugin Name: Woo Commerce - attributes shortcode
 * Plugin URL: https://github.com/gjedeer/woo-show-attributes
 * Description: [product_attributes_table] shortcode
 * Version: 1.0.0
 * Author: Andrzej Godziuk, Loïc de Marcé
 */

function woopa_shortcode($atts) {
    // Shortcode attribute (or argument)
    $atts = shortcode_atts(
      array(
	'id'    => ''
      ),
      $atts, 'product_attributes'
    );

    if( ! ( isset($atts['id']) && $atts['id'] > 0 ) ) {
      global $product;
      $id = $product->get_id();
      $atts['id'] = $id;
    }

    $product = wc_get_product($atts['id']);

    ob_start();

    do_action( 'woocommerce_product_additional_information', $product );

    return ob_get_clean();	    
}

add_shortcode('product_attributes_table', 'woopa_shortcode');
