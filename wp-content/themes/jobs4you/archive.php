<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jobs4you
 */

get_header();
$category = get_queried_object(); 
$subcategories = get_categories( array(
    'orderby' => 'id',
    'order' => 'DESC',
    'hide_empty' => false,
    'parent' => $category->term_id,
) );
?>
<?php if($subcategories){ ?>
	<section class="job_section layout_padding">
		<div class="container">
			<div class="heading_container">
				<h2>	  
				  <span>
				    <?php the_archive_title(); ?>
				  </span>
				</h2>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
			</div>
			<?php if($subcategories){ ?>
				<main id="primary" class="site-main">			
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
				</main>
			<?php } ?>
		</div>
	</section>
<?php } ?>
<?php if($category->parent != 0){ ?>
<div class="container my-5">
	<h4 class="job-listing-title"><?php the_archive_title(); ?></h4>
	<?php if ( have_posts() ) : 				
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'category-post' );
		endwhile;
		the_posts_navigation();
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>			
</div>
<?php } ?>
<?php
get_footer();