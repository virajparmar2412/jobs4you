<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jobs4you
 */

$copy_rights = get_field('copy_rights', 'option');
?>
<!-- info section -->
  <section class="info_section layout_padding2-bottom layout_padding-top">
    <div class="container info_content">
      <div>
        <div class="row">
          <div class="col-md-3 about_links">
            <div class="d-flex">
              <h5>
                About Us
              </h5>
            </div>
            <div class="d-flex ">
            	<?php
      				wp_nav_menu(
      					array(
      						'theme_location' => 'menu-2',						
      						'container'=>'ul', 
      						'menu_class'=>'', 
      						'add_a_class'=>'',
      						'add_li_class' => ''
      					)
      				);
      				?>              
            </div>
          </div>
          <div class="col-lg-9">
          	<?php /*if( have_rows('social_links', 'option') ): ?>
              	<div class="social-box">
              		<?php while( have_rows('social_links', 'option') ) : the_row(); ?>
	                  <a href="<?php the_sub_field('url'); ?>">
	                    <img src="<?php the_sub_field('icon'); ?>" alt="Socials" />
	                  </a>
                  	<?php endwhile; ?>                  
                </div>
            <?php endif;*/ ?>
            <?php /* <div class="form_container mt-2">
              <form action="<?php echo get_permalink( get_page_by_path( 'thank-you' ) ); ?>" method="post" id="subscribeMail_page">
                  <input type="email" placeholder="Enter Your email" id="subscribeMail" name="subscribeMail" required="required" />
                  <input type="hidden" id="message" name="message" value="Welcome to Jobs4You! – Thank you for subscribing to Jobs4You"  />
                  <button type="submit">
                      Subscribe
                  </button>
              </form>
            </div> */ ?>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- end info_section -->
 <!-- footer section -->
  <footer class="container-fluid footer_section">
    <p>
      <?php echo $copy_rights; ?>
    </p>
  </footer>
  

<?php wp_footer(); ?>

</body>
</html>
