<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jobs4you
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
	<link rel="profile" href="https://gmpg.org/xfn/11">  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
  <style type="text/css">
    .page-template-homepage ul#primary-menu.login_navbar {
        margin-right: 120px;
    }
    div#login_form {
        margin-right: 52px;
    }
  </style>
</head>
<body <?php body_class(); ?>>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <span>
              <?php bloginfo( 'name' ); ?>
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <form class="form-inline search-form ml-0 mr-lg-4" id="search-form" action="" method="get">
                  <input type="hidden" name="post_type" value="post" />
                  <input class="form-control" id="search_txt" name="s" placeholder="Search Jobs" required="required" value="<?php echo (isset($_GET['s'])) ? $_GET['s'] : ''; ?>">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
              <?php
              if ( is_user_logged_in() ) {
                $cl = "login_navbar";
              }else{
                $cl = "";
              }
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-1',
                  'menu_id' => 'primary-menu',
                  'container'=>'ul', 
                  'menu_class'=>'navbar-nav '.$cl, 
                  'add_a_class'=>'nav-link',
                  'add_li_class' => 'nav-item'
                )
              );
              ?>
              <?php if ( is_user_logged_in() ) { 
                $current_user = wp_get_current_user();
                ?>
                <div class="dropdown" id="login_form">
                  <button  class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $current_user->user_login; ?>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?php echo get_permalink( get_page_by_path( 'dashboard' ) ); ?>">My Dashboard</a>
                    <a class="dropdown-item" href="<?php echo wp_logout_url( get_permalink( get_page_by_path( 'login' ) ) ); ?>">Logout</a>
                  </div>
                </div>
              <?php } else { ?>
                <ul class="user_option navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo get_permalink( get_page_by_path( 'login' ) ); ?>"> <img src="<?php echo get_template_directory_uri() ?>/assets/images/login.png" alt=""> <span>Login</span> </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo get_permalink( get_page_by_path( 'registration' ) ); ?>"> <img src="<?php echo get_template_directory_uri() ?>/assets/images/register.png" alt="">
                  <span>Register</span></a>
                  </li>
                </ul>
              <?php } ?> 
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <?php if( have_rows('banners') ): ?>
      <!-- slider section -->    
      <section class=" slider_section ">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <div class="indicator_box">
            <div>
              <span>
                01/
              </span>
            </div>
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2">03</li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3">04</li>
            </ol>
          </div>
          <div class="carousel-inner">
            <?php $k=1; while( have_rows('banners') ): the_row(); 
            $banner_image = get_sub_field('banner_image');
            $banner_title = get_sub_field('banner_title');
            $banner_button = get_sub_field('banner_button');
            $banner_link = get_sub_field('banner_link');
            if($k==1){
              $cl = 'active';
            }else{
              $cl = '';
            }
            ?>
              <div class="carousel-item <?php echo $cl; ?>">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-4 offset-md-1">
                      <div class="detail-box">
                        <h1>
                          <?php echo $banner_title; ?>
                        </h1>
                        <div>
                          <a href="<?php echo $banner_link; ?>">
                            <?php echo $banner_button; ?>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 ">
                      <div class="img-box">
                        <img src="<?php echo $banner_image; ?>" alt="slide">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php $k++; endwhile; ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="sr-only">Next</span>
          </a>
        </div>

      </section>
      <!-- end slider section -->
    <?php endif; ?>
  </div>