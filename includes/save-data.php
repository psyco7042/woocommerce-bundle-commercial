<?php
/**
 * this file helps the user to store data withn the product admin menu
 * 
 * @see https://webkul.com/blog/create-a-custom-product-type-in-woocommerce/
 */



  function save_jbulls_product_settings( $post_id ){
     $first_bundle_group_ids = $_POST['native_select'];
     $final_selected_item_ids = array();
 
     if(!empty($first_bundle_group_ids)){
         $final_selected_item_ids[] = $first_bundle_group_ids;
 
         $i = 1;
 
         while(isset($_POST["native_select_$i"])){
             $wbjbl_repeater_product_info = $_POST["native_select_$i"];
             if(!empty($wbjbl_repeater_product_info) && $wbjbl_repeater_product_info !== null){
                 $final_selected_item_ids[] = $wbjbl_repeater_product_info;
             }
 
             $i++;
         }
 
         if(!empty($final_selected_item_ids)){
             update_post_meta($post_id, 'wbjbl_bundle_info', $final_selected_item_ids);
         }
     }
 
  }
  add_action('woocommerce_process_product_meta', 'save_jbulls_product_settings');





