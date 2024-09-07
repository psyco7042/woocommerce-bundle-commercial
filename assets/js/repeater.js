jQuery(document).ready(function(){
    var generateOptions = jQuery("#hidden-value").html();
    var itemIndex = jQuery('.bundle-item').length;
    console.log(typeof(generateOptions));
    jQuery(".add-item").click(function(e){
        e.preventDefault();
        jQuery(".repeater-container").append(`
            <div class="bundle-item">
                    <label class="custom-wbjbl-label">Multiple Select</label>
                        <select class="productSelect" multiple name="native_select_${itemIndex}" placeholder="Native Select" data-search="true" data-silent-initial-value-set="true">
                            `+ generateOptions +`
                        </select>
                        <button type="button" class="remove-item" style="margin-left:12px">Remove</button>
                </div>
            `);
        itemIndex ++;
    });
});