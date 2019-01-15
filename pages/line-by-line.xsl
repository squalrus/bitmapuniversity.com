<?xml version="1.0" encoding="utf-8"?><!-- DWXMLSource="line-by-line.xml" -->
<!DOCTYPE xsl:stylesheet  [
	<!ENTITY nbsp   "&#160;">
	<!ENTITY copy   "&#169;">
	<!ENTITY reg    "&#174;">
	<!ENTITY trade  "&#8482;">
	<!ENTITY mdash  "&#8212;">
	<!ENTITY ldquo  "&#8220;">
	<!ENTITY rdquo  "&#8221;"> 
	<!ENTITY pound  "&#163;">
	<!ENTITY yen    "&#165;">
	<!ENTITY euro   "&#8364;">
]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="utf-8" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<xsl:template match="/">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Untitled Document</title>
</head>

<body>

<xsl:for-each select="tutorials/lesson"> 
	<object width="300" height="203"><param name="allowfullscreen" value="true" />
        <param name="allowscriptaccess" value="always" />
        <param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id="<xsl:value-of select="vimeo"/>"&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" />
        <embed src="http://vimeo.com/moogaloop.swf?clip_id="<xsl:value-of select="vimeo"/>"&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="300" height="203"></embed>
    </object>      
    <h3><xsl:value-of select="title"/></h3>  
    <h4>Posted on: <xsl:value-of select="date"/></h4>
    <p><xsl:value-of select="summary"/></p>
    <a href="video.php?id=<xsl:value-of select="vimeo"/>"><xsl:value-of select="title"/></a>
</xsl:for-each>

</body>
</html>

</xsl:template>
</xsl:stylesheet>