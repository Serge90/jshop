<?php
  /*
  $Id: information.php,v 1.6 2002/11/22 18:56:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
  */
?>
<!-- information //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_INFORMATION);

  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => '<ul class="information">
  										  <li class="bg_list"><a href="' . tep_href_link(FILENAME_SHIPPING) . '">' . BOX_INFORMATION_SHIPPING . '</a></li>' .
                                         '<li class="bg_list"><a href="' . tep_href_link(FILENAME_PRIVACY) . '">' . BOX_INFORMATION_PRIVACY . '</a></li>' .
                                         '<li class="bg_list"><a href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . BOX_INFORMATION_CONDITIONS . '</a></li>' .
										 '<li class="bg_list"><a href="' . tep_href_link(FILENAME_CONTACT_US) . '">' . BOX_INFORMATION_CONTACT . '</a></li>' .
                                         '</ul>');

    new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- information_eof //-->
