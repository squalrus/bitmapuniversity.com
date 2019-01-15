<?php require('../assets/classes/secure.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bitmap University | Edit Blog</title>
<link rel="stylesheet" type="text/css" href="../assets/styles/siteStyles.css" />
<link rel="shortcut icon" href="../assets/images/shortcut.ico" />
<!--[if lte IE 7]>
<style type="text/css">
.menu_wrapper {
  margin-top:5px;
  }
</style>
<![endif]-->
</head>
<body>

<div id="wrapper-main">
    <div id="header"><h1>Bitmap University</h1></div>
    
    <div id="menu"></div>
    
    <!-- CONTENT -->
    <div id="content">
        <div class="story">
        	<img src="../assets/images/tall-gradient.jpg" />
            <h2>Create a News Story</h2>
            <div style="float:left; font-size:1.2em; text-align:right; text-transform:lowercase; width:50px">
            	<div style="margin:10px 0px">Title</div>
                <div style="margin:10px 0px">Story</div>
                <div style="margin:190px 0px 0px 0px">File</div>
            </div>
            <form method="get" action="blogEnter.php" style="float:left; width:490px" >
            	<input type="text" name="newsTitle" style="border:1px solid #CCCCCC; font-size:1.2em; margin:9px 0px 0px 20px; width:450px" />
                <textarea name="newsStory" style="border:1px solid #CCCCCC; font-size:1.2em; height:15em; margin:9px 0px 0px 20px; width:446px"></textarea>
                <input type="file" name="newsFile" style="margin:9px 0px 0px 20px; width:450px" />
                <input type="submit" style="background-color:#336699; border:2px solid #FFFFFF; color:#FFFFFF; font-size:1.2em; margin:9px 0px 0px 400px; text-transform:lowercase; width:75px" /> 
            </form>
            <div style="float:left; font-size:1.2em; margin:10px; width:340px">
          
            <?php	
				// Include Date Adjust Functions
				include("../assets/scripts/dateAdjust.php");
								
				// Connecting, selecting database
				$link = mysql_connect('db1426.perfora.net','dbo252633354','63Md9u6b')
					or die('Could not connect: ' . mysql_error());
				echo "<br />\n";
				mysql_select_db('db252633354') or die('Could not select database');
				
				// Performing SQL query
				$query = 'SELECT * FROM news_feed ORDER BY news_date DESC LIMIT 2';
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				
				// Printing results in HTML
				while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?>
                	<input type="button" value="edit" style="background-color:#336699; border:2px solid #FFFFFF; color:#FFFFFF; font-size:0.9em; margin:4px 8px 4px 0px; text-transform:lowercase; width:65px" />
                    <input type="button" value="delete" style="background-color:#336699; border:2px solid #FFFFFF; color:#FFFFFF; font-size:0.9em; margin:4px 8px 4px 0px; text-transform:lowercase; width:65px" />
					<div style="font-size:1.2em; font-weight:bold; margin:0px"><?php echo $line['news_title'] ?></div>
					<div style="font-size:0.8em; margin:0px"><?php echo gmdate('l F j Y g:i a', $line['news_date']-18000) ?></div>
					<div style="font-size:0.9em; margin:5px 0px 40px 0px"><?php echo $line['news_story'] ?></div>		
				<?php }
				
				// Free resultset
				mysql_free_result($result);
				
				// Closing connection
				mysql_close($link);  
			?>
            </div>
        </div>
    </div> <!-- // CONTENT -->
    
    <div id="footer">&copy; 2009 Bitmap University</div>
</div>
</body>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3211760-2";
urchinTracker();
</script>
</html>