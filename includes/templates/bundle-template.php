<?php
/**
 * this page creates a user side template to display the product bundle
 * 
 * @see https://webkul.com/blog/create-a-custom-product-type-in-woocommerce/
 */

 function wbjbl_product_bundle_front(){
    global $product;
    if (!$product instanceof WC_Product) {
        return;
    }
    if ('jbundle' === $product->get_type()){
        echo 'hello this is working';
    }
 }
 add_action( 'woocommerce_single_product_summary', 'wbjbl_product_bundle_front' );