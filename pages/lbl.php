<?php 
	$pageTitle = "Line By Line";
	include "header.inc";
?>
	<?php
    // Connecting, selecting database
    $link = mysql_connect('db1426.perfora.net','dbo252633354','63Md9u6b') or die('Could not connect: ' . mysql_error());
    mysql_select_db('db252633354') or die('Could not select database');
    
    // Performing SQL query
    $query = 'SELECT * FROM video_list ORDER BY code';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    
    // Printing results in HTML
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?>
        <div class="video-list">            
            <object width="300" height="203"><param name="allowfullscreen" value="true" />
                <param name="allowscriptaccess" value="always" />
                <param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=5611792&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" />
                <embed src="http://vimeo.com/moogaloop.swf?clip_id=5611792&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="300" height="203"></embed>
            </object>
            <h3><?php echo $line['title'] ?></h3>  
            <h4>Posted on: <?php echo $line['date'] ?></h4>
            <p><?php echo $line['summary'] ?></p>
            <a href="video.php?id=<?php echo $line['vimeo'] ?>"><?php echo $line['title'] ?></a>
        </div>            
        <?php
    }
    
    // Free resultset
    mysql_free_result($result);	
    // Closing connection
    mysql_close($link);  
    ?>
    

<?php include "footer.inc" ?>