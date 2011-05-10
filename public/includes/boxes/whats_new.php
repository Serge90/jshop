<?php
/*
  $Id: whats_new.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if ($random_product = tep_random_select("select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_status = '1' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
?>
<!-- whats_new //-->
          <tr>
            <td>
<?php
    $random_product['products_name'] = tep_get_products_name($random_product['products_id']);
    $random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);

    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_WHATS_NEW);

    new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_PRODUCTS_NEW));
	
$product_query = tep_db_query("select products_description, products_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$random_product['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
	$product = tep_db_fetch_array($product_query);
	
    if (tep_not_null($random_product['specials_new_products_price'])) {
      
	  $name_prod = '
	  <span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . substr(strip_tags($random_product['products_name']),0,MAX_DESCR_NAME_BOX) . '</a></span>
	  ';
	  
	  $whats_new_price = '<s>' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s> &nbsp; &nbsp; ';
      $whats_new_price .= '<span class="productSpecialPrice">' . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
	   $pic_prod = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '</a>';	  
    } else {
      $whats_new_price = '<span class="productSpecialPrice">'.$currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])).'</span>';
	  
	   $name_prod = '<span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a></span>';
	  
	   $pic_prod = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '</a>';
	  
   	  $p_desc = ''.substr(strip_tags($product['products_description']), 0, MAX_DESCR_1).' ...';
    }

    $info_box_contents = array();
    $info_box_contents[] = array('align' => '',
                                 'text' => '
	<table cellpadding="0" cellspacing="0" border="0">
		<tr><td class="pic_padd">'.tep_draw_prod_pic2_top().''.$pic_prod.''.tep_draw_prod_pic2_bottom().'</td></tr>
		<tr><td class="name_padd">'.$name_prod.'</td></tr>
		<tr><td class="price_padd">'.$whats_new_price.'</td></tr>
	</table>');
    new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- whats_new_eof //-->
<?php
  }
?>
