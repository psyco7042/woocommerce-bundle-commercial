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
    if ('custom' === $product->get_type()){
        $product_info = get_post_meta($product->get_id(), 'wbjbl_bundle_info', true);
        print_r($product_info);
        echo '<div class="item-container-main" style="display:flex; gap:20px">';
        $i = 1;
        foreach($product_info as $item_nfo){
            echo '<div class="item-group" style="padding: 20px; border: 1px solid #ADADAD; border-radius: 15px">';
            echo "<button id=parent_modal_$i style='outline: none; border: none; background:transparent;'>";
            echo '<svg height="25pt" viewBox="0 0 480 480" width="25pt" xmlns="http://www.w3.org/2000/svg"><path d="m56 288h136v136c0 26.507812 21.492188 48 48 48s48-21.492188 48-48v-136h136c26.507812 0 48-21.492188 48-48s-21.492188-48-48-48h-136v-136c0-26.507812-21.492188-48-48-48s-48 21.492188-48 48v136h-136c-26.507812 0-48 21.492188-48 48s21.492188 48 48 48zm0 0" fill="#9bc9ff"/><path d="m240 480c-30.914062-.035156-55.964844-25.085938-56-56v-128h-128c-30.929688 0-56-25.070312-56-56s25.070312-56 56-56h128v-128c0-30.929688 25.070312-56 56-56s56 25.070312 56 56v128h128c30.929688 0 56 25.070312 56 56s-25.070312 56-56 56h-128v128c-.035156 30.914062-25.085938 55.964844-56 56zm-184-280c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8zm0 0" fill="#1e81ce"/></svg>';
            echo '</div>';
            $i++;
        }
        echo '</div>';
    }
 }
 add_action( 'woocommerce_single_product_summary', 'wbjbl_product_bundle_front' );