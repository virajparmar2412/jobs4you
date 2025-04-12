<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package jobs4you
 */

get_header();
?>
<section class="job_section layout_padding">
		<div class="container">
			<div class="heading_container">
				<h2>	  
					  <span>
					  	<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'jobs4you' ), '<span>' . get_search_query() . '</span>' );
						?>
					</span>
				</h2>
			</div>
			<main id="primary" class="site-main">			
				<div class="content-box">
					<div class="content layout_padding2-top">
						<?php if ( have_posts() ) :
								while ( have_posts() ) :
									the_post();
									get_template_part( 'template-parts/content', 'search' );
								endwhile;
								the_posts_navigation();
							else :
								get_template_part( 'template-parts/content', 'none' );
							endif;
						?>
					</div>
				</div>
			</main>
		</div>
	</section>	
<?php
get_footer();