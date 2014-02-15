<div class="wrap" >
	<div class="kento-pvc-by-viewed" >
<h3>Top Viewed Post</h3>
        
    <?php
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc";
	
	$result = $wpdb->get_results("SELECT * FROM $table ORDER BY count DESC LIMIT 12", ARRAY_A);
	$total_rows = $wpdb->num_rows;
	?>
	<table class='kento-pvc-top-post widefat'>
    <thead>
        <tr>
            <th scope="col" class="manage-column column-name" style=""><strong>View Count</strong></th>
            <th scope="col" class="manage-column column-name" style=""><strong>Post Title</strong></th>
        </tr>
    </thead>


    <?php


	for($i=0;$i<$total_rows;$i++)
		{
		echo "<tr><td>";
		echo $view_count = $result[$i]['count']."<br />";
		echo "</td>";
		echo "<td class='post-title'>";
		$postid= $result[$i]['postid']."<br />";
		
		echo "<a href=".get_permalink( $postid ).">";
		echo get_the_title($postid);		
		echo "</a>";
		echo "</td>";		
		echo "</tr>";

		}
	echo "</table>";
	
	?>    
</div>
<div class="kento-pvc-by-date">
<h3>Top Viewed By Date</h3>
Select Date

<input type="text" id="kento-pvc-date" name="kento_pvc_date" value="<?php echo date("Y-m-d");?>"/><br />
<div class="kento-pvc-by-date-submit">Submit</div>
	<script>
    jQuery(document).ready(function() {
        jQuery('#kento-pvc-date, #kpvc-date-referer').datepicker({
            dateFormat : 'yy-mm-dd'
        });
    });
    </script>

<div id="kento-pvc-by-date-result">
<br />
    <?php
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_info";
	$today = date("Y-m-d");
	$result = $wpdb->get_results("SELECT * FROM $table WHERE date = CURDATE() ORDER BY count DESC LIMIT 12", ARRAY_A);
	$total_rows = $wpdb->num_rows;
	?>
    
	<table class='kento-pvc-top-post widefat'>
    <thead>
        <tr>
            <th scope="col" class="manage-column column-name" style=""><strong>View Count</strong></th>
            <th scope="col" class="manage-column column-name" style=""><strong>Post Title</strong></th>
        </tr>
    </thead>
    
    
    
    
    <?php
	
	$i=0;
	while($total_rows>$i)
		{
		echo "<tr><td>";
		echo $view_count = $result[$i]['count']."<br />";
		echo "</td>";
		echo "<td class='post-title'>";
		$postid= $result[$i]['postid']."<br />";
		
		echo "<a href=".get_permalink( $postid ).">";
		echo get_the_title($postid);		
		echo "</a>";
		echo "</td>";		
		echo "</tr>";
		
		
		
		$i++;
		}
	echo "</table>";
	
	?>  
</div>  <!--kento-pvc-by-date-result -->
    
      
</div>    <!--kento-pvc-by-date -->


<div class="kento-pvc-by-city">
    <h3>Recent Viewed Post</h3>
<?php
global $wpdb;
 
$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;

if ( isset( $kss_paginate_items ) )
	{
		$limit = get_option('kss_paginate_items');
	} 
else
	{
		
	$limit = 10;
	
	}



$offset = ( $pagenum - 1 ) * $limit;
$entries = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}kento_pvc_city ORDER BY datetime DESC LIMIT $offset, $limit" );
 

 
?>

