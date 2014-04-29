<?php
/**
 * Plugin Name: LinkedIN API
 * Plugin URI: http://www.Teambuktoo.com/contact/
 * Description: LinkedIN Api develped by Khadime Diakhate Teambuktoo
 * Author: SkyVerge
 * Author URI: http://www.Teambuktoo.com
 * Version: 1.0
 *
 * Copyright: (c) 2013 Teambuktoo, Inc. (hello@teambuktoo.com)
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @author    Khadime Diakhate Teambuktoo
 * @category  Custom
 * @copyright Copyright (c) 2014, Teambuktoo, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

// Including the DB connection file:
define("INCLUDE_CHECK",1);
require 'connect.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>LinkedIn OAuth in PHP by Khadime Diakhate</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="styles.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="script.js"></script>

    <style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body>
  
  
  <div id="main">
	<h1>Access LinkedIN Data Api by Khadime Diakhate</h1>
	
    <?php
	
		  $colors = array('green','blue','chreme');
echo '<div style="width:80px; height:80px; width:10%; float:left; margin:4px; padding; 2px;" class="eventHeading '.$colors[1].'"><img src="'; echo $content['person']['picture-url'];echo'"></div>';

echo '<div style="float:left;margin-left:4px; width:80%"';
				echo '<br />';
				echo "Headline :"; echo $content['person'][headline];  
				echo "<br>"; 
				echo "First name :"; echo $content['person']['first-name'];  
				echo "<br>";
				echo "Last name :"; echo $content['person']['last-name'];
				echo "<br>";
                echo "Main address :"; echo $content['person']['main-address']; 
			    echo "<br>";
			    echo "Email :"; echo $content['person']['email-address'];  
				echo "<br>";
				echo "Phone type :"; echo $content['person']['phone-numbers']['phone-number']['phone-type'];
				echo "<br>";
				echo "Phone numbers :"; echo $content['person']['phone-numbers']['phone-number']['phone-number'];
				echo "<br>";
                echo "Skype :"; echo $content['person']['im-accounts']['im-account']['im-account-name'];
			    echo "<br>";
				echo "Interests :"; echo $content['person']['interests'];
			    echo "<br>";
				//echo "Position :"; print_r ($content['person']['positions']['position']);
				//$positions=array();
				echo $post1= $content['person']['positions']['position']['company'];
			 			    echo "<br>";
							echo "From :"; echo $content['person']['positions']['position']['start-date']['month'].'-'.$content['person']['positions']['position']['start-date']['year'];echo "<br>";
							echo "Company Name :"; echo $content['person']['positions']['position']['company']['name'];echo "<br>";
				echo "Industry Type :"; echo $content['person']['positions']['position']['company']['industry'];
    echo "<br>";echo "<br>";
	 foreach($post1 as $positions)
        {
			// Store the events in an array, grouped by years:
			echo "test1";echo "<br>";echo "<br>";
            echo $positions;echo "<br>";echo "<br>";
        }
echo '</div>';
				   
    ?>
    
    
    <div id="timelineLimiter"> <!-- Hides the overflowing timelineScroll div -->
	    <div id="timelineScroll"> <!-- Contains the timeline and expands to fit -->



		<?php
		
	     
        // We first select all the events from the database ordered by date:
        
        $dates = array();
        $res = mysql_query("SELECT * FROM timeline ORDER BY date_event ASC");
		
        while($row=mysql_fetch_assoc($res))
        {
			// Store the events in an array, grouped by years:
            $dates[date('Y',strtotime($row['date_event']))][] = $row;
        }
        
      
		$scrollPoints = '';
		
        $i=0;
        foreach($dates as $year=>$array)
        {
			// Loop through the years:
            echo '
            <div class="event">
                <div class="eventHeading '.$colors[$i++%3].'">'.$year.'</div>
                <ul class="eventList">
                ';
        
            foreach($array as $event)
            {
				// Loop through the events in the current year:
				
                echo '<li class="'.$event['type'].'">
				<span class="icon" title="'.ucfirst($event['type']).'"></span>
				'.htmlspecialchars($event['title']).'
				
				<div class="content">
					<div class="body">'.($event['type']=='image'?'<div style="text-align:center"><img src="'.$event['body'].'" alt="Image" /></div>':nl2br($event['body'])).'</div>
					<div class="title">'.htmlspecialchars($event['title']).'</div>
					<div class="date">'.date("F j, Y",strtotime($event['date_event'])).'</div>
				</div>
				
				</li>';
            }
            
            echo '</ul></div>';
			
			// Generate a list of years for the time line scroll bar:
			$scrollPoints.='<div class="scrollPoints">'.$year.'</div>';
        }
        
        ?>
	    
        <div class="clear"></div>
        </div>
        
        <div id="scroll"> <!-- The year time line -->
            <div id="centered"> <!-- Sized by jQuery to fit all the years -->
	            <div id="highlight"></div> <!-- The light blue highlight shown behind the years -->
	            <?php echo $scrollPoints ?> <!-- This PHP variable holds the years that have events -->
                <div class="clear"></div>
            </div>
        </div>
        
        <div id="slider"> <!-- The slider container -->
        	<div id="bar"> <!-- The bar that can be dragged -->
            	<div id="barLeft"></div>  <!-- Left arrow of the bar -->
                <div id="barRight"></div>  <!-- Right arrow, both are styled with CSS -->
          </div>
        </div>
        
    </div> 

</div>


    <div>
     


        <?php 

//$array = xml2array($content);

			   
			
			    echo "<br>";
		
				  print_r($content);
    
	
	//print_r($content); ?>
		
      </pre>
    </p>

  </body>
</html>
