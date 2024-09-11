jQuery(document).ready(function(){
    var simpleLength = jQuery('.simple').length;
    for (var i=1; i<=simpleLength; i++){
        var simpleId = '#simple_' + i;
        jQuery(simpleId).on('click', function(){
            const currentModalMainContainer = jQuery(this).closest('.modal-main-container');
            const modalMainHtml = currentModalMainContainer.html();
            const currentModal = jQuery(this).closest('.modal');
            const currentOverlay = currentModalMainContainer.children('.overlay');
            const modalMainId = '#' + currentModalMainContainer.attr('id');
            
            // selectedProduct
            var currentProductCard = jQuery(this).closest('.card');
            var cardHead = currentProductCard.children('.card-img');
            var cardBody = currentProductCard.children('.card-body');
            var cardTitle = cardBody.children('.card-title');
            
            var displaySelected = '<div class="selected-container"><button class="btn-remove">&times</button>' + '<div class="selected_product">' + cardHead.html() + '<h3>' +cardTitle.html() + '</h3> </div></div>';

            // Actions Performed onclick
            currentModal.addClass('hidden');
            currentOverlay.addClass('hidden');

            
            jQuery(modalMainId).addClass('selected');
            jQuery(modalMainId).html(displaySelected);
            jQuery(modalMainId + "> div > button").on('click', function(){
                jQuery(modalMainId).html(modalMainHtml);
                jQuery(modalMainId).removeClass('selected');
                // currentModal.addClass('hidden');
            });
        });
    };
});