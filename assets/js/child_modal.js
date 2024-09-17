// jQuery(document).ready(function(){
//     var simpleLength = jQuery('.simple').length;
//     for (var i=1; i<=simpleLength; i++){
//         var simpleId = '#simple_' + i;
//         jQuery(simpleId).on('click', function(){
//             const currentModalMainContainer = jQuery(this).closest('.modal-main-container');
//             const currentModal = jQuery(this).closest('.modal');
//             const currentOverlay = currentModalMainContainer.children('.overlay');
//             const currentAddButton = currentModalMainContainer.children('.item-group-front');
//             const modalMainId = '#' + currentModalMainContainer.attr('id');
//             const currSummary = jQuery(modalMainId).closest('.summary');
//             const price = jQuery(currSummary).find('.price');
        
//             // Declare priceEntered outside the if-else block
//             var priceEntered = 0;
        
//             // selectedProduct
//             var currentProductCard = jQuery(this).closest('.card');
//             var cardHead = currentProductCard.children('.card-img');
//             var cardBody = currentProductCard.children('.card-body');
//             var cardTitle = cardBody.children('.card-title');
//             var cardPrice = cardBody.children('.product-prices');
//             var simpleRegular = cardPrice.children('.regular');
//             var simpleSale = cardPrice.children('.sale');
        
//             if (simpleSale !== undefined && simpleSale !== null) {
//                 priceEntered = parseInt(simpleSale.text().match(/\d+/)[0]); // Get the sale price
//             } else {
//                 priceEntered = parseInt(simpleRegular.text().match(/\d+/)[0]); // Get the regular price
//             }
        
//             // Update the price
//             if (price.text() === '') {
//                 price.text(priceEntered.toString());
//             } else {
//                 var simplePrevious = parseInt(price.text().match(/\d+/)[0]);
//                 var simpleNew = simplePrevious + priceEntered;
//                 priceEntered = simpleNew; 
//                 price.text(simpleNew.toString());
//             }
        
//             var displaySelected = '<div class="selected-container"><button class="btn-remove">&times</button>' + 
//                                     '<div class="selected_product">' 
//                                     + cardHead.html() 
//                                     + '<h3>' 
//                                     + cardTitle.html() + '</h3><p class="hidden hidden-price">'
//                                     + priceEntered 
//                                     + '</p> </div></div>';
        
//             // Actions performed on click
//             currentModal.addClass('hidden');
//             currentOverlay.addClass('hidden');
//             currentAddButton.addClass('hidden');
        
//             jQuery(modalMainId).addClass('selected');
//             jQuery(modalMainId).append(displaySelected);
        
//             // Remove button functionality
//             jQuery(modalMainId + "> div > button").on('click', function(){
//                 var selectedContainer = jQuery(this).closest('.selected-container');
//                 var summaryNew = jQuery(selectedContainer).closest('.summary');
//                 var priceOld = jQuery(summaryNew).find('.price');
//                 var hiddenPriceSimple = jQuery(selectedContainer).find('.hidden-price');
//                 var priceNew = parseInt(priceOld.text()) - parseInt(hiddenPriceSimple.text());
//                 priceOld.text(priceNew.toString());
//                 selectedContainer.remove();
//                 jQuery(modalMainId).removeClass('selected');
//                 currentAddButton.removeClass('hidden');
//             });
//         });
        
//     };
// });

jQuery(document).ready(function() {
    var simpleLength = jQuery('.simple').length;

    for (var i = 1; i <= simpleLength; i++) {
        var simpleId = '#simple_' + i;
        jQuery(simpleId).on('click', function() {
            const currentModalMainContainer = jQuery(this).closest('.modal-main-container');
            const currentModal = jQuery(this).closest('.modal');
            const currentOverlay = currentModalMainContainer.children('.overlay');
            const currentAddButton = currentModalMainContainer.children('.item-group-front');
            const modalMainId = '#' + currentModalMainContainer.attr('id');
            const currSummary = jQuery(modalMainId).closest('.summary');
            const price = jQuery(currSummary).find('.price');
        
            // Declare priceEntered outside the if-else block
            var priceEntered = 0;

            // selectedProduct
            var currentProductCard = jQuery(this).closest('.card');
            var cardHead = currentProductCard.children('.card-img');
            var cardBody = currentProductCard.children('.card-body');
            var cardTitle = cardBody.children('.card-title');
            var cardPrice = cardBody.children('.product-prices');
            var simpleRegular = cardPrice.children('.regular');
            var simpleSale = cardPrice.children('.sale');

            if (simpleSale.length > 0) {
                priceEntered = parseInt(simpleSale.text().match(/\d+/)[0]); // Get the sale price
            } else {
                priceEntered = parseInt(simpleRegular.text().match(/\d+/)[0]); // Get the regular price
            }

            // Update the price
            var currentPrice = parseInt(price.text()) || 0;
            var newPrice = currentPrice + priceEntered;
            price.text(newPrice.toString());

            var displaySelected = '<div class="selected-container">' +
                '<button class="btn-remove">&times</button>' +
                '<div class="selected_product">' +
                cardHead.html() +
                '<h3>' +
                cardTitle.html() + '</h3><p class="hidden hidden-price">' +
                priceEntered +
                '</p></div></div>';

            // Actions performed on click
            currentModal.addClass('hidden');
            currentOverlay.addClass('hidden');
            currentAddButton.addClass('hidden');

            jQuery(modalMainId).addClass('selected');
            jQuery(modalMainId).append(displaySelected);

            // Update form fields with selected product
            updateFormFields(modalMainId);

            // Remove button functionality
            jQuery(modalMainId + " .btn-remove").on('click', function() {
                var selectedContainer = jQuery(this).closest('.selected-container');
                var summaryNew = jQuery(selectedContainer).closest('.summary');
                var priceOld = jQuery(summaryNew).find('.price');
                var hiddenPriceSimple = jQuery(selectedContainer).find('.hidden-price');
                var priceNew = parseInt(priceOld.text()) - parseInt(hiddenPriceSimple.text());
                priceOld.text(priceNew.toString());
                selectedContainer.remove();
                jQuery(modalMainId).removeClass('selected');
                currentAddButton.removeClass('hidden');

                // Update form fields after removal
                updateFormFields(modalMainId);
            });
        });
    }

    function updateFormFields(modalMainId) {
        var selectedProducts = jQuery(modalMainId).find('.selected-container');
        var formContainer = jQuery(modalMainId).find('.bundle-form');
        
        formContainer.empty(); // Clear existing form content
        
        selectedProducts.each(function() {
            var productId = jQuery(this).find('.selected_product').data('product-id'); // Assuming you have a data attribute for product ID
            var quantity = 1; // You can adjust or calculate the quantity based on your needs

            // Append product information to the form
            formContainer.append('<input type="hidden" name="bundle_products[' + productId + '][product_id]" value="' + productId + '">' +
                '<input type="hidden" name="bundle_products[' + productId + '][quantity]" value="' + quantity + '">');
        });
    }
});
