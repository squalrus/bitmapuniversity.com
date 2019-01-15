<?php 
	$pageTitle = "Video";
	include "header.inc";
?>

    <div class="video">
        <?php
        // Connecting, selecting database
        $link = mysql_connect('db1426.perfora.net','dbo252633354','63Md9u6b') or die('Could not connect: ' . mysql_error());
        mysql_select_db('db252633354') or die('Could not select database');
        
        // Performing SQL query
        $code = $_GET['id'];
        $query = 'SELECT * FROM video_list WHERE vimeo = '.$code;			
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        
        // Printing results in HTML
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?>
            <h1><?php echo $line['title'] ?></h1>
            <h4>Posted on: <?php echo $line['date'] ?></h4>            
            <object width="720" height="480"><param name="allowfullscreen" value="true" />
                <param name="allowscriptaccess" value="always" />
                <param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=5611792&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" />
                <embed src="http://vimeo.com/moogaloop.swf?clip_id=5611792&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="720" height="480"></embed>
            </object>
            <p><?php echo $line['summary'] ?></p>
		<?php
        }
        
        // Free resultset
        mysql_free_result($result);	
        // Closing connection
        mysql_close($link);  
        ?>
    </div>

<?php include "footer.inc" ?>