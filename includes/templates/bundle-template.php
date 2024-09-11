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
        echo '<div class="item-container-main" style="display:flex; gap:20px">';
        $i = 1;
        foreach($product_info as $item_nfo){
            ?>
                <div class="modal-main-container" id="modal_container_<?php echo $i; ?>">
                    <div class="modal hidden" id="modal_<?php echo $i; ?>">
                        <div class="modal-header">
                            <h5>Please select your Product</h5>
                            <button class="btn" id="btn_close_<?php echo $i; ?>">&times</button>
                        </div>
                        <div class="products-container">
                            <?php 
                                $elements = explode(',', $item_nfo);
                                foreach ($elements as $element) {
                                    $product = wc_get_product($element);
                                    if ($product) {       
                                        $currency = get_woocommerce_currency();                                 
                                        ?>
                                        <div class="card">
                                            <div class="card-img">
                                                <?php
                                                $image = wp_get_attachment_image_src($product->get_image_id(), 'single-post-thumbnail');
                                                if ($image && !empty($image[0])) {
                                                    // Image exists, display it
                                                    ?>
                                                    <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                                    <?php
                                                } else {
                                                    // No image, display message
                                                    ?>
                                                    <div class="no-img" style="height:229px;display:flex;align-items:center;justify-content:center;">
                                                        <?php echo 'no image present'; ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="card-title"><?php echo esc_html($product->get_name()); ?></h3>
                                                    <?php
                                                        if ($product->is_type('variable')){
                                                            $variable_number = 1;
                                                            echo '<button class="btn variable" id="variable_'. $variable_number .'">select options</button>';
                                                            $variations = $product->get_available_variations();
                                                            if (!empty($variations)) {
                                                                ?>
                                                                    <div class="child-modal-container">
                                                                        <div class="clild-modal hidden">
                                                                            <div class="variation-container">
                                                                                <?php
                                                                                    foreach ($variations as $variation) {
                                                                                        $variation_id = $variation['variation_id'];
                                                                                        $variation_product = wc_get_product($variation_id);
                                                                                        $variation_image_id = $variation_product->get_image_id();
                                                                                        $variation_image_url = wp_get_attachment_url($variation_image_id);
                                                                                        $attributes = $variation_product->get_attributes();
                                                                                        ?>
                                                                                            <div class="card">
                                                                                                <div class="card-img">
                                                                                                    <img src="<?php echo $variation_image_url ?>" alt="<?php echo esc_attr($variation_product->get_name()); ?>">
                                                                                                </div>
                                                                                                <div class="card-body">
                                                                                                    <h3 class="card-title">
                                                                                                        <?php
                                                                                                            foreach ($attributes as $taxonomy => $value) {
                                                                                                                if (strpos($taxonomy, 'pa_') !== false) {
                                                                                                                    $attribute_name = wc_attribute_label($taxonomy);
                                                                                                                    $attribute_value = $value;
                                                                                                                    $formatted_value = ucfirst($attribute_value); 
                                                                                                                    echo esc_html($product->get_name()) . ' ' . $attribute_value;
                                                                                                                } else {
                                                                                                                    $attribute_name = ucfirst($taxonomy); 
                                                                                                                    $attribute_value = $value; 
                                                                                                                    
                                                                                                                    echo esc_html($product->get_name()) . ' ' . $attribute_value;
                                                                                                                }
                                                                                                                
                                                                                                            }
                                                                                                        ?>
                                                                                                    </h3>
                                                                                                    <div class="product-prices">
                                                                                                        <p class="regular"><?php echo $currency . ' ' . $variation_product->get_regular_price() . '/-';?></p>
                                                                                                        <p><?php echo $currency . ' ' . $variation_product->get_sale_price() . '/-';?></p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                            }
                                                            $variable_number++;
                                                        } else {
                                                            $product_number = 1;
                                                            ?>
                                                                <div class="product-prices">
                                                                    <p class="regular"><?php echo wc_price($product->get_regular_price()); ?></p>
                                                                    <p><?php echo wc_price($product->get_sale_price());?></p>
                                                                </div>
                                                                <button class="btn simple" id="simple_<?php echo $product_number?>">add to selection</button>
                                                            <?php
                                                            $product_number++;
                                                        }
                                                    ?>
                                                
                                                
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                
                            ?>
                        </div>
                    </div>
                    <div class="overlay hidden" id="overlay_<?php echo $i; ?>"></div>
                    <div class="item-group-front" id="add-item_<?php echo $i?>">
                        <button class="btn btn-open" id="parent_<?php echo $i;?>">
                        <svg height="25pt" viewBox="0 0 480 480" width="25pt" xmlns="http://www.w3.org/2000/svg">
                            <path d="m56 288h136v136c0 26.507812 21.492188 48 48 48s48-21.492188 48-48v-136h136c26.507812 0 48-21.492188 48-48s-21.492188-48-48-48h-136v-136c0-26.507812-21.492188-48-48-48s-48 21.492188-48 48v136h-136c-26.507812 0-48 21.492188-48 48s21.492188 48 48 48zm0 0" fill="#ADADAD"/>
                            <path d="m240 480c-30.914062-.035156-55.964844-25.085938-56-56v-128h-128c-30.929688 0-56-25.070312-56-56s25.070312-56 56-56h128v-128c0-30.929688 25.070312-56 56-56s56 25.070312 56 56v128h128c30.929688 0 56 25.070312 56 56s-25.070312 56-56 56h-128v128c-.035156 30.914062-25.085938 55.964844-56 56zm-184-280c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8zm0 0" fill="#000"/>
                        </svg>
                        </button>
                    </div>
                </div>
            <?php
            $i++;
        }
        echo '</div>';
    }
 }
 add_action( 'woocommerce_single_product_summary', 'wbjbl_product_bundle_front' );