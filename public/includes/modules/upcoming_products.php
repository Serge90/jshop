<?php
/*
  $Id: upcoming_products.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  $expected_query = tep_db_query("select p.products_id, pd.products_name, products_date_available as date_expected from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where to_days(products_date_available) >= to_days(now()) and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by " . EXPECTED_PRODUCTS_FIELD . " " . EXPECTED_PRODUCTS_SORT . " limit " . MAX_DISPLAY_UPCOMING_PRODUCTS);
  if (tep_db_num_rows($expected_query) > 0) {
?>
<?php echo tep_draw_bottom();  ?>
<!-- upcoming_products //-->
<?php echo tep_draw_top();  ?>
 
<?php echo tep_draw_title_top();?> 

<div style="float:left;"><?php echo TABLE_HEADING_UPCOMING_PRODUCTS; ?></div><div style="float:right"><?php echo TABLE_HEADING_DATE_EXPECTED; ?></div>

<?php echo tep_draw_title_bottom();?> 

<?php echo tep_draw1_top();  ?>

             <table border="0" width="100%" cellspacing="0" cellpadding="0" class="main" style="margin:0px 0px 0px 0px;"> 
                  
<?php
    $row = 0;
    while ($expected = tep_db_fetch_array($expected_query)) {
      $row++;
      if (($row / 2) == floor($row / 2)) {
        echo '              <tr class="upcomingProducts-even">' . "\n";
      } else {
        echo '              <tr class="upcomingProducts-odd">' . "\n";
      }
      echo '                <td style="padding:5px 0px 5px 9px;" class="name vam"><b><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $expected['products_id']) . '">' . $expected['products_name'] . '</a></b></td>' . "\n" .
           '                <td align="right" style="padding:5px 9px 5px 0px;" class="name vam">' . tep_date_short($expected['date_expected']) . '</td>' . "\n" .
           '              </tr>' . "\n";
    }
?>
            </table>


<?php echo tep_draw1_bottom();?>
<!-- upcoming_products_eof //-->
<?php
  }
?>
