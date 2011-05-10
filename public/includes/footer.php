<?php
/*
  $Id: footer.php,v 1.26 2003/02/10 22:30:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require(DIR_WS_INCLUDES . 'counter.php');
?>
	</td></tr>
	<tr><td class="row_4">
				<table cellpadding="0" cellspacing="0" border="0" align="center" class="footer width_table">
					<tr><td class="footer2_td"><?php echo tep_image(DIR_WS_IMAGES.'p1.gif')?></td>
						<td class="footer_td"><span><a href="<?php echo tep_href_link('specials.php')?>"><?php echo BOX_HEADING_SPECIALS?></a> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<a href="<?php echo tep_href_link('advanced_search.php')?>"><?php echo BOX_SEARCH_ADVANCED_SEARCH?></a> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<a href="<?php echo tep_href_link('reviews.php')?>"><?php echo BOX_HEADING_REVIEWS?></a> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<?php if (tep_session_is_registered('customer_id')) { 
?><a href="<?php echo tep_href_link('account.php')?>"><?php echo HEADER_TITLE_MY_ACCOUNT?></a><?php } else 
{ ?><a href="<?php echo tep_href_link('create_account.php')?>"><?php echo HEADER_TITLE_CREATE_ACCOUNT?></a><?php } 
?> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<?php if (tep_session_is_registered('customer_id')) { 
?><a href="<?php echo tep_href_link('logoff.php')?>"><?php echo HEADER_TITLE_LOGOFF?></a><?php } else 
{ ?><a href="<?php echo tep_href_link('login.php')?>"><?php echo HEADER_TITLE_LOGIN?></a><?php } 
?></span><br><?php echo FOOTER_TEXT_BODY?>&nbsp;&nbsp; <b><a href="<?php echo tep_href_link('privacy.php')?>"><?php echo BOX_INFORMATION_PRIVACY?></a> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<a href="<?php echo tep_href_link('conditions.php')?>"><?php echo BOX_INFORMATION_CONDITIONS?></a></b></td>
						
					</tr>
				</table>
        
    </td></tr>
<?php
  if ($banner = tep_banner_exists('dynamic', '468x50')) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  </tr>
</table>
<?php
  }
?>
</td></tr></table>
</div>
