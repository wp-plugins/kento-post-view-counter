<?php
/*
Plugin Name: Kento Post View Counter
Plugin URI: http://kentothemes.com
Description: Post or page view counter By City or Country or Date
Version: 1.7
Author: KentoThemes
Author URI: http://kentothemes.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function kento_pvc_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'kento_pvc_latest_jquery');

wp_enqueue_script('jquery-ui-datepicker');
//Include Javascript library
wp_enqueue_script('kento_pvc_js', plugins_url( '/js/kento-pvc.js' , __FILE__ ) , array( 'jquery' ));
// including ajax script in the plugin Myajax.ajaxurl
wp_localize_script( 'kento_pvc_js', 'kento_pvc_ajax', array( 'kento_pvc_ajaxurl' => admin_url( 'admin-ajax.php')));

define('KENTO_PVC_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


wp_enqueue_style('kento-like-post-style', KENTO_PVC_PLUGIN_PATH.'css/style.css');
wp_enqueue_style('kento-like-post-date-style', KENTO_PVC_PLUGIN_PATH.'css/jquery-ui.css');




register_activation_hook(__FILE__, kento_pvc_install());
register_uninstall_hook(__FILE__, kento_pvc_drop());


function kento_pvc_install()
	{
	global $wpdb;
        $sql = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "kento_pvc"
                 ."( UNIQUE KEY id (id),
					id int(100) NOT NULL AUTO_INCREMENT,
					postid  int(10) NOT NULL,
					count  int(10) NOT NULL)";
		$wpdb->query($sql);
		
        $sql2 = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "kento_pvc_info"
                 ."( UNIQUE KEY id (id),
					id int(100) NOT NULL AUTO_INCREMENT,
					postid  int(10) NOT NULL,
					count  int(10) NOT NULL,
					date DATE NOT NULL)";
		$wpdb->query($sql2);		
		
        $sql3 = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "kento_pvc_city"
                 ."( UNIQUE KEY id (id),
					id int(100) NOT NULL AUTO_INCREMENT,
					postid  int(10) NOT NULL,
					ip  int(10) NOT NULL,
					city varchar(100) NOT NULL,
					country varchar(100) NOT NULL,
					datetime datetime NOT NULL)";
		$wpdb->query($sql3);
		
		

		$updte_tbl = "ALTER TABLE ".$wpdb->prefix."kento_pvc_city ADD referer VARCHAR( 100 ) NOT NULL AFTER datetime";		
		$wpdb->query($updte_tbl);
		}


function kento_pvc_drop() {
	if ( get_option('kento_pvc_deletion') == 1 ) {
		
		global $wpdb;
		$table = $wpdb->prefix . "kento_pvc";
		$wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'kento_pvc');
	}
}




function kento_pvc_by_date()
	{
	$date = $_POST['date'];

	// if date is not valid form submission then query with current date(date('Y-m-d'))
	if (strtotime($date) !== false)
		{
			$date=$date;
		}
	else
		{
			$date = date('Y-m-d');
		}





	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_info";
	$result = $wpdb->get_results("SELECT * FROM $table WHERE date = '$date' ORDER BY count DESC LIMIT 12", ARRAY_A);
	$total_rows = $wpdb->num_rows;
	if($total_rows>0)
		{
	

?>

    <br />
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
			echo $result[$i]['count'];
			echo "</td>";
			echo "<td class='post-title'>";
			$postid= $result[$i]['postid'];
			
			echo '<a href="'.get_permalink( $postid ).'" >'.get_the_title( $postid ).'</a>';

			echo "</td>";		
			echo "</tr>";
			$i++;
			}
	echo "</table>";
		}
	else
		{
			echo "<br /><span class='no-result'>Result Not Found in This Date</span>";
		}
	

	die();
	return true;

	}



add_action('wp_ajax_kento_pvc_by_date', 'kento_pvc_by_date');
add_action('wp_ajax_nopriv_kento_pvc_by_date', 'kento_pvc_by_date');


function kento_pvc_by_city()
	{
		$postid = (int)$_POST['postid'];
		global $wpdb;
		$table = $wpdb->prefix . "kento_pvc_city";
		$result = $wpdb->get_results("SELECT * FROM $table WHERE postid=$postid ORDER BY datetime DESC LIMIT 12", ARRAY_A);
		$total_rows = $wpdb->num_rows;
		echo "Title: <strong>".get_the_title($postid)."</strong>";
		?>
    <br /><br />
	<table class='pvc-top-post widefat'>
    <thead>
        <tr>
            <th scope="col" class="manage-column column-name" style=""><strong>City</strong></th>
            <th scope="col" class="manage-column column-name" style=""><strong>Country</strong></th>
            <th scope="col" class="manage-column column-name" style=""><strong>Date & Time</strong></th>
            <th scope="col" class="manage-column column-name" style=""><strong>Referer</strong></th>           
        </tr>
    </thead>
        <?php

		$i=0;
		while($total_rows>$i)
			{
			echo "<tr><td>";
			echo $result[$i]['city'];
			echo "</td>";
			echo "<td>";
			echo $result[$i]['country'];
			echo "</td>";
			echo "<td>";
			echo $result[$i]['datetime'];
			echo "</td>";
			echo "<td>";
			echo $result[$i]['referer'];
			echo "</td>";
			echo "</tr>";
	
			$i++;
			}
		echo "</table>";


		
		die();
		return true;
		
		
	}
add_action('wp_ajax_kento_pvc_by_city', 'kento_pvc_by_city');
add_action('wp_ajax_nopriv_kento_pvc_by_city', 'kento_pvc_by_city');


function kento_pvc_display($cont){




$kento_pvc_posttype = get_option( 'kento_pvc_posttype' );


if($kento_pvc_posttype==NULL)
	{
		$type ="test";
	}
else
	{
	foreach ( $kento_pvc_posttype as  $post_type => $post_type_value )
		{
	
		$type .= $post_type.",";
		
		}
	}


if(is_singular(explode(',',$type))){
	
	$post_id = get_the_id();
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc";
	
	$result = $wpdb->get_results("SELECT count FROM $table WHERE postid = $post_id", ARRAY_A);
	$view_count = $result[0]['count'];
	$already_insert = $wpdb->num_rows;
	
	
	if($already_insert > 0 )
		{
			$wpdb->query("UPDATE $table SET count = count+1 WHERE postid = $post_id");

		}
	else
		{
			$wpdb->query( $wpdb->prepare("INSERT INTO $table 
										( id, postid, count )
								VALUES	( %d, %d, %d )",
								array	( '', $post_id,1)
										));

		}

	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_info";
	
	$result = $wpdb->get_results("SELECT * FROM $table WHERE date = CURDATE() AND postid = $post_id", ARRAY_A);
	$already_insert = $wpdb->num_rows;

	if($already_insert > 0 )
		{
			global $wpdb;
			$table = $wpdb->prefix . "kento_pvc_info";
			$wpdb->query("UPDATE $table SET count = count+1 WHERE date = CURDATE() AND postid = $post_id");
			

		}
	else
		{
			global $wpdb;
			$table = $wpdb->prefix."kento_pvc_info";
			$wpdb->query( $wpdb->prepare("INSERT INTO $table 
										( id, postid, count, date )
								VALUES	( %d, %d, %d, %s)",
								array	( '', $post_id, 1, date('Y-m-d'))
										));
			
			

		}

$ip = $_SERVER['REMOTE_ADDR'];
$content = file_get_contents("http://www.geoplugin.net/xml.gp?ip=".$ip);
preg_match('/<geoplugin_city>(.*)/i', $content, $matches);
$city = !empty($matches[1]) ? $matches[1] : 0;
$city = substr($city,0,-17);

if($city == "")
	{
	$city = "none";
	}
else
	{
	$city = $city;
	}
preg_match('/<geoplugin_countryName>(.*)/i', $content, $matches);
$country= !empty($matches[1]) ? $matches[1] : 0;
$country = substr($country,0,-24);

if($country == ""){
	$country = "none";}
else {
	$country = $country;
	}

	global $wpdb;
	$table = $wpdb->prefix."kento_pvc_city";
	$post_id = get_the_id();
	$referer = get_referer($_SERVER["HTTP_REFERER"]);
	$wpdb->query( $wpdb->prepare("INSERT INTO $table 
								( id, postid, ip, city, country, datetime, referer )
						VALUES	( %d, %d, %s, %s, %s, %s, %s)",
						array	( '', $post_id, $ip, $city, $country, date('Y-m-d H:i:s'),$referer)
								));
	
	



global $wpdb;
$table = $wpdb->prefix . "kento_pvc";
$result = $wpdb->get_results("SELECT count FROM $table WHERE postid = $post_id", ARRAY_A);

$view_count = $result[0]['count'];
if($view_count==0)
	{
		$view_count = 1;
	}





$cont.= "<div id='kento-pvc'><span class='kento-pvc-total'> ".($view_count)." Total Views</span> <span class='kento-pvc-today'>".kento_pvc_today_total()." Views Today</span>";

$cont.=  "</div>";



return $cont;


	}
else
	{
	return $cont;
	}

}


add_filter('the_content', 'kento_pvc_display');




function get_referer($url)
{
  $pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : '';
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $regs['domain'];
  }
  return "None";
}









function kento_pvc_today_total()
	{
	
	global $wpdb;
	$table = $wpdb->prefix . "kento_pvc_info";
	$post_id = get_the_id();
	$result = $wpdb->get_results("SELECT * FROM $table WHERE postid = $post_id AND date=CURDATE()", ARRAY_A);
	$view_count = $result[0]['count'];
	
if($view_count==0)
	{
		$view_count = 1;
	}

	return $view_count;
	
	}





function kento_pvc_style()
	{
		$kento_pvc_hide = get_option( 'kento_pvc_hide' );
		if($kento_pvc_hide==1)
		{
		echo "<style type='text/css'>";
		
		echo "#kento-pvc{
			display:none;
			
			}";
		
		echo "</style>";
		}
	}

add_filter('wp_head', 'kento_pvc_style');


function kpvc_display_single($atts,  $content = null ) {
		$atts = shortcode_atts(
			array(
				'today' => "yes",
				'today_text' => "Views Today ",
				
				'total' => "yes",
				'total_text' => "Total Views ",				

				), $atts);


			$post_id = get_the_ID();
			global $wpdb;
			$table = $wpdb->prefix . "kento_pvc";
			$result = $wpdb->get_results("SELECT count FROM $table WHERE postid = $post_id", ARRAY_A);

			$view_count = $result[0]['count'];
			if($view_count==0)
			{
			$view_count = 1;
			}



			$kpvc.= "<div id='kento-pvc-single'>";
			if($atts['today']=="yes")
				{
			$kpvc.= "<span class='kento-pvc-today'>".kento_pvc_today_total()." ".$atts['today_text']."</span>";

				}
			if($atts['total']=="yes")
				{
			$kpvc.= "<span class='kento-pvc-total'> ".($view_count)." ".$atts['total_text']." </span>";
				}
			$kpvc.=  "</div>";



			return $kpvc;

			
			}

add_shortcode('kpvc_single', 'kpvc_display_single');







function kento_pvc_top_referer()
	{	
		
		global $wpdb;
		$table = $wpdb->prefix . "kento_pvc_city";
		
		
		$date = $_POST['kpvc_date_referer'];
		if(isset($date))
			{
				$result = $wpdb->get_results("SELECT referer FROM $table GROUP BY referer ORDER BY COUNT(referer) DESC LIMIT 10", ARRAY_A);
				$total_rows = $wpdb->num_rows;
			}
		else
			{
				$result = $wpdb->get_results("SELECT referer FROM $table GROUP BY referer ORDER BY COUNT(referer) DESC LIMIT 10", ARRAY_A);
				$total_rows = $wpdb->num_rows;
			
			}

		


		
		
		$referer.= "<table class='pvc-top-referer widefat'>";
		$referer.= "<thead><tr>";
		$referer.= "<th scope='col' class='manage-column column-name' ><strong>Domain Name</strong></th></tr></thead>";
		$referer.= "<tfoot><tr>";
		$referer.= "<th scope='col' class='manage-column column-name' ><strong>Domain Name</strong></th></tr></tfoot>";
		

		
		$i=0;
		while($total_rows>$i)
			{	
				if($result[$i]['referer']=="None" || $result[$i]['referer']==NULL  )
					{

					}
				else
					{
					$referer.= "<tr><td>";
					$referer.= "<a href='http://".$result[$i]['referer']."' >";
					$referer.= $result[$i]['referer'];
					$referer.= "</a>";
					$referer.= "</td></tr>";
					}
				
				$i++;
			}
			
			$referer.= "</table>";


	echo $referer;
	
		if(isset($date))
			{
			
			die();
			}

	
	}

add_action('wp_ajax_kento_pvc_top_referer', 'kento_pvc_top_referer');
add_action('wp_ajax_nopriv_kento_pvc_top_referer', 'kento_pvc_top_referer');













function kpvc_display_loop($atts) {
		$atts = shortcode_atts(
			array(
				'today' => "yes",
				'today_text' => "Views Today ",
				
				'total' => "yes",
				'total_text' => "Total Views ",
				'post_id' => "",
				

				), $atts);


			$post_id = $atts['post_id'];
			global $wpdb;
			$table = $wpdb->prefix . "kento_pvc";
			$result = $wpdb->get_results("SELECT count FROM $table WHERE postid = $post_id", ARRAY_A);

			$view_count = $result[0]['count'];
			if($view_count==0)
			{
			$view_count = 1;
			}



			$kpvc.= "<div id='kento-pvc-loop'>";
			if($atts['today']=="yes")
				{

			$kpvc.= "<span class='kento-pvc-today'>".kento_pvc_today_total()." ".$atts['today_text']."</span>";
				}

			if($atts['total']=="yes")
				{
			$kpvc.= "<span class='kento-pvc-total'> ".($view_count)." ".$atts['total_text']." </span>";
				}

			$kpvc.=  "</div>";




			echo $kpvc;

			
			}


add_shortcode('kpvc_loop', 'kpvc_display_loop');




































///////////////////////////////////////

////////////////////////////////////////////////////////////

add_action('admin_init', 'kento_pvc_init' );
add_action('admin_menu', 'kento_pvc_menu');

function kento_pvc_init(){
	register_setting( 'kento_pvc_plugin_options', 'kento_pvc_hide');
	register_setting( 'kento_pvc_plugin_options', 'kento_pvc_posttype');
    }
	
	
function kento_pvc_menu() {
	add_menu_page(__('Kento Post View Counter Settings','kentopvc'), __('Kento PVC','kentopvc'), 'manage_options', 'kentopvc_settings', 'kento_pvc_settings');
	
add_submenu_page('kentopvc_settings', __('Kento PVC Stats','menu-test'), __('Stats','menu-test'), 'manage_options', 'kento_pvc_settings_stats', 'kento_pvc_settings_stats');

}


function kento_pvc_settings(){
	include('kento-pvc-admin.php');
}

function kento_pvc_settings_stats(){
	include('kento-pvc-admin-stats.php');
}












?>