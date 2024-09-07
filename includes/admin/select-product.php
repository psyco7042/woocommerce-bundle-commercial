<?php
/**
 * registers the controls and settings for the admin to select the bundle items
 * 
 * @see https://webkul.com/blog/create-a-custom-product-type-in-woocommerce/
 */

 function wbjbl_bundle_product_data_panel(){
    global $post, $wpdb;
    $products = get_posts(array(
        'post_type'   => 'product',
        'numberposts' => -1,
        'fields'      => 'ids',
    ));
    ?>
    <div id="wbjbl_bundle_data" class='panel woocommerce_options_panel wbjbl-admin-main'>
        <div class="options-group">
            <h3>choose the products to be included in bundle</h3>
            <p>you can choose each individual products to be selected within your bundle or you can also choose the products by their category</p>
            
        </div>
    </div>
    <?php
 }
 add_action('woocommerce_product_data_panels', 'wbjbl_bundle_product_data_panel');