<?php
/**
 * this file helps the user to store data withn the product admin menu
 * 
 * @see https://webkul.com/blog/create-a-custom-product-type-in-woocommerce/
 */

 function save_jbulls_product_settings(){
    
 }
 add_action('woocommerce_process_product_meta', 'save_jbulls_product_settings');