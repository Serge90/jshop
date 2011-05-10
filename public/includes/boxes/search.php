<?php
/*
  $Id: search.php,v 1.22 2003/02/10 22:31:05 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- search //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_SEARCH);

  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('form' => tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get'),
                               'align' => 'left',
                               'text' => '
						<table border="0" cellspacing="0" cellpadding="0" class="table3">
							<tr>
								<td class="search_input-rep">
									<table cellpadding="0" cellspacing="0" border="0" class="search_input-left">
										<tr><td class="search_input-right">'. tep_draw_input_field('keywords', BOX_HEADING_SEARCH, 'size="10" maxlength="30"  class="go" onblur="if(this.value==\'\') this.value=\'' . BOX_HEADING_SEARCH . '\'" onfocus="if(this.value ==\'' . BOX_HEADING_SEARCH . '\' ) this.value=\'\'"') . '' . tep_hide_session_id() .  '</td></tr>
									</table>
								</td>
								<td>'.tep_draw_separator('spacer.gif', '6', '1').'</td>
								<td class="search_button-rep">
									<table cellpadding="0" cellspacing="0" border="0" class="search_button-left">
										<tr><td class="search_button-right">' . tep_image_submit('button_quick_find.gif', '', '').'</td></tr>
									</table>
								</td>
							</tr>
                        </table>
						<table cellpadding="0" cellspacing="0" border="0"><tr><td class="advserch"><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '">' . BOX_SEARCH_ADVANCED_SEARCH . '</a></td></tr></table>
						<div</div>');

    new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- search_eof //-->
