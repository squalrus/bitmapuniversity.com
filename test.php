<?php 
	$pageTitle = "Home";
	include "pages/header.inc";
?>    
    <!-- CONTENT -->
    <div id="content">
        <?php
        // Connecting, selecting database
        $link = mysql_connect('db1426.perfora.net','dbo252633354','63Md9u6b') or die('Could not connect: ' . mysql_error());
        mysql_select_db('db252633354') or die('Could not select database');
        
        // Performing SQL query
        $query = 'SELECT * FROM news_feed ORDER BY news_date DESC LIMIT 10';
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        
        // Printing results in HTML
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?>
        	<div class="date">
            	<div class="mo"><?php echo gmdate('F', $line['news_date']-18000) ?></div>  
                <div class="nu"><?php echo gmdate('j', $line['news_date']-18000) ?></div>
                <div class="yr"><?php echo gmdate('Y', $line['news_date']-18000) ?></div>
            </div>
            <div class="story">  
                <img src="assets/images/news/<?php echo $line['news_date'] ?>.jpg" alt="<?php echo $line['news_title'] ?>" />
                <h2><?php echo $line['news_title'] ?></h2>     
                <p><?php echo $line['news_story'] ?></p>
			</div> 
        	<?php
        }
        
        // Free resultset
        mysql_free_result($result);	
        // Closing connection
        mysql_close($link);  
        ?>
    </div> <!-- // CONTENT -->
    
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
        $query = 'SELECT * FROM comments ORDER BY date DESC LIMIT 10';
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
        	<form action="test.php" method="post">
            	<h3>name:</h3><input type="text" name="name" />
                <h3>e-mail:</h3><input type="text" name="email" />
                <h3>comment:</h3><textarea name="comment"></textarea>
                <input type="submit" />
            </form>
        </div>
    </div>
    
<?php include "pages/footer.inc" ?>