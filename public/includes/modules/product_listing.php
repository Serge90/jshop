<?php
/*
  $Id: product_listing.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<?php echo tep_draw_title_top();?>

				<?php echo $breadcrumb->trail(' &raquo; ')?>
			
<?php echo tep_draw_title_bottom();?>	
<?php
  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');

  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>

<?php echo tep_draw_result1_top(); ?>
       
		<table border="0" cellspacing="0" cellpadding="0" class="result result_top_padd">
          <tr>
            <td><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
            <td class="result_right" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table>

<?php echo tep_draw_result1_bottom();  ?> 
       
<?php
  }
								
 echo tep_draw3_top();


$info_box_contents = array();
  $list_box_contents = array();
$my_row = 0;
$my_col = 0;


  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_NAME':
        $lc_text = TABLE_HEADING_PRODUCTS;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_MANUFACTURER':
        $lc_text = TABLE_HEADING_MANUFACTURER;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $lc_text = TABLE_HEADING_QUANTITY;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $lc_text = TABLE_HEADING_WEIGHT;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_IMAGE':
        $lc_text = TABLE_HEADING_IMAGE;
        $lc_align = 'center';
        break;
      case 'PRODUCT_LIST_BUY_NOW':
        $lc_text = TABLE_HEADING_BUY_NOW;
        $lc_align = 'center';
        break;
    }

    if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') ) {
      $lc_text = tep_create_sort_heading($HTTP_GET_VARS['sort'], $col+1, $lc_text);
    }

    $list_box_contents[0][] = array('align' => $lc_align,
                                    'params' => 'class="productListing-heading"',
                                    'text' => '&nbsp;' . $lc_text . '&nbsp;');
  }

  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
    while ($listing = tep_db_fetch_array($listing_query)) {
      $rows++;

      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($list_box_contents) - 1;

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';

        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_MODEL':
            $lc_align = '';
							
            $p_model = '<tr>
							<td><b><font>'.TABLE_HEADING_MODEL.'&nbsp;:</font></b></td>
							<td align="right"><font>' . $listing['products_model'] . '</font></td>
						</tr>';
            break;
          case 'PRODUCT_LIST_NAME':
            $lc_align = '';
            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
            $p_name = $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a>';
            } else {
            $p_name = $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a>';
            }
            break;
          case 'PRODUCT_LIST_MANUFACTURER':
            $lc_align = '';
            $p_manufact = '<tr>
							<td><b><font>'.TABLE_HEADING_MANUFACTURER.'&nbsp;:</font></b></td>
							<td align="right"><font><a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] . '</a></font></td>
						</tr>';
            break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = 'right';
            if (tep_not_null($listing['specials_new_products_price'])) {
           $p_price = $lc_text = '<s>' .  $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</s>&nbsp;&nbsp; <span class="productSpecialPrice">' . $currencies->display_price($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>';
            } else {
           $p_price = $lc_text = '<span class="productSpecialPrice">' . $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>';
            }
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $lc_align = 'right';
            $p_qty = '<tr>
							<td><b><font>'.TABLE_HEADING_QUANTITY.'&nbsp;:</font></b></td>
							<td align="right"><font>' . $listing['products_quantity'] . '</font></td>
						</tr>';
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $lc_align = 'right';
            $p_weight = '<tr>
							<td><b><font>'.TABLE_HEADING_WEIGHT.'&nbsp;:</font></b></td>
							<td align="right"><font>' . $listing['products_weight'] . '</font></td>
						</tr>';
            break;
          case 'PRODUCT_LIST_IMAGE':
            $lc_align = 'center';
            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
              $p_pic = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
            } else {
              $p_pic = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
            }
            break;
          case 'PRODUCT_LIST_BUY_NOW':
            $lc_align = 'center';
            $p_button =  $lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now1.gif', IMAGE_BUTTON_BUY_NOW) . '</a>';
            break;
        }
		
$product_query = tep_db_query("select products_description, products_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$listing['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
      $product = tep_db_fetch_array($product_query);
       	$p_desc = substr(strip_tags($product['products_description']), 0, MAX_DESCR_1).'...<br>';
		
	  if (PRODUCT_LIST_MODEL != 0 || PRODUCT_LIST_MANUFACTURER != 0 || PRODUCT_LIST_QUANTITY != 0 || PRODUCT_LIST_WEIGHT != 0) {
		$p_listing = '<table cellpadding="0" cellspacing="0" border="0" class="listing">'.$p_model.''.$p_manufact.'' . ''.$p_qty.'' . ''.$p_weight.'</table>';
		}
		
        $p_id = $product['products_id'];
		
/*		$list_box_contents[$cur_row][] = array('align' => $lc_align,
                                               'params' => '',
                                               'text'  => $lc_text); */

 }

  $p_details = '<a href="' . tep_href_link('product_info.php?products_id='.$p_id) . '">'.tep_image_button('button_details.gif', '', ' class="btn1"').'</a>';
  $p_buy_now = '<a href="'.tep_href_link("products_new.php","action=buy_now&products_id=".$p_id).'">'.tep_image_button('button_add_to_cart2.gif', '', ' class="btn1"').'</a>';
		
 
 $info_box_contents[$my_row][$my_col] = array('align' => 'center',
                                           'params' => ' style="width:1px;"',
                                           'text' => ''.tep_draw_prod2_top().'
	<table cellpadding="0" cellspacing="0" border="0">
		<tr><td class="pic2_padd">'.tep_draw_prod_pic_top().''.$p_pic.''.tep_draw_prod_pic_bottom().'</td></tr>
		<tr><td class="name name2_padd">'.$p_name.'</td></tr>
		<tr><td class="desc desc2_padd">'.$p_desc.'</td></tr>	
		<tr><td class="listing2_padd">'.$p_listing.'</td></tr>		
		<tr><td class="price2_padd"><b>'.PRICE.':</b> '.$p_price.'</td></tr>
		<tr><td class="button2_padd button2_marg">'.$p_buy_now.' '.$p_details.'</td></tr>
	</table>									   
	'.tep_draw_prod2_bottom().'');
    $my_col ++;
    if ($my_col > 4) {
      $my_col = 0;
 	$my_row ++;
      }
    }
new contentBox($info_box_contents); 
//    new productListingBox($list_box_contents);
 } else {  ?>
 <?php /* echo tep_draw4_top(); */ ?>

				<table cellpadding="0" cellspacing="0" class="main">
					<tr><td style="padding:25px 0px 20px 0px;"><?php echo TEXT_NO_PRODUCTS ?></td></tr>
				</table>

<?php /* echo tep_draw4_bottom(); */?>                
                
<?php			
}
?>
<?php echo tep_draw3_bottom();?>
<?php
  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>

<?php echo tep_draw_result2_top(); ?> 
       
		<table border="0" cellspacing="0" cellpadding="0" class="result result_bottom_padd">
          <tr>
            <td><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
            <td class="result_right" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table>

<?php echo tep_draw_result2_bottom(); ?> 

<?php
  }
?>
