jQuery(document).ready(function(){
    const modalCount = jQuery('.modal-main-container').length;
    for(var i=1; i<=modalCount; i++){
        var modalId = '#modal_' + i;
        var modal = jQuery(modalId);
        var buttonId= '#parent_' + i;  
        var buttonEle = jQuery(buttonId);
        var closeId = '#btn_close_' + i;

        buttonEle.on('click', function(){
            const currentButtonId = jQuery(this).attr('id');
            const currentIndex = currentButtonId.split('_')[1]; 
            const currentModal = jQuery('#modal_' + currentIndex);
            const currentOverlay = jQuery('#overlay_' + currentIndex);

            currentModal.removeClass('hidden');
            currentOverlay.removeClass('hidden');
            
        });

        jQuery(closeId).on('click', function(){
            const currentCloseId = jQuery(this).attr('id');
            const currentIndex = currentCloseId.split('_')[2];
            const currentModal = jQuery('#modal_' + currentIndex);
            const currentOverlay = jQuery('#overlay_' + currentIndex);

            currentModal.addClass('hidden');
            currentOverlay.addClass('hidden');
        });

    };
    
});