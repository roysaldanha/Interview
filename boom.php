<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
 

global $post;

global $WOOF;
$product_cats = wp_get_post_terms( $post->ID, 'product_cat' ); 

$new_cats =  array();
foreach ($product_cats as $k => $product_cat) {
    $new_cats[] = $product_cat->term_id;
} 
 


if (!empty($terms) AND is_array($terms)){  ?>
<ul class="tree">
    <?php foreach ($terms as $term) { 
        $inique_id = uniqid();  
        if(in_array($term['term_id'], $new_cats)) { ?>
            <li id="boomBoom">
                <?php if(!empty($term['childs'])) { ?>
                    <a href="javascript: void(0);" class="expand_button poof_is_opened" id="expand_button_<?php echo $term['term_id']; ?>">-</a>
                    <?php } ?>
                <?php echo $term['name']; 
                if (!empty($term['childs'])) {
                        $WOOF->woof_draw_checkbox_childs_own($taxonomy_info, $tax_slug, $term['term_id'], $term['childs'], $show_count, $show_count_dynamic, $hide_dynamic_empty_pos, $new_cats);
                } 
            } else {  
                if (!empty($term['childs'])) {
                    $WOOF->woof_draw_checkbox_childs_own($taxonomy_info, $tax_slug, $term['term_id'], $term['childs'], $show_count, $show_count_dynamic, $hide_dynamic_empty_pos, $new_cats);
                } 
            }  
        } ?>
    </li>
</ul>

<?php } 


//we need it only here, and keep it in $_REQUEST for using in function for child items
unset($_REQUEST['additional_taxes']);