<table class="widefat" id="kss-keywords">
    <thead>
        <tr>
            <th scope="col" class="manage-column column-name" style=""><strong>City</strong></th>
            <th scope="col" class="manage-column column-name" style=""><strong>Country</strong></th>
            <th scope="col" class="manage-column column-name" style=""><strong>Post Title</strong></th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
            <th scope="col" class="manage-column column-name" style=""><strong>City</strong></th>
            <th scope="col" class="manage-column column-name" style=""><strong>Country</strong></th>
            <th scope="col" class="manage-column column-name" style=""><strong>Post Title</strong></th>
        </tr>
    </tfoot>
 
    <tbody>
        <?php if( $entries ) { ?>
 
            <?php
            $count = 1;
            $class = '';
            foreach( $entries as $entry ) {
                $class = ( $count % 2 == 0 ) ? ' class="alternate"' : '';
            ?>
 
            <tr<?php echo $class; ?>>
                <td><?php echo $entry->city; ?></td>
                <td><?php echo $entry->country; ?></td>
                <td><?php $postid = $entry->postid; ?>
                
<?php 
		echo "<a href=".get_permalink( $postid ).">";
		echo get_the_title($postid);		
		echo "</a>";
		echo "<span class='kento-pvc-by-city-details' postid='".$postid."'>  Deatils &raquo;</span>";

?>
                </td>
            </tr>
 
            <?php
                $count++;
            }
            ?>
 
        <?php } else { ?>
        <tr>
            <td colspan="2">No posts yet</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
 
<?php
 
$total = $wpdb->get_var( "SELECT COUNT(`id`) FROM {$wpdb->prefix}kento_pvc_city" );
$num_of_pages = ceil( $total / $limit );
$page_links = paginate_links( array(
    'base' => add_query_arg( 'pagenum', '%#%' ),
    'format' => '',
    'prev_text' => __( '&laquo;', 'aag' ),
    'next_text' => __( '&raquo;', 'aag' ),
    'total' => $num_of_pages,
    'current' => $pagenum
) );
 
if ( $page_links ) {
    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
}
 

?>


        
        
        
        </div>
     <!--kento-pvc-by-city-post --> 


        
        
    <div class="kento-pvc-by-city-post">
    <h3>Recent Viewed Post Details</h3>
    <div id="kento-pvc-by-city-post-result">
    Please click 'details' left to post title on "Recent Viewed by City" box
    </div> <!--kento-pvc-by-city-post -->   
        
        
        
   </div> <!--kento-pvc-by-city-post -->    




<!-- /////////////////////////////////////////////////////////////////////// -->


    <div class="kento-pvc-feedbck">
    <h3>Please send us feedback</h3>
    <div id="kento-pvc-feedbck-box">
    We are contentiously update this plugin to get more feature, We are waiting to see your reviews and feedback at <a href="http://wordpress.org/plugins/kento-post-view-counter/" >Kento Post View Counter</a><br /><br />
if you need more help please feel free to join our forum and ask any question<br />
<a href="http://kentothemes.com/support/" >KentoThemes.com Questions & Answers</a>


    </div> <!--kento-pvc-feedbck-box -->   
        
        
        
   </div> <!--kento-pvc-feedbck --> 
<!-- /////////////////////////////////////////////////////////////////////// -->









    <div class="kento-pvc-feedbck">
    <h3>Top 10 Referer</h3>
    <div id="kento-pvc-top-referer">
    <!-- 
    <input type="text" id="kpvc-date-referer" name="kpvc_date_referer" value="<?php echo date("Y-m-d");?>"/><br />
    <div class="kpvc-date-referer-submit">Submit</div><br />
    -->
    <div class="kento-pvc-top-referer-display">
	<?php
    kento_pvc_top_referer();
	?>
    </div>
    </div> <!--kento-pvc-feedbck-box -->   
        
        
        
   </div> <!--kento-pvc-feedbck --> 



    <div class="kento-pvc-geo">
    <h3>Top 10 City And Country</h3>

    	<div id="kento-pvc-top-geo">

        <select id="kento-pvc-geo" name="kento_pvc_geo">
        <option value="country">Country</option>
        <option value="city">City</option>
        </select><br /><br />
		</div>
            <div class="kento-pvc-top-geo-display">
            <?php
        
            kento_pvc_top_geo();
            ?>
            
    	</div> <!--kento-pvc-top-geo --> 
        
        
        
   </div> <!--kento-pvc-geo --> 






        
</div> <!--wrap -->
