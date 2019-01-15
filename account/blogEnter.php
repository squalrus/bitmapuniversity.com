<?php require('../assets/classes/secure.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Bitmap University | Home</title>
<link rel="stylesheet" type="text/css" href="../assets/scripts/styles.css" />
</head>

<body>
<h1></h1>

<div class="main_banner">
        <div class="bu_banner"></div>
<!-- Menu Items -->
		<div class="menu_wrapper">
        	<li><a href="/">Home</a></li>
            <li><a href="pages/classes.php">Classes</a></li>
            <li><a href="pages/contests.php">Contests</a></li>
            <li><a href="pages/blog.php">Blog</a></li> 
            <li><a href="phpBB3/" target="_blank">Boards</a></li>
            <li><a href="pages/contact.php">Contact</a></li>
            <li style="float:right"><a href="login.php">Account</a></li>
        </div>
        
</div>
<div class="main_body">
    
    <div class="main_body_50">

<!-- BmU News Section -->    	
        <div class="wide_global">
            <div id="section_header">Blog Entry Status</div>
            <div id="section_body">
                
                <?php
					session_start();	
					// Include Date Adjust Functions
					include("../assets/scripts/dateAdjust.php");
									
					// Connecting, selecting database
					$link = mysql_connect('db1426.perfora.net','dbo252633354','63Md9u6b')
						or die('Could not connect: ' . mysql_error());
					echo "<br />\n";
					mysql_select_db('db252633354') or die('Could not select database');
					
					// Insert Text
					$query = 'INSERT INTO news_feed (news_date, news_title, news_story) VALUES (NOW(), \''.$_GET['newsTitle'].'\', \''.$_GET['newsStory']'\')'; 
					mysql_query($query) or die('Query failed: ' . mysql_error());
					
					// Free resultset
					mysql_free_result($result);
					
					// Closing connection
					mysql_close($link);
  
				?>
                <a href="editor.php">BACK TO THE EDITOR</a>
            </div>  
        </div>
    
    </div>
    <div class="main_body_50">
        
    </div>
        
<!-- Footer -->    
	<div class="footer"><a href="#">&copy; 2008 Bitmap University</a></div>

</div>
   
       
</body>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3211760-2";
urchinTracker();
</script>
</html>