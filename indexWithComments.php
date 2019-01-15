<?php 
	$pageTitle = "Home";
	include "pages/header.inc";
?>    
    <div id="main-story">
    	<h1>Make Your Site The Cat's Meow!</h1>
        <p>Follow instructional videos, teaching you everything you need to know about HTML and CSS to put your site together. The first in the series, Line By Line, is up now with more to come. <a href="pages/lbl.php">Check it out!</a></p>
        <a href="pages/lbl.php"><img id="image1" src="assets/images/banner/image1.png" alt="Cat's Meow 1" /></a>
        <a href="pages/lbl.php"><img id="image2" src="assets/images/banner/image2.png" alt="Cat's Meow 2" /></a>
        <a href="pages/lbl.php"><img id="image3" src="assets/images/banner/image3.png" alt="Cat's Meow 3" /></a>
    </div>
    
    <div id="content-label">
    	<h3 style="width:620px">Latest Video</h3>
        <h3 style="width:280px">News</h3>
    </div>   
    
    <div id="content">
        <?php
        // Connecting, selecting database
        $link = mysql_connect('db1426.perfora.net','dbo252633354','63Md9u6b') or die('Could not connect: ' . mysql_error());
        mysql_select_db('db252633354') or die('Could not select database');
        
        // Performing SQL query
        $query = 'SELECT * FROM video_list ORDER BY date DESC LIMIT 1';
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        
        // Printing results in HTML
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?>
        	<object width="300" height="203"><param name="allowfullscreen" value="true" />
                <param name="allowscriptaccess" value="always" />
                <param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=5611792&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" />
                <embed src="http://vimeo.com/moogaloop.swf?clip_id=5611792&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="300" height="203"></embed>
            </object> 
            <h3><?php echo $line['title'] ?></h3>  
            <h4>Posted on: <?php echo $line['date'] ?></h4>
            <p><?php echo $line['summary'] ?></p>
            <a href="pages/video.php?id=<?php echo $line['vimeo'] ?>"><?php echo $line['title'] ?></a>
        	<?php
        }
        
        // Free resultset
        mysql_free_result($result);	
        // Closing connection
        mysql_close($link);  
        ?>
    </div>   	
    
    <div class="column">
    	<div class="column-content">
        	<a class="lbl-link" href="pages/lbl.php" target="_self">Line By Line</a>
        </div>
    </div>
    
    <div class="column">
    	<div class="column-content">
        	<a class="digg-link" href="http://digg.com/users/BitmapU" target="_blank">Digg Bitmap University</a>
        	<a class="vimeo-link" href="http://vimeo.com/bitmapu" target="_blank">Vimeo Bitmap University</a>
            <a class="youtube-link" href="http://www.youtube.com/BitmapUniversity" target="_blank">Youtube Bitmap University</a>
        </div>
    </div>
    
    <?php 
	if ($_POST) {
		// Connecting, selecting database
		$link = mysql_connect('db1426.perfora.net','dbo252633354','63Md9u6b') or die('Could not connect: ' . mysql_error());
		mysql_select_db('db252633354') or die('Could not select database');
		
		// Performing SQL query
		$query = "INSERT INTO comments (date, name, email, comment) VALUES (UNIX_TIMESTAMP(NOW()), '$_POST[name]', '$_POST[email]', '$_POST[comment]')";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
		// Free resultset
		mysql_free_result($result);	
		// Closing connection
		mysql_close($link); 
		$_POST = array();		
	}
	?>
    
    <div class="column">    	
		<?php
        // Connecting, selecting database
        $link = mysql_connect('db1426.perfora.net','dbo252633354','63Md9u6b') or die('Could not connect: ' . mysql_error());
        mysql_select_db('db252633354') or die('Could not select database');
        
        // Performing SQL query
        $query = 'SELECT * FROM comments WHERE approved != 0 ORDER BY date DESC LIMIT 10';
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        
        // Printing results in HTML
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?>
            <div class="column-content">                   
                <h2><?php echo $line['name'] ?> Says:</h2>
                <h3><?php echo gmdate('F j, Y', $line['date']-18000) ?></h3>     
                <p><?php echo $line['comment'] ?></p>
            </div>
            <?php
        }
        
        // Free resultset
        mysql_free_result($result);	
        // Closing connection
        mysql_close($link);  
        ?>        
    </div>    
    
    <div class="column">
    	<div class="column-content">
        	<h1>Leave a Comment:</h1>
        	<form action="index.php" method="post">
            	<h3>name:</h3><input type="text" name="name" />
                <h3>e-mail: *for verification</h3><input type="text" name="email" />
                <h3>comment: (200 character limit)</h3><textarea name="comment"></textarea>
                <input type="submit" />
            </form>
        </div>
    </div>
    
<?php include "pages/footer.inc" ?>