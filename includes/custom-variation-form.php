<?php
add_action( 'woocommerce_after_single_product_summary', 'display_bundle_form', 10 );

function display_bundle_form() {
    global $post;
    $main_product_id = $post->ID;
    
    $bundle_data = get_post_meta( $main_product_id, 'wbjbl_bundle_info', true );
    
    if ( is_string( $bundle_data ) ) {
        $bundle_data = unserialize( $bundle_data );
    }
    
    if ( is_array( $bundle_data ) && ! empty( $bundle_data ) ) {
        $product_ids = array();
        foreach ( $bundle_data as $id_list ) {
            $product_ids = array_merge( $product_ids, explode( ',', $id_list ) );
        }
        $product_ids = array_map( 'intval', array_unique( $product_ids ) );
        
        ?>
        <form id="bundle-form" method="post" action="">
            <input type="hidden" name="main_product_id" value="<?php echo esc_attr( $main_product_id ); ?>" />
            <div class="bundle-products">
                <?php foreach ( $product_ids as $product_id ) : ?>
                    <div class="bundle-product">
                        <?php
                        $product = wc_get_product( $product_id );
                        if ( $product ) {
                            ?>
                            <select name="bundle_products[<?php echo esc_attr( $product_id ); ?>][product_id]">
                                <option value="<?php echo esc_attr( $product_id ); ?>"><?php echo esc_html( get_the_title( $product_id ) ); ?></option>
                            </select>

                            <select name="bundle_products[<?php echo esc_attr( $product_id ); ?>][selected]">
                                <option value="0">Not Selected</option>
                                <option value="1">Selected</option>
                            </select>
                            
                            <?php
                            if ( $product->is_type( 'variable' ) ) {
                                $available_variations = $product->get_available_variations();
                                ?>
                                <select name="bundle_products[<?php echo esc_attr( $product_id ); ?>][variation_id]">
                                    <option value="">Select Product Variation</option>
                                    <?php foreach ( $available_variations as $variation ) : ?>
                                        <option value="<?php echo esc_attr( $variation['variation_id'] ); ?>">
                                            <?php echo esc_html( implode( ', ', $variation['attributes'] ) ); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php
                            } else {
                                ?>
                                <input type="hidden" name="bundle_products[<?php echo esc_attr( $product_id ); ?>][variation_id]" value="0" />
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <br>
                <?php endforeach; ?>
            </div>
            
            <div class="bundle-quantity">
                <label for="bundle_quantity">Quantity for the entire bundle:</label>
                <input type="number" id="bundle_quantity" name="bundle_quantity" value="1" min="1" />
            </div>
            
            <input type="submit" name="add_to_cart" value="Add Bundle to Cart" />
        </form>
        <?php
    } else {
        echo '<p>No products found for this bundle.</p>';
    }
}









add_action( 'wp_loaded', 'handle_bundle_form_submission' );

function handle_bundle_form_submission() {
    if ( isset( $_POST['add_to_cart'] ) && isset( $_POST['bundle_quantity'] ) && isset( $_POST['main_product_id'] ) ) {
        $bundle_quantity = intval( $_POST['bundle_quantity'] );
        $main_product_id = intval( $_POST['main_product_id'] );

        if ( $bundle_quantity > 0 && $main_product_id > 0 ) {
            // Retrieve the main product
            $main_product = wc_get_product( $main_product_id );
            if ( $main_product ) {
                // Prepare cart item data to bypass quantity validation
                $cart_item_data = array(
                    'data' => $main_product,
                    'quantity' => $bundle_quantity,
                    'variation' => isset( $_POST['main_product_variation_id'] ) ? array( 'variation_id' => intval( $_POST['main_product_variation_id'] ) ) : array(),
                );

                // Add the main product to the cart
                WC()->cart->add_to_cart( $main_product_id, $bundle_quantity, $cart_item_data['variation']['variation_id'], array(), $cart_item_data );

                // Handle bundled products
                $bundle_products = isset( $_POST['bundle_products'] ) ? $_POST['bundle_products'] : array();
                
                foreach ( $bundle_products as $product_id => $bundle_info ) {
                    if ( isset( $bundle_info['selected'] ) && $bundle_info['selected'] == '1' ) {
                        $product = wc_get_product( $product_id );
                        if ( $product ) {
                            $variation_id = isset( $bundle_info['variation_id'] ) ? intval( $bundle_info['variation_id'] ) : 0;
                            $quantity = $bundle_quantity; // Set quantity for each product in the bundle
                            
                            // Add each bundle product to the cart
                            $added = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
                            
                            if ( !$added ) {
                                wc_add_notice( __( 'There was a problem adding a bundle product to your cart.', 'woocommerce' ), 'error' );
                                return; // Stop processing if any bundle product fails to add
                            }
                        }
                    }
                }

                // Redirect to the cart page
                wp_safe_redirect( wc_get_cart_url() );
                exit;
            } else {
                wc_add_notice( __( 'The main product is not valid.', 'woocommerce' ), 'error' );
            }
        } else {
            wc_add_notice( __( 'The quantity for the bundle must be greater than zero, and the main product must be valid.', 'woocommerce' ), 'error' );
        }
    }
}

// add_action( 'wp_loaded', 'handle_bundle_form_submission' );

// function handle_bundle_form_submission() {
//     if ( isset( $_POST['add_to_cart'] ) && isset( $_POST['bundle_quantity'] ) && isset( $_POST['main_product_id'] ) ) {
//         $bundle_quantity = intval( $_POST['bundle_quantity'] );
//         $main_product_id = intval( $_POST['main_product_id'] );
        
//         if ( $bundle_quantity > 0 && $main_product_id > 0 ) {
//             // Add the bundle products to the cart
//             $bundle_products = isset( $_POST['bundle_products'] ) ? $_POST['bundle_products'] : array();
            
//             foreach ( $bundle_products as $product_id => $bundle_info ) {
//                 if ( isset( $bundle_info['selected'] ) && $bundle_info['selected'] == '1' ) {
//                     $product = wc_get_product( $product_id );
//                     if ( $product ) {
//                         $variation_id = isset( $bundle_info['variation_id'] ) ? intval( $bundle_info['variation_id'] ) : 0;
//                         $quantity = $bundle_quantity; // Set quantity for each product in the bundle
                        
//                         // Add each bundle product to the cart
//                         $added = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
                        
//                         if ( !$added ) {
//                             wc_add_notice( __( 'There was a problem adding the product to your cart.', 'woocommerce' ), 'error' );
//                             return; // Stop processing if any product fails to add
//                         }
//                     }
//                 }
//             }
            
//             // Redirect to the cart page
//             wp_safe_redirect( wc_get_cart_url() );
//             exit;
//         } else {
//             wc_add_notice( __( 'The quantity for the bundle must be greater than zero, and the main product must be valid.', 'woocommerce' ), 'error' );
//         }
//     }
// }


// function add_bundle_to_cart($cart_item_data, $product_id) {
//     // Assuming you have a way to get bundled product IDs
//     if (isset($_POST['bundle_products'])) {
//         $cart_item_data['bundle_products'] = $_POST['bundle_products'];
//         $cart_item_data['unique_key'] = md5(microtime().rand()); // Ensure unique key for grouping
//     }
//     return $cart_item_data;
// }
// add_filter('woocommerce_add_cart_item_data', 'add_bundle_to_cart', 10, 2);

// function display_bundle_in_cart($item_name, $cart_item, $cart_item_key) {
//     // Check if this item is part of a bundle
//     if (isset($cart_item['bundle_products'])) {
//         $item_name = '<strong>' . esc_html($cart_item['data']->get_name()) . '</strong>'; // Display bundle name

//         // Loop through each product in the bundle
//         foreach ($cart_item['bundle_products'] as $product_id) {
//             $item_name .= '<br><small>' . esc_html(get_the_title($product_id)) . '</small>'; // Display each product in the bundle
//         }
//     }
//     return $item_name;
// }
// add_filter('woocommerce_cart_item_name', 'display_bundle_in_cart', 10, 3);