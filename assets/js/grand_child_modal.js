jQuery(document).ready(function($) {
    jQuery('.variable').on('click', function() {
        var cardBody = jQuery(this).parent();
        
        var childModal = cardBody.find(".child-modal");
        jQuery(childModal).removeClass('hidden');
    });
    jQuery('.variable-close').on('click', function(){
        jQuery(this).closest('.child-modal').addClass('hidden');
    });
});
