<?php 
	$pageTitle = "Login";
	include "header.inc";
?>   
    
    <div id="content"><!-- CONTENT -->
        <div class="story">
        	<img src="../assets/images/grey-block.jpg" />
            <h2>Super Secret Administration Login</h2>
            <h3>If you have said super secret login information, this would be the place to use it...</h3>
            <div style="float:left; text-align:right; text-transform:lowercase; width:150px">
            	<div style="font-weight:bold; margin:10px 0px">Username</div>
                <div style="font-weight:bold; margin:10px 0px">Password</div>
            </div>
            <form action="../account/editor.php" method="post" name="login" style="float:left; width:300px" >
                <input type="text" name="username" tabindex="1" style="border:1px solid #CCCCCC; margin:9px 0px 0px 20px; width:200px" />
                <input type="password" name="password" tabindex="2" style="border:1px solid #CCCCCC; margin:9px 0px 0px 20px; width:200px" />
                <input type="submit" tabindex="3" style="background-color:#336699; border:1px solid #FFFFFF; color:#FFFFFF; margin:2px 0px 0px 153px; text-transform:lowercase; width:70px" />
            </form>
        </div>
    </div> <!-- // CONTENT -->
    
<?php include "footer.inc" ?>