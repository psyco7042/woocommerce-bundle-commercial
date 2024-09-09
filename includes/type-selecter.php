<?php
/**
 * registers the product within woocommerce product type selector dropdown
 * 
 * @see https://webkul.com/blog/create-a-custom-product-type-in-woocommerce/
 */

  
function bbloomer_add_custom_product_type( $types ){
    $types[ 'custom' ] = 'J Bundle';
    return $types;
}

add_filter( 'product_type_selector', 'bbloomer_add_custom_product_type' );