jQuery(document).ready(function(){
	
	jQuery(".kento-pvc-by-date-submit").click(function(){
		var e=jQuery("#kento-pvc-date").val();
		jQuery.ajax({type:"POST",url:kento_pvc_ajax.kento_pvc_ajaxurl,data:{action:"kento_pvc_by_date",date:e},
		success:function(e){jQuery("#kento-pvc-by-date-result").html(e)}})});
		
		
	jQuery(".kpvc-date-referer-submit").click(function(){
		
		
		var kpvc_date_referer=jQuery("#kpvc-date-referer").val();

		jQuery.ajax({type:"POST",url:kento_pvc_ajax.kento_pvc_ajaxurl,data:{action:"kento_pvc_top_referer",kpvc_date_referer:kpvc_date_referer},
		success:function(data){


			jQuery(".kento-pvc-top-referer-display").html(data)}})});
		
		

		
		
		jQuery(".kento-pvc-by-city-details").click(function(){var e=jQuery(this).attr("postid");

jQuery.ajax({type:"POST",url:kento_pvc_ajax.kento_pvc_ajaxurl,data:{action:"kento_pvc_by_city",postid:e},success:function(e){jQuery("#kento-pvc-by-city-post-result").html(e)}

})

})


		jQuery("#kento-pvc-geo").change(function()
			{
			var kento_pvc_geo=jQuery(this).val();
			jQuery.ajax({type:"POST",url:kento_pvc_ajax.kento_pvc_ajaxurl,data:{
				action:"kento_pvc_top_geo","kento_pvc_geo":kento_pvc_geo},
				success:function(data)
					{
						jQuery(".kento-pvc-top-geo-display").html(data);
					}

			})

		})




})