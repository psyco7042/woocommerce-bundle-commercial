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
    foreach ($products as $product_id) {
        $product = wc_get_product($product_id);
        if ($product) {
            $product_data[] = array(
                'name' => $product->get_name(),
                'id'   => $product_id
            );
        }
    }


    ?>
    <div id="wbjbl_bundle_data" class='panel woocommerce_options_panel wbjbl-admin-main'>
        <div id="hidden-value">
            <?php
                foreach ($products as $product_id) {
                    $product = wc_get_product($product_id);
                    if ($product) {
                        echo '<option value="'. esc_html($product_id) .'">' . esc_html($product->get_name()) . '</option>';
                    }
                } 
            ?>
        </div>
        <div class="options-group wrap">
            <div id="my-products-list" style="display:none"><?php echo json_encode($product_data); ?></div>
            <h3 style="
                padding-left: 20px;
                margin-bottom: 0px;
            ">Choose the products to be included in the bundle</h3>
            <p style="
                padding-left: 20px;
                margin-bottom: 0px;
            ">You can choose individual products for the bundle or select them by category</p>
            <div class="repeater-container">
                <div class="bundle-item">
                    <label class="custom-wbjbl-label">Multiple Select</label>
                        <select class="productSelect" multiple name="native-select" placeholder="Native Select" data-search="true" data-silent-initial-value-set="true">
                            <?php 
                            foreach ($products as $product_id) {
                                $product = wc_get_product($product_id);
                                if ($product) {
                                    echo '<option value="'. esc_html($product_id) .'">' . esc_html($product->get_name()) . '</option>';
                                }
                            } 
                            ?>
                        </select>
                        <button type="button" class="remove-item" style="margin-left:12px">Remove</button>
                </div>
            </div>
            <button type="button" class="add-item" style="margin-left:12px">Add Another Item</button>
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
