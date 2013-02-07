<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Animation checker</title>
		<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
		<script type="text/javascript" src="scripts/pixlr.js"></script>
	<script type="text/javascript">
		pixlr.settings.target = 'http://developer.pixlr.com/save_post_modal.php';
		pixlr.settings.exit = 'http://www.azukisoft.com/OSC/';
		pixlr.settings.credentials = false;
		pixlr.settings.method = 'get';
	</script>
		<script type="text/javascript" src="scripts/ajaxupload.js"></script>
                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.3"></script>
                <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
                <script type="text/javascript" src="scripts/animator.js"></script>
	</head>
<body >        
<div id="container">
			<div id="demo_area">
				<div id="left_col">
                                    <h1>"Welcome to Animation Checker by Azukisoft"</h1>
                                        <fieldset>
						<legend>Authorization </legend>
                                                <?php 
                                                    require 'fb_scripts.php'; 
                                                ?>
                                                <div id="fb_place">
                                                    
                                                    <fb:login-button  autologoutlink='true'></fb:login-button>
                                                    <div id="your_fb">&nbsp;</div>
                                                </div>
                                                <small style="font-weight: bold; font-style:italic;">&nbsp;Only Facebook login supported now</small>
                                        </fieldset>        
					
                                        <fieldset>
                                            <legend>Select image from the list on the right</legend>
                                            <div id="animator_container">
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td rowspan="2"><span id="frame_info" >&nbsp;</span><br/><span id="image_info" >&nbsp;</span></td>
                                                        <td class="green">Frames count</td>
                                                        <td><img id="framesPlus" src='images/plus.png'/></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><span id="frames_count" >1</span></td>
                                                        <td><img id="framesMinus" src='images/minus.png'/></td>
                                                    </tr>
                                                </table>
   <br/>
                                                Click on image to play it
                                                <hr/><br/>
                                                <div id="animator">
                                                    <a id="image_anim_a" href="#animator_a">
                                                        <table id="animator_grid" celpadding="0" cellspacing="0" border="1"></table>
                                                        <img id="image_anim" src="images/loader_light_blue.gif" />
                                                    </a>
                                                </div>
                                                <div id="animator_a" style="display: none">
                                                    <?php require 'animator_popup.php'; ?>
                                                </div>
                                            </div>
                                        </fieldset>
				</div>
                   
				<div id="right_col">
                                    <fieldset>
						<legend>Image uploading form</legend>
						<form action="scripts/ajaxupload.php" method="post" name="unobtrusive" id="ploadingForm" enctype="multipart/form-data">
							<inpit type="hiden" id="usfolder" name="userFolder" value="" />
                                                        <input type="hidden" name="maxSize" value="9999999999" />
							<input type="hidden" name="maxW" value="20000" />                                                        
							<input type="hidden" name="fullPath" value="/OSC/uploads/" />
							<input type="hidden" name="relPath" value="../uploads/" />
							<input type="hidden" name="colorR" value="255" />
							<input type="hidden" name="colorG" value="255" />
							<input type="hidden" name="colorB" value="255" />
							<input type="hidden" name="maxH" value="30000" />
							<input type="hidden" name="filename" value="filename" />
							<p><input type="file" name="filename" id="filename" value="filename" onchange="ajaxUpload(this.form,'scripts/ajaxupload.php?filename=filename&amp;userFolder='+folder+'&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=/OSC/uploads/&amp;relPath=../uploads/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); imagesList(); return false;" /></p>
							<noscript><p><input type="submit" name="submit" value="Upload Image" /></p></noscript>
						</form>
                                                <small style="font-weight: bold; font-style:italic;">&nbsp;Supported File Types: gif, jpg, png</small>
					</fieldset>
					<div id="upload_area">
						Please, start with uploading form on the left<br /><br />
						
					</div>
					<div id="images_list">loading...</div>
                                </div>
				<div class="clear"> </div>
			</div>
                        <br />
			<br />
	</div>	

		<div id="footer">&copy;  <a href="http://azukisoft.com">Azukisoft Pte Ltd</a> </div>
</body>
</html>