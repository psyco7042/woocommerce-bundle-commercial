jQuery(document).ready(function(){
    var simpleLength = jQuery('.simple').length;
    for (var i=1; i<=simpleLength; i++){
        var simpleId = '#simple_' + i;
        jQuery(simpleId).on('click', function(){
            const currentModalMainContainer = jQuery(this).closest('.modal-main-container');
            const currentModal = jQuery(this).closest('.modal');
            const currentOverlay = currentModalMainContainer.children('.overlay');
            const currentAddButton = currentModalMainContainer.children('.item-group-front');
            const modalMainId = '#' + currentModalMainContainer.attr('id');
            const currSummary = jQuery(modalMainId).closest('.summary');
            const price = jQuery(currSummary).find('.price');

            
            // selectedProduct
            var currentProductCard = jQuery(this).closest('.card');
            var cardHead = currentProductCard.children('.card-img');
            var cardBody = currentProductCard.children('.card-body');
            var cardTitle = cardBody.children('.card-title');
            var cardPrice = cardBody.children('.product-prices');
            var simpleRegular = cardPrice.children('.regular');
            var simpleSale = cardPrice.children('.sale');
            var priceEntered = 0;
            if(simpleSale !== undefined && simpleSale !== null){
                if(price.text() == ''){
                    price.text(simpleSale.text().match(/\d+/)[0].toString());
                } else{
                    priceEntered = simpleSale.text().match(/\d+/)[0];
                    var simplePrevious = price.text().match(/\d+/);
                    var simpleNew = parseInt(simplePrevious) + parseInt(priceEntered);
                    price.text(simpleNew.toString());
                }
            } else {
                if(price.text() == ''){
                    price.text(simpleRegular.text().match(/\d+/)[0].toString());
                } else{
                    priceEntered = simpleRegular.text().match(/\d+/)[0];
                    var simplePrevious = price.text().match(/\d+/);
                    var simpleNew = parseInt(simplePrevious) + parseInt(priceEntered);
                    price.text(simpleNew.toString());
                }
            }
            var displaySelected = '<div class="selected-container"><button class="btn-remove">&times</button>' + '<div class="selected_product">' 
                                    + cardHead.html() 
                                    + '<h3>' 
                                    +cardTitle.html() + '</h3><p class="hidden hidden-price">'
                                    +'</p> </div></div>';

            // Actions Performed onclick
            currentModal.addClass('hidden');
            currentOverlay.addClass('hidden');
            currentAddButton.addClass('hidden');
            

            
            jQuery(modalMainId).addClass('selected');
            jQuery(modalMainId).append(displaySelected);
            jQuery(modalMainId + "> div > button").on('click', function(){

                jQuery(this).closest('.selected-container').remove();
                jQuery(modalMainId).removeClass('selected');
                currentAddButton.removeClass('hidden');
            });
        });
    };
});