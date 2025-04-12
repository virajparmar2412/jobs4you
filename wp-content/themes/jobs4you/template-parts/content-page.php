<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jobs4you
 */

?>
<div class="heading_container">
	<h2>	  
	  <span>
	    <?php the_title(); ?>
	  </span>
	</h2>
</div>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

	<?php jobs4you_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jobs4you' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>	
</div>
