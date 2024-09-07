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
     include_once plugin_dir_path(__FILE__) . 'includes/type-selecter.php';
     include_once plugin_dir_path(__FILE__) . 'includes/admin/admin-tab.php';
     include_once plugin_dir_path(__FILE__) . 'includes/admin/select-product.php';
 }
 add_action('plugins_loaded', 'wbjbl_woo_check');

wp_enqueue_style('main', plugins_url('assets/css/main.css', __FILE__), '', filemtime(plugin_dir_path(__FILE__) . 'assets/css/main.css'), 'all');
wp_enqueue_script('main', plugins_url('assets/js/main.js'), array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/main.js'), true);


