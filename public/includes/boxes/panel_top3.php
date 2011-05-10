<?php
/*
  $Id: languages.php,v 1.15 2003/06/09 22:10:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>   
<table cellpadding="0" cellspacing="0" border="0"><tr><td class="flash"><!--Valid flash version 8.0-->
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                    codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,24"
           width="100%" height="238">
	<param name="movie" value="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG;?>flash/header_v8.swf?xmlUrl=<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG;?>flash/tfile_main.xml" /> 
	<param name="quality" value="high" />
	<param name="menu" value="false" />
	<param name="wmode" value="transparent" />
	<!--[if !IE]> <-->
	<object data="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG;?>flash/header_v8.swf?xmlUrl=<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG;?>flash/tfile_main.xml"
           width="100%" height="238" type="application/x-shockwave-flash">
	<param name="quality" value="high" />
	<param name="menu" value="false" />
	<param name="pluginurl" value="http://www.macromedia.com/go/getflashplayer" />
	<param name="wmode" value="transparent" />
	FAIL (the browser should render some flash content, not this).
	</object>
	<!--> <![endif]-->
	</object></td></tr></table>
