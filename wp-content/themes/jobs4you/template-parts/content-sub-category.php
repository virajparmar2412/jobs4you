<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jobs4you
 */
$category = get_queried_object(); 
$subcategories = get_categories( array(
    'orderby' => 'id',
    'order' => 'DESC',
    'hide_empty' => false,
    'parent' => $category->term_id,
) );
if($subcategories){ ?>
	<div class="content-box">
		<div class="content layout_padding2-top">
			<?php foreach( $subcategories as $sub_category ) {  ?>
			  <div class="box">
			    <h3><?php echo $sub_category->name; ?></h3>
			    <a href="<?php echo get_category_link( $sub_category->term_id ); ?>">View</a>
			  </div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
