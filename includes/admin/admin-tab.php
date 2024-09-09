<?php
/**
 * register the admin menu tab for the bundle produt type
 * 
 * @see https://webkul.com/blog/create-a-custom-product-type-in-woocommerce/
 */

 function wbjbl_add_custom_product_data_tab($tabs) {
    $tabs['custom'] = array(
        'label'    => __('Bundle Data', 'woocommerce'),
        'target'   => 'wbjbl_bundle_data',
        'class'    => array('show_if_custom'),
        'priority' => 21,
    );
    return $tabs;
}
add_filter('woocommerce_product_data_tabs', 'wbjbl_add_custom_product_data_tab');

