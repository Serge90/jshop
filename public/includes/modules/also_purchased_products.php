<?php
/*
  $Id: also_purchased_products.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if (isset($HTTP_GET_VARS['products_id'])) {
    $orders_query = tep_db_query("select p.products_id, p.products_image from " . TABLE_ORDERS_PRODUCTS . " opa, " . TABLE_ORDERS_PRODUCTS . " opb, " . TABLE_ORDERS . " o, " . TABLE_PRODUCTS . " p where opa.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and opa.orders_id = opb.orders_id and opb.products_id != '" . (int)$HTTP_GET_VARS['products_id'] . "' and opb.products_id = p.products_id and opb.orders_id = o.orders_id and p.products_status = '1' group by p.products_id order by o.date_purchased desc limit " . MAX_DISPLAY_ALSO_PURCHASED);
    $num_products_ordered = tep_db_num_rows($orders_query);
    if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED) {
		
?>
<?php echo tep_draw_bottom();?>
<?php echo tep_draw_top();?>
<!-- also_purchased_products //-->
<?php
      $info_box_contents = array();
      $info_box_contents[] = array('text' => TEXT_ALSO_PURCHASED_PRODUCTS);

      new contentBoxHeading($info_box_contents);
?>
<?php echo tep_draw3_top();?>
<?php
      $row = 0;
      $col = 0;
      $info_box_contents = array();
      while ($orders = tep_db_fetch_array($orders_query)) {
        $orders['products_name'] = tep_get_products_name($orders['products_id']);
		$p_pic = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $orders['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $orders['products_image'], $orders['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
		$p_name = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $orders['products_id']) . '">' . $orders['products_name'] . '</a>';
        $info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => ' style="width:1px;"',
                                           'text' => ''.tep_draw_prod2_top().'
				<table cellpadding="0" cellspacing="0" border="0">
					<tr><td class="name name2_padd">'.$p_name.'</td></tr>
					<tr><td class="pic2_padd">'.tep_draw_prod_pic_top().''.$p_pic.''.tep_draw_prod_pic_bottom().'</td></tr>
				</table>
				'.tep_draw_prod2_bottom().'');
        $col ++;
        if ($col > 3) {
          $col = 0;
          $row ++;
        }
      }

      new contentBox($info_box_contents);
?>

<?php echo tep_draw3_bottom();?>

<!-- also_purchased_products_eof //-->
<?php
    }
  }
?>
