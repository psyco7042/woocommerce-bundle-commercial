<?php
/**
 * plugin Name: Woocommerce Bundle by Jbulls
 * author: Priyam Sengupta
 * version: 1.0.0
 * author uri: https://github.com/psyco7042/woocommerce-commercial-bundle
 * description: add a bundle type product in your woocommerce product types that allows you to sell a group of products in a same time
 * 
 */

 if(!defined('ABSPATH')){
    header("location: /");
    die();
 }

 function wbjbl_woo_check(){
    if(!class_exists('WooCommerce')){
        return;
     }
     include_once plugin_dir_path(__FILE__) . 'includes/register-bundle.php';
     include_once plugin_dir_path(__FILE__) . 'includes/remove-form.php';
     include_once plugin_dir_path(__FILE__) . 'includes/custom-variation-form.php';
     include_once plugin_dir_path(__FILE__) . 'includes/test-form.php';
     include_once plugin_dir_path(__FILE__) . 'includes/type-selecter.php';
     include_once plugin_dir_path(__FILE__) . 'includes/admin/admin-tab.php';
     include_once plugin_dir_path(__FILE__) . 'includes/admin/select-product.php';
     include_once plugin_dir_path(__FILE__) . 'includes/save-data.php';
     include_once plugin_dir_path(__FILE__) . 'includes/templates/bundle-template.php';
     include_once plugin_dir_path(__FILE__) . 'includes/add-to-cart.php';
 }
 add_action('plugins_loaded', 'wbjbl_woo_check');

 function wbcplugin_ajaxurl(){
   echo '<script> var ajaxurl = "'. admin_url('admin_ajax.php') .'"</script>';
 } 
 add_action('wp_head', 'wbcplugin_ajaxurl');

wp_enqueue_style('virtual-select', plugins_url('assets/css/virtual-select.min.css', __FILE__), '', filemtime(plugin_dir_path(__FILE__) . 'assets/css/virtual-select.min.css'), 'all');
wp_enqueue_style('main', plugins_url('assets/css/main.css', __FILE__), array('virtual-select'), filemtime(plugin_dir_path(__FILE__) . 'assets/css/main.css'), 'all');
wp_enqueue_script('main', plugins_url('assets/js/main.js'), array('jquery', 'virtual-select'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/main.js'), true);
wp_enqueue_script('virtual-select', plugins_url('assets/js/virtual-select.min.js', __FILE__), array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/virtual-select.min.js'), true);
wp_enqueue_script('repeater', plugins_url('assets/js/repeater.js', __FILE__), array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/repeater.js'), true);
wp_enqueue_script('parent-modal', plugins_url('assets/js/parent_modal.js', __FILE__), array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/parent_modal.js'), true);
wp_enqueue_script('child-modal', plugins_url('assets/js/child_modal.js', __FILE__), array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/child_modal.js'), true);
wp_enqueue_script('grand-child-modal', plugins_url('assets/js/grand_child_modal.js', __FILE__), array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/grand_child_modal.js'), true);
wp_enqueue_script('variation-form-handler', plugins_url('assets/js/variation-form-handler.js', __FILE__), array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/variation-form-handler.js'), true);





function wh_custom_admin_custom_js() {

   if ('product' != get_post_type()) :
       return;
   endif;
   ?>
   <script type='text/javascript'>
       jQuery(document).ready(function () {
           //for Price tab
           jQuery('.product_data_tabs .general_tab').addClass('show_if_custom').show();
           jQuery('#general_product_data .pricing').addClass('show_if_custom').show();
           //for Inventory tab
           jQuery('.inventory_options').addClass('show_if_custom').show();
           jQuery('#inventory_product_data ._manage_stock_field').addClass('show_if_custom').show();
           jQuery('#inventory_product_data ._sold_individually_field').parent().addClass('show_if_custom').show();
           jQuery('#inventory_product_data ._sold_individually_field').addClass('show_if_custom').show();
       });
   </script>
   <?php

}

add_action('admin_footer', 'wh_custom_admin_custom_js');