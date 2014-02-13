<?php
		if($_POST['kentopvc_hidden'] == 'Y') {
			//Form data sent
			

			$kento_pvc_hide = $_POST['kento_pvc_hide'];
			update_option('kento_pvc_hide', $kento_pvc_hide);
		
			$kento_pvc_posttype = $_POST['kento_pvc_posttype'];
			update_option('kento_pvc_posttype', $kento_pvc_posttype);			

			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.' ); ?></strong></p>
            </div>

			<?php
		} else {
			//Normal page display
			$kento_pvc_hide = get_option( 'kento_pvc_hide' );
			$kento_pvc_posttype = get_option( 'kento_pvc_posttype' );
		}

?>


<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__('Kento Post View Counter Settings')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="kentopvc_hidden" value="Y">
        <?php settings_fields( 'kento_pvc_plugin_options' );
				do_settings_sections( 'kento_pvc_plugin_options' );
			
		?>

<table class="form-table">
               
	<tr valign="top">
		<th scope="row">Hide Count on Post</th>
		<td style="vertical-align:middle;">
        
         
                           
                     <input type="checkbox" name="kento_pvc_hide" id="kento-pvc-hide"  value ="1" <?php if (  $kento_pvc_hide==1 ) echo "checked"; ?>> ** this will hide post count on single content but still can record data. 
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">Trace These Post Type Only</th>
		<td style="vertical-align:middle;">
        
<?php

$post_types = get_post_types( '', 'names' ); 

foreach ( $post_types as $post_type ) {

   echo '<label for="kento-pvc-posttype['.$post_type.']"><input type="checkbox" name="kento_pvc_posttype['.$post_type.']" id="kento-pvc-posttype['.$post_type.']"  value ="1" ' ?> 
   <?php if ( isset( $kento_pvc_posttype[$post_type] ) ) echo "checked"; ?>
   <?php echo' >'. $post_type.'</label><br />' ;
}
?>
                           

		</td>
	</tr>














</table>
                <p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes' ) ?>" />
                </p>
		</form>

   
</div>
