<?php
/**
 * register the product type  in woocommerce data base
 * 
 * @see https://webkul.com/blog/create-a-custom-product-type-in-woocommerce/
 */

 function wbjbl_create_product_type(){
    class JB_Product_bundle extends WC_Product {
        public function __construct($product){
            $this->product_type = 'wbjbl_bundle';
            parent::__construct($product);  // Use 'parent::__construct' instead of '$parent::__construct'
        }
    }
}
add_action('init', 'wbjbl_create_product_type');