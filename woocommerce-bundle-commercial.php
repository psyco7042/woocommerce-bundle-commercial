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

wp_enqueue_style('virtual-select', plugins_url('assets/css/virtual-select.min.css', __FILE__), '', filemtime(plugin_dir_path(__FILE__) . 'assets/css/virtual-select.min.css'), 'all');
wp_enqueue_style('main', plugins_url('assets/css/main.css', __FILE__), array('virtual-select'), filemtime(plugin_dir_path(__FILE__) . 'assets/css/main.css'), 'all');
wp_enqueue_script('main', plugins_url('assets/js/main.js'), array('jquery', 'virtual-select'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/main.js'), true);
wp_enqueue_script('virtual-select', plugins_url('assets/js/virtual-select.min.js'), array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/virtual-select.min.js'), true);


