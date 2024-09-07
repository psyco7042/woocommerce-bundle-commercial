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
            <h3>Choose the products to be included in the bundle</h3>
            <p>You can choose individual products for the bundle or select them by category</p>
            <label class="custom-wbjbl-label">Multiple Select</label>
            <select class="productSelect" multiple name="native-select" placeholder="Native Select" data-search="true" data-silent-initial-value-set="true">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <!-- Add other options as needed -->
            </select>
        </div>
    </div>
    
    <script>
        jQuery(document).ready(function($) {
            // Use setTimeout to ensure the DOM is fully loaded and the panel is visible
            setTimeout(function() {
                VirtualSelect.init({
                    ele: '.productSelect'
                });
            }, 100); // Adjust delay if necessary
        });
    </script>
    <?php
}
add_action('woocommerce_product_data_panels', 'wbjbl_bundle_product_data_panel');
