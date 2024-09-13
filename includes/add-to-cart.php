<?php

function create_custom_add_to_cart_for_bundle(){
    check_ajax_referer('add_to_cart_ajax_nonce', 'nonce');
}
add_action('wp_ajax_custom_add_bundle_to_cart', 'create_custom_add_to_cart_for_bundle');
add_action('wp_ajax_nopriv_custom_add_bundle_to_cart', 'create_custom_add_to_cart_for_bundle');
