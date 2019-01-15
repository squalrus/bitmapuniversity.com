<?php 
	$pageTitle = "Home";
	include "pages/header.inc";
?>    
    <div id="main-story">
    	<h1>Make Your Site The Cat's Meow!</h1>
        <h4>Posted on: August, 19 2009</h4>
        <p>Follow instructional videos, teaching you everything you need to know about HTML and CSS to put your site together. The first in the series, Line By Line, is up now with more to come. <a href="pages/lbl.php">Check it out!</a></p>
        <a href="pages/lbl.php"><img id="image1" src="assets/images/banner/image1.png" alt="Cat's Meow 1" /></a>
        <a href="pages/lbl.php"><img id="image2" src="assets/images/banner/image2.png" alt="Cat's Meow 2" /></a>
        <a href="pages/lbl.php"><img id="image3" src="assets/images/banner/image3.png" alt="Cat's Meow 3" /></a>
    </div>
    
    <div id="news-label">
    	<h2 style="margin-left:10px; width:599px">Latest Video</h2>
        <h2 style="margin-left:10px; width:279px">Latest News</h2>
    </div>   
    
    <div id="latest-video">
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
        <a id="more" href="/">more...</a>        
    </div>   	
    
    <div id="news">    	
		<?php
        // Connecting, selecting database
        $link = mysql_connect('db1426.perfora.net','dbo252633354','63Md9u6b') or die('Could not connect: ' . mysql_error());
        mysql_select_db('db252633354') or die('Could not select database');
        
        // Performing SQL query
        $query = 'SELECT * FROM news_feed ORDER BY news_date DESC LIMIT 1';
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        
        // Printing results in HTML
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?>              
            <h3><?php echo $line['news_title'] ?> </h3>
            <h4>Posted on: <?php echo gmdate('F j, Y', $line['news_date']-18000) ?></h4>     
            <p><?php echo $line['news_story'] ?></p>
        <?php
        }
        
        // Free resultset
        mysql_free_result($result);	
        // Closing connection
        mysql_close($link);  
        ?>
        <a id="more" href="/">more...</a>                
    </div>
    
<?php include "pages/footer.inc" ?>