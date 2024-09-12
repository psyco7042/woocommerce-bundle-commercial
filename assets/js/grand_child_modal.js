jQuery(document).ready(function($) {
    jQuery('.variable').on('click', function() {
        var cardBody = jQuery(this).parent();
        
        var childModal = cardBody.find(".child-modal");
        jQuery(childModal).removeClass('hidden');
    });
    jQuery('.variable-close').on('click', function(){
        jQuery(this).closest('.child-modal').addClass('hidden');
    });
    jQuery('.option-card').on('click', function(){
        var optionImg = jQuery(this).find('.option-img');
        var optionName = jQuery(this).find('.option-title');
        var currentModalMain = jQuery(this).closest('.modal-main-container');
        var addItemButton = jQuery(currentModalMain).find('.item-group-front');
        
        var displaySelectedOption = '<div class="selected-container"><button class="btn-remove">&times</button>' + '<div class="selected_product">' + optionImg.html() + '<h3>' +optionName.html() + '</h3> </div></div>';

        jQuery(addItemButton).addClass('hidden');
        jQuery(currentModalMain).addClass('selected'); 
        jQuery(currentModalMain).append(displaySelectedOption); 
        jQuery(this).closest('.child-modal').addClass('hidden');
        jQuery(this).closest('.modal').addClass('hidden');
        jQuery(currentModalMain).find('.overlay').addClass('hidden');
        jQuery(currentModalMain).find('.btn-remove').on('click', function(){
            jQuery(this).closest('.selected-container').remove();
            jQuery(this).closest('.modal-main-container').removeClass('selected');
            jQuery(addItemButton).removeClass('hidden');
        })
    });
});
