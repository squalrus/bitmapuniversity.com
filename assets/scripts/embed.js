// JavaScript Document
function writeFlash(movie, width, height) {
    document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="'+width+'" height="'+height+'">');
    document.write('<param name=movie value="'+movie+'">');
    document.write('<param name=quality value=high>');
    document.write('<embed src="'+movie+'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="'+width+'" height="'+height+'" />');
    document.write('</object>');
}