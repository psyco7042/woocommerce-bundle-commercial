jQuery(document).ready(function($) {
    $('#add-bundle-button').on('click', function() {
        var bundleId = $(this).data('bundle-id');
        var quantity = $('#bundle-quantity').val();
        
        $.ajax({
            type: 'POST',
            url: wc_add_to_cart_params.ajax_url,
            data: {
                action: 'custom_add_bundle_to_cart',
                nonce: wc_add_to_cart_params.ajax_nonce,
                bundle_id: bundleId,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    alert(response.data.message);
                } else {
                    alert(response.data.message);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });
});
