
<div class="wrap">
<div class="kento-pvc-by-viewed">
<h3>Top Viewed Post</h3>
        
    <?php
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc";
	
	$result = $wpdb->get_results("SELECT * FROM $table ORDER BY count DESC LIMIT 12", ARRAY_A);
	$total_rows = $wpdb->num_rows;
	
	echo "<table class='kento-pvc-top-post'>";
		echo "<tr><td>";
		echo "<strong>View Count</strong>";
		echo "</td>";
		echo "<td>";
		echo "<strong>Post Title</strong>";
		echo "</td>";		
		echo "</tr>";	

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
        jQuery('#kento-pvc-date').datepicker({
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
	
	
	echo "<table class='kento-pvc-top-post'>";
		echo "<tr><td>";
		echo "<strong>View Count</strong>";
		echo "</td>";
		echo "<td>";
		echo "<strong>Post Title</strong>";
		echo "</td>";		
		echo "</tr>";	
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
    <h3>Recent Viewed by City</h3>

    <?php
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_city";
	
	$result = $wpdb->get_results("SELECT * FROM $table ORDER BY city DESC LIMIT 12", ARRAY_A);
	$total_rows = $wpdb->num_rows;
	
	echo "<table class='kento-pvc-top-post'>";
		echo "<tr><td>";
		echo "<strong>City</strong>";
		echo "</td>";
		echo "<td>";
		echo "<strong>Country</strong>";
		echo "</td>";
		echo "<td>";
		echo "<strong>Post Title</strong>";
		echo "</td>";	
				
		echo "</tr>";	
	$i=0;
	while($total_rows>$i)
		{
		echo "<tr><td>";
		echo $view_count = $result[$i]['city'];
		echo "</td>";
		echo "<td>";
		$view_city= $result[$i]['country'];
		echo $view_city;
		echo "</td>";
		echo "<td class='post-title'>";
		$postid= $result[$i]['postid'];
		echo "<a href=".get_permalink( $postid ).">";
		echo get_the_title($postid);		
		echo "</a>";
		echo "<span class='kento-pvc-by-city-details' postid='".$postid."'>  Deatils &raquo;</span>";
		
		echo "</td>";
		echo "</tr>";

		$i++;
		}
	echo "</table>";
	
	?>        
        
        
        </div> <!--kento-pvc-by-city -->
        
        
    <div class="kento-pvc-by-city-post">
    <h3>Recent Viewed Post by City</h3>
    <div id="kento-pvc-by-city-post-result">
    Please click 'details' left to post title on "Recent Viewed by City" box
    </div> <!--kento-pvc-by-city-post -->   
        
        
        
        </div> <!--kento-pvc-by-city-post -->    
        
        
</div> <!--wrap -->
