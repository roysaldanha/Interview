
global $wpdb;



$myrows = $wpdb->get_results( "select count(`meta_value`) as count,meta_value from wp_woocommerce_order_itemmeta where meta_key IN('session-1','session-2', 'session-3') Group by `meta_value`", 'ARRAY_A' );
$avoidableDays = array();

foreach ($myrows as $k => $myrow) {
    if($myrow['count']>1) {
        $avoidableDays[] = $myrow['meta_value'];
    }
}



$attribute_keys = array_keys( $attributes );
 $newAttributes = array();

foreach ($attributes as $k => $attribute) {
    $newVAlues = array();
    foreach ($attribute as $m=> $value) {
        if(!in_array($value,$avoidableDays)) {
            $newVAlues[] = $value;
        }
    }
    $newAttributes[$k] = $newVAlues;
    
}




remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 15);

add_action('woocommerce_before_shop_loop_item', 'woocommerce_add_aff_link_open', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_add_aff_link_close', 10);

function woocommerce_add_aff_link_open(){
  $product = wc_get_product(get_the_ID());
  if( $product->is_type( 'external' ) ) {       
    echo '<a href="' . $product->get_product_url() . '" class="woocommerce-LoopProductImage-link" target="_blank">';     
  } else {      
      $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
      echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
     // echo '<a href="' . $product->get_product_url() . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
  }
}

function woocommerce_add_aff_link_close(){
  $product = wc_get_product(get_the_ID());
  if( $product->is_type( 'external' ) )
    echo '</a>';
}


https://wordpress.org/plugins/wc-external-product-new-tab/

https://stackoverflow.com/questions/40946495/woocommerce-external-affiliate-product-image-to-external-link-buy-url
