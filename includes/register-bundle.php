<?php
/**
 * register the product type  in woocommerce data base
 * 
 * @see https://webkul.com/blog/create-a-custom-product-type-in-woocommerce/
 */
  

  
function bbloomer_create_custom_product_type(){
    class WC_Product_Custom extends WC_Product {
      public function get_type() {
         return 'custom';
      }
    }
}

add_action( 'init', 'bbloomer_create_custom_product_type' );