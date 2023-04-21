(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

function wai_start_syncing_process(){
	jQuery("#wai-btn-spinner").css("display","inline-block");

	var acf_val_1 = jQuery("#wai-acf-1-select").val();
	var acf_val_2 = jQuery("#wai-acf-2-select").val();
	var acf_val_3 = jQuery("#wai-acf-3-select").val();

	var acf_arr = [];
	
	if(acf_val_1 != ""){
		acf_arr.push(acf_val_1);
	}

	if(acf_val_2 != ""){
		acf_arr.push(acf_val_2);
	}

	if(acf_val_3 != ""){
		acf_arr.push(acf_val_3);
	}

	if(acf_arr.length == 0){
		Swal.fire(
			{
				position: "center",
				icon: "error",
				title: "Please select atleast one ACF field.",
				showConfirmButton: true,
			}
		);
		jQuery("#wai-btn-spinner").css("display","none");
	} else {
		var data = {
			action: "wai_sync_woo_images_to_acf",
			acf_arr: JSON.stringify(acf_arr),
		};

		jQuery.ajax(
			{
				type: "POST",
				url: ajaxurl,
				dataType: "json",
				data: data,
				success: function (success) {
					if (success.success == "yes") {
						Swal.fire(
							{
								position: "center",
								icon: "success",
								title: "Syncing has been completed successfully.",
								showConfirmButton: true,
							}
						);
					}
					jQuery("#wai-btn-spinner").css("display","none");
				},
				error: function () {
					Swal.fire(
						{
							position: "center",
							icon: "error",
							title: "An unexpected error occured. Please try again later.",
							showConfirmButton: true,
						}
					);
					jQuery("#wai-btn-spinner").css("display","none");
				},
			}
		);
	}

}