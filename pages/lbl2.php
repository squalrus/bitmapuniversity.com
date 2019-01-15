<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="utf-8" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<xsl:template match="/">

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
        <xsl:for-each select="tutorials/lesson">           
            <object width="300" height="203"><param name="allowfullscreen" value="true" />
                <param name="allowscriptaccess" value="always" />
                <param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=5611792&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" />
                <embed src="http://vimeo.com/moogaloop.swf?clip_id=5611792&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="300" height="203"></embed>
            </object>
            <h3><xsl:value-of select="title"/></h3>  
            <h4>Posted on: <xsl:value-of select="date"/></h4>
            <p><xsl:value-of select="summary"/></p>
            <a href="video.php?id=<?php echo $line['vimeo'] ?>"><?php echo $line['title'] ?></a>
        </xsl:for-each>
        </div>            
        <?php
    }
    
    // Free resultset
    mysql_free_result($result);	
    // Closing connection
    mysql_close($link);  
    ?>
    

<?php include "footer.inc" ?>

</xsl:template>
</xsl:stylesheet>