<?php
/**
 * registers the product within woocommerce product type selector dropdown
 * 
 * @see https://webkul.com/blog/create-a-custom-product-type-in-woocommerce/
 */

 function wbjbl_product_type_selector($types){
   $types['wbjbl_bundle'] = __('Jbulls Bundle', 'jb_wcp');
   return $types; 
}
add_filter('product_type_selector', 'wbjbl_product_type_selector');