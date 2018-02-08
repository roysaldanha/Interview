
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
