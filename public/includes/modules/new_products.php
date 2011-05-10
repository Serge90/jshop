<?php
/*
  $Id: new_products.php 1806 2008-01-11 22:48:15Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- new_products //-->
<?php
//  $info_box_contents = array();
//  $info_box_contents[] = array('text' => sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')));
//  new contentBoxHeading($info_box_contents);
  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
    $new_products_query = tep_db_query("select p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . (MAX_DISPLAY_NEW_PRODUCTS - $sum2));
  } else {
    $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . (MAX_DISPLAY_NEW_PRODUCTS - $sum2));
  }
  $row = 0;
  $col = 0;
  $info_box_contents = array();
  while ($new_products = tep_db_fetch_array($new_products_query)) {
// ----------	
  $product_query = tep_db_query("select products_description, products_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$new_products['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
  $product = tep_db_fetch_array($product_query);
  $p_id = $product['products_id'];	
	  
  $p_pic = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
  
  $p_name = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a>';
  
  $p_desc = ''.substr(strip_tags($product['products_description']), 0, MAX_DESCR_1).' ...';
  
  $p_price = '<span class="productSpecialPrice">'.$currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])).'</span>';
  
  $p_details = '<a href="' . tep_href_link('product_info.php?products_id='.$p_id) . '">'.tep_image_button('button_details.gif', '', ' class="btn1"').'</a>';
  $p_buy_now = '<a href="'.tep_href_link("products_new.php","action=buy_now&products_id=".$p_id).'">'.tep_image_button('button_add_to_cart2.gif', '', ' class="btn2"').'</a>';

    $info_box_contents[$row][$col] = array('align' => 'left',
                                           'params' => ' style="width:1px;"',
                                           'text' => ''.tep_draw_prod2_top().'
	<table cellpadding="0" cellspacing="0" border="0">
		<tr><td class="pic2_padd">'.tep_draw_prod_pic_top().''.$p_pic.''.tep_draw_prod_pic_bottom().'</td></tr>
		<tr><td class="name name2_padd">'.$p_name.'</td></tr>
		<tr><td class="price2_padd"><b>'.PRICE.':</b> '.$p_price.'</td></tr>
		<tr><td class="button2_padd button2_marg">'.$p_buy_now.' '.$p_details.'</td></tr>
	</table>									   
	'.tep_draw_prod2_bottom().'');
    $col ++;
    if ($col > 4) {
      $col = 0;
      $row ++;
    }
  }

  new contentBox($info_box_contents);
?>
<!-- new_products_eof //-->
