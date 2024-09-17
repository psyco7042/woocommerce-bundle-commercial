<?php


add_action( 'woocommerce_before_single_product', 'conditionally_remove_default_variation_form', 20 );

function conditionally_remove_default_variation_form() {
    if ( is_product() ) {
        global $product;
        if ( $product instanceof WC_Product ) {
            if ( $product->is_type( 'custom' ) ) { 
                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
            }
        }
    }
}
