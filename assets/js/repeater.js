jQuery(document).ready(function(){
    var generateOptions = jQuery("#hidden-value").html();
    var itemIndex = jQuery('.bundle-item').length;
    jQuery(".add-item").click(function(e){
        e.preventDefault();
        jQuery(".repeater-container").append(`
            <div class="bundle-item bundle-item_${itemIndex}">
                <label class="custom-wbjbl-label">Select Product Groups</label>
                <select id="productSelect_${itemIndex}" multiple name="native_select_${itemIndex}" placeholder="Native Select" data-search="true" data-silent-initial-value-set="true">`
                     + generateOptions + 
                `</select>
                <button type="button" class="remove-item" style="margin-left:12px">Remove</button>
            </div>
        `);
        VirtualSelect.init({
            ele: '#productSelect_' + itemIndex
        });

        itemIndex++;
    });
    jQuery(document).on('click', '.remove-item', function(e){
        e.preventDefault();
        jQuery(this).closest('.bundle-item').remove();
        itemIndex--;
    });
});