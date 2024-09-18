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
        var currentProduct = jQuery(this).closest('.main-card-product');
        var currentProductId = currentProduct.attr('id');
        var currentvariation = jQuery(this).closest('.card');
        var currentvariationId = jQuery(currentvariation).attr('id');


        var optionName = jQuery(this).find('.option-title');
        var currentModalMain = jQuery(this).closest('.modal-main-container');
        var addItemButton = jQuery(currentModalMain).find('.item-group-front');
        var summary = jQuery(currentModalMain).closest('.summary');
        var price = jQuery(summary).find('.price');
        var currentPriceOptions = jQuery(this).find('.option-price');
        var salePrice = jQuery(currentPriceOptions).find('.option-sale');
        const match = salePrice.text().match(/\d+/);
        const selectedProductPrice = match ? parseInt(match[0], 10) : null;
        if(price.text() == ''){
            price.text(selectedProductPrice.toString()) ;
        } else {
            var previousPrice = price.text().match(/\d+/);
            var totalPrice = parseInt(previousPrice) + parseInt(selectedProductPrice);
            price.text(totalPrice.toString());
        }

        
        var displaySelectedOption = '<div class="selected-container"><button class="btn-remove">&times</button>' 
        + '<div class="selected_product">' + optionImg.html() + '<h3>' +optionName.html() + '</h3> <p class="hidden hidden-price">'
        + match 
        +'</p></div></div>';


        // insert the value in variation form based on selection
        var currentSelected = jQuery('select[name="bundle_products['+ currentProductId +'][selected]"]');
        currentSelected.val('1');
        var currentvariation = jQuery('select[name="bundle_products['+ currentProductId +'][variation_id]"]');
        currentvariation.val(currentvariationId);
        

        jQuery(addItemButton).addClass('hidden'); 
        jQuery(currentModalMain).addClass('selected'); 
        jQuery(currentModalMain).append(displaySelectedOption); 
        jQuery(this).closest('.child-modal').addClass('hidden');
        jQuery(this).closest('.modal').addClass('hidden');
        jQuery(currentModalMain).find('.overlay').addClass('hidden');
        jQuery(currentModalMain).find('.btn-remove').on('click', function(){
            var selectedContainer = jQuery(this).closest('.selected-container');
            var hiddenPrice = jQuery(selectedContainer).find('.hidden-price');
            var summaryNew = jQuery(selectedContainer).closest('.summary');
            var priceOld = jQuery(summaryNew).find('.price');
            var priceNew = parseInt(priceOld.text()) - parseInt(hiddenPrice.text());

            var currentSelected = jQuery('select[name="bundle_products[' + currentProductId + '][selected]"]');                
            currentSelected.val('0');
            var currentvariation = jQuery('select[name="bundle_products['+ currentProductId +'][variation_id]"]');
            currentvariation.val('');


            priceOld.text(priceNew.toString());
            jQuery(this).closest('.selected-container').remove();
            jQuery(this).closest('.modal-main-container').removeClass('selected');
            jQuery(addItemButton).removeClass('hidden');

        })
    });
});
