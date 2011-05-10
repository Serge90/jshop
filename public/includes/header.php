<?php
/*
  $Id: header.php,v 1.42 2003/06/10 18:20:38 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// check if the 'install' directory exists, and warn of its existence
  if (WARN_INSTALL_EXISTENCE == 'true') {
    if (file_exists(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install')) {
  $messageStack->add('header', WARNING_INSTALL_DIRECTORY_EXISTS, 'warning');   
    }
  }

// check if the configure.php file is writeable
  if (WARN_CONFIG_WRITEABLE == 'true') {
    if ( (file_exists(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) && (is_writeable(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) ) {
  $messageStack->add('header', WARNING_CONFIG_FILE_WRITEABLE, 'warning');   
    }
  }

// check if the session folder is writeable
  if (WARN_SESSION_DIRECTORY_NOT_WRITEABLE == 'true') {
    if (STORE_SESSIONS == '') {
      if (!is_dir(tep_session_save_path())) {
       $messageStack->add('header', WARNING_SESSION_DIRECTORY_NON_EXISTENT, 'warning');
      } elseif (!is_writeable(tep_session_save_path())) {
       $messageStack->add('header', WARNING_SESSION_DIRECTORY_NOT_WRITEABLE, 'warning');
      }
    }
  }

// check session.auto_start is disabled
  if ( (function_exists('ini_get')) && (WARN_SESSION_AUTO_START == 'true') ) {
    if (ini_get('session.auto_start') == '1') {
     $messageStack->add('header', WARNING_SESSION_AUTO_START, 'warning');
    }
  }

  if ( (WARN_DOWNLOAD_DIRECTORY_NOT_READABLE == 'true') && (DOWNLOAD_ENABLED == 'true') ) {
    if (!is_dir(DIR_FS_DOWNLOAD)) {
     $messageStack->add('header', WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT, 'warning');
    }
  }

  if ($messageStack->size('header') > 0) {
   echo $messageStack->output('header');
  }
	include_once("includes/functions/custom_functions.php");
?>
<!-- start -->
<?php
  if (isset($HTTP_GET_VARS['error_message']) && tep_not_null($HTTP_GET_VARS['error_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerError">
    <td class="headerError"><?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['error_message']))); ?></td>
  </tr>
</table>
<?php
  }

  if (isset($HTTP_GET_VARS['info_message']) && tep_not_null($HTTP_GET_VARS['info_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerInfo">
    <td class="headerInfo"><?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['info_message']))); ?></td>
  </tr>
</table>
<?php
  }
?>
<!-- start -->

<div class="bg2_body">
<table cellpadding="0" cellspacing="0" border="0" align="center" class="width_table">
    <tr><td class="row_1">
		<table cellpadding="0" cellspacing="0" border="0">
    		<tr><td>
            	<table cellpadding="0" cellspacing="0" border="0">
                	<tr>
                    	<td class="logo"><a href="<?php echo tep_href_link('index.php')?>"><?php echo tep_image(DIR_WS_IMAGES.'logo.gif', '', '', '', '')?></a></td>
                        <td class="navigation">
                        	<table cellpadding="0" cellspacing="0" border="0" align="right" class="table">
                            	<tr><td class="z1">
				<table cellpadding="0" cellspacing="0" border="0" align="right">
					<tr>
						<td><b><?php echo BOX_HEADING_SHOPPING_CART;?>&nbsp;</b> <?php echo BOX_SHOPPING_NOW3;?> <a href="<?php echo tep_href_link('shopping_cart.php')?>"><strong><?php echo $cart->count_contents()?></strong> <?php echo BOX_SHOPPING_CART_EMPTY?></a></td>
					</tr>
				</table>
								</td></tr>
                                <tr><td class="navigation2" align="right">
					
				<table cellpadding="0" cellspacing="0" border="0" class="table2">
					<tr>
                                    <td class="languages">
					
	<table border="0" cellspacing="0" cellpadding="0" align="center">
		<tr><td style="padding:0px 0px 2px 0px;"><?php echo BOX_HEADING_LANGUAGES?>:&nbsp;&nbsp;</td><td style="width:100%;"><?php
echo tep_draw_form('languages', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get');
if (!isset($lng) || (isset($lng) && !is_object($lng))) {
include(DIR_WS_CLASSES . 'language.php');
$lng = new language;
}
reset($lng->catalog_languages);
$languages_array = array();
while (list($key, $value) = each($lng->catalog_languages)) {
$languages_array[] = array('id' => $key, 'text' => $value['name']);
}
$hidden_get_variables = '';
reset($HTTP_GET_VARS);
while (list($key, $value) = each($HTTP_GET_VARS)) {
if ( ($key != 'language') && ($key != tep_session_name()) && ($key != 'x') && ($key != 'y') ) {
$hidden_get_variables .= tep_draw_hidden_field($key, $value);
}
}
echo tep_draw_pull_down_menu('language', $languages_array, $HTTP_GET_VARS['language'], 'onChange="this.form.submit();" class="select"') . $hidden_get_variables . tep_hide_session_id();
echo '</form>';
?></td>
		</tr>
	</table>
									</td>
									<td class="currencies">
					
	<table border="0" cellspacing="0" cellpadding="0" align="center">
		<tr><td style="padding:0px 0px 2px 0px;"><?php echo BOX_HEADING_CURRENCIES?>:&nbsp;&nbsp;</td><td style="width:100%;"><?php
echo tep_draw_form('currencies', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get');
reset($currencies->currencies);
$currencies_array = array();
while (list($key, $value) = each($currencies->currencies)) {
$currencies_array[] = array('id' => $key, 'text' => $value['title']);
}
$hidden_get_variables = '';
reset($HTTP_GET_VARS);
while (list($key, $value) = each($HTTP_GET_VARS)) {
if ( ($key != 'currency') && ($key != tep_session_name()) && ($key != 'x') && ($key != 'y') ) {
$hidden_get_variables .= tep_draw_hidden_field($key, $value);
}
}
echo tep_draw_pull_down_menu('currency', $currencies_array, $currency, 'onChange="this.form.submit();" class="select"') . $hidden_get_variables . tep_hide_session_id();
echo '</form>';
?></td>
		</tr>
	</table>
									</td>
                                </tr>
                            </table>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                </table>
            </td></tr>
            <tr><td class="row_11">
                    <table cellpadding="0" cellspacing="0" border="0">
                    	
                        <tr><td class="menu">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
<?php          
  switch($tab_sel){
   case 2:
    $item_menu_01 = 'id="over_m1" onMouseOut="this.id=\'over_m1\';" onMouseOver="this.id=\'over_m1\';"';
    $item_menu_02 = 'id="m2" onMouseOut="this.id=\'m2\';" onMouseOver="this.id=\'over_m2\';"';
    $item_menu_03 = 'id="m3" onMouseOut="this.id=\'m3\';" onMouseOver="this.id=\'over_m3\';"';
    $item_menu_04 = 'id="m4" onMouseOut="this.id=\'m4\';" onMouseOver="this.id=\'over_m4\';"';
    $item_menu_05 = 'id="m5" onMouseOut="this.id=\'m5\';" onMouseOver="this.id=\'over_m5\';"';
    $item_menu_06 = 'id="m6" onMouseOut="this.id=\'m6\';" onMouseOver="this.id=\'over_m6\';"';	
    break;

   case 3:
    $item_menu_01 = 'id="m1" onMouseOut="this.id=\'m1\';" onMouseOver="this.id=\'over_m1\';"';
    $item_menu_02 = 'id="over_m2" onMouseOut="this.id=\'over_m2\';" onMouseOver="this.id=\'over_m2\';"';
    $item_menu_03 = 'id="m3" onMouseOut="this.id=\'m3\';" onMouseOver="this.id=\'over_m3\';"';
    $item_menu_04 = 'id="m4" onMouseOut="this.id=\'m4\';" onMouseOver="this.id=\'over_m4\';"';
    $item_menu_05 = 'id="m5" onMouseOut="this.id=\'m5\';" onMouseOver="this.id=\'over_m5\';"';
    $item_menu_06 = 'id="m6" onMouseOut="this.id=\'m6\';" onMouseOver="this.id=\'over_m6\';"';	
    break;

   case 4:
    $item_menu_01 = 'id="m1" onMouseOut="this.id=\'m1\';" onMouseOver="this.id=\'over_m1\';"';
    $item_menu_02 = 'id="m2" onMouseOut="this.id=\'m2\';" onMouseOver="this.id=\'over_m2\';"';
    $item_menu_03 = 'id="over_m3" onMouseOut="this.id=\'over_m3\';" onMouseOver="this.id=\'over_m3\';"';
    $item_menu_04 = 'id="m4" onMouseOut="this.id=\'m4\';" onMouseOver="this.id=\'over_m4\';"';
    $item_menu_05 = 'id="m5" onMouseOut="this.id=\'m5\';" onMouseOver="this.id=\'over_m5\';"';
    $item_menu_06 = 'id="m6" onMouseOut="this.id=\'m6\';" onMouseOver="this.id=\'over_m6\';"';	
    break;

   case 5:
    $item_menu_01 = 'id="m1" onMouseOut="this.id=\'m1\';" onMouseOver="this.id=\'over_m1\';"';
    $item_menu_02 = 'id="m2" onMouseOut="this.id=\'m2\';" onMouseOver="this.id=\'over_m2\';"';
    $item_menu_03 = 'id="m3" onMouseOut="this.id=\'m3\';" onMouseOver="this.id=\'over_m3\';"';
    $item_menu_04 = 'id="over_m4" onMouseOut="this.id=\'over_m4\';" onMouseOver="this.id=\'over_m4\';"';
    $item_menu_05 = 'id="m5" onMouseOut="this.id=\'m5\';" onMouseOver="this.id=\'over_m5\';"';
    $item_menu_06 = 'id="m6" onMouseOut="this.id=\'m6\';" onMouseOver="this.id=\'over_m6\';"';	
    break;

   case 6:
    $item_menu_01 = 'id="m1" onMouseOut="this.id=\'m1\';" onMouseOver="this.id=\'over_m1\';"';
    $item_menu_02 = 'id="m2" onMouseOut="this.id=\'m2\';" onMouseOver="this.id=\'over_m2\';"';
    $item_menu_03 = 'id="m3" onMouseOut="this.id=\'m3\';" onMouseOver="this.id=\'over_m3\';"';
    $item_menu_04 = 'id="m4" onMouseOut="this.id=\'m4\';" onMouseOver="this.id=\'over_m4\';"';
    $item_menu_05 = 'id="over_m5" onMouseOut="this.id=\'over_m5\';" onMouseOver="this.id=\'over_m5\';"';
    $item_menu_06 = 'id="m6" onMouseOut="this.id=\'m6\';" onMouseOver="this.id=\'over_m6\';"';	
    break;

   case 7:
    $item_menu_01 = 'id="m1" onMouseOut="this.id=\'m1\';" onMouseOver="this.id=\'over_m1\';"';
    $item_menu_02 = 'id="m2" onMouseOut="this.id=\'m2\';" onMouseOver="this.id=\'over_m2\';"';
    $item_menu_03 = 'id="m3" onMouseOut="this.id=\'m3\';" onMouseOver="this.id=\'over_m3\';"';
    $item_menu_04 = 'id="m4" onMouseOut="this.id=\'m4\';" onMouseOver="this.id=\'over_m4\';"';
    $item_menu_05 = 'id="m5" onMouseOut="this.id=\'m5\';" onMouseOver="this.id=\'over_m5\';"';
    $item_menu_06 = 'id="over_m6" onMouseOut="this.id=\'over_m6\';" onMouseOver="this.id=\'over_m6\';"';
    break;

   default:
    $item_menu_01 = 'id="m1" onMouseOut="this.id=\'m1\';" onMouseOver="this.id=\'over_m1\';"';
    $item_menu_02 = 'id="m2" onMouseOut="this.id=\'m2\';" onMouseOver="this.id=\'over_m2\';"';
    $item_menu_03 = 'id="m3" onMouseOut="this.id=\'m3\';" onMouseOver="this.id=\'over_m3\';"';

    $item_menu_04 = 'id="m4" onMouseOut="this.id=\'m4\';" onMouseOver="this.id=\'over_m4\';"';
    $item_menu_05 = 'id="m5" onMouseOut="this.id=\'m5\';" onMouseOver="this.id=\'over_m5\';"';
    $item_menu_06 = 'id="m6" onMouseOut="this.id=\'m6\';" onMouseOver="this.id=\'over_m6\';"';
  }
?>            

                    <td <?php echo $item_menu_01;?> onClick="document.location='<?php echo tep_href_link('index.php')?>'" nowrap="nowrap"><?php printf(BOX_MANUFACTURER_INFO_HOMEPAGE,"")?></td>
                    <td class="menu_separator"><?php echo tep_image(DIR_WS_IMAGES.'menu_separator.gif')?></td>
                    <td <?php echo $item_menu_02;?> onClick="document.location='<?php echo tep_href_link('products_new.php')?>'"><?php echo BOX_HEADING_WHATS_NEW?></td>
                    <td class="menu_separator"><?php echo tep_image(DIR_WS_IMAGES.'menu_separator.gif')?></td>
                    <td <?php echo $item_menu_03;?> onClick="document.location='<?php echo tep_href_link('specials.php')?>'"><?php echo BOX_HEADING_SPECIALS?></td>
                    <td class="menu_separator"><?php echo tep_image(DIR_WS_IMAGES.'menu_separator.gif')?></td>
                        
<?php if (tep_session_is_registered('customer_id')) { 

     $acc_link = tep_href_link('account.php');
     $acc_title= HEADER_TITLE_MY_ACCOUNT;
    } else{ 
     $acc_link = tep_href_link('create_account.php');
     $acc_title= HEADER_TITLE_CREATE_ACCOUNT;
    } 
?>                        
                    <td <?php echo $item_menu_04;?> onClick="document.location='<?php echo $acc_link;?>'" nowrap="nowrap"><?php echo $acc_title;?></td>
                    <td class="menu_separator"><?php echo tep_image(DIR_WS_IMAGES.'menu_separator.gif')?></td>
                    
                    <td <?php echo $item_menu_06;?> onClick="document.location='<?php echo tep_href_link('contact_us.php')?>'"><?php echo BOX_INFORMATION_CONTACT?></td>
                    </tr>
                </table>
                            </td>
                            <td class="search">
		<?php echo tep_draw_form('search',tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false),'get') ?>
        <table border="0" cellspacing="0" cellpadding="0" align="right" class="table">
        <tr><td class="td"><?php echo HEADING_SEARCH;?>:&nbsp;&nbsp;</td>
            <td class="search_input-rep">
                <table cellpadding="0" cellspacing="0" border="0" class="search_input-left">
                    <tr><td class="search_input-right"><input type=text name="keywords" class="go" style="width:100%;" value="<?php echo INPUT_SEARCH?>" onblur="if(this.value=='') this.value='<?php echo INPUT_SEARCH?>'" onfocus="if(this.value =='<?php echo INPUT_SEARCH?>' ) this.value=''"></td></tr>
                </table>
            </td>
            <td><?php echo tep_draw_separator('spacer.gif', '7', '1');?></td>
            <td class="search_button-rep">
                <table cellpadding="0" cellspacing="0" border="0" class="search_button-left">
                    <tr><td class="search_button-right"><?php echo tep_image_submit('button_search_prod.gif', '', '')?></td></tr>
                </table>
            </td>
        </tr>
        </table></form>                                        
                    		</td>                
                        </tr>
                    </table>
            </td></tr>
        </table>
            
    </td></tr>
    <tr><td class="row_2">
                
                