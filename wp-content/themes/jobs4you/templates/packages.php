<?php
/* 
* Template Name: Package
*/
if(!is_user_logged_in()){   
    $login = get_permalink( get_page_by_path( 'login' ) );
    wp_redirect( $login ); 
    exit;
}
$user_id = get_current_user_id();
$role = get_role_by_id($user_id);

if($role == 'company_user'){
    global $wpdb;
    $tablename = $wpdb->prefix . 'payment';
    $sql = "SELECT *  FROM ".$tablename." WHERE `user_id` = ".$user_id."  AND `end_date` > '".date('Y-m-d')."'";
    $results = $wpdb->get_results($sql);    
    if(empty($results)){
        $packages = get_permalink( get_page_by_path( 'packages' ) );
        ?>
        <script type="text/javascript">
          location.replace(<?php echo $packages; ?>);
        </script>
        <?php
        
    }
}else{
  $dashboard = get_permalink( get_page_by_path( 'dashboard' ) );
  wp_redirect( $dashboard ); 
  exit;
}

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
    .page-template-packages ul#primary-menu.login_navbar {
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
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-1">
                  <div class="detail-box">
                    <h1><u>SILVER</u></h1>
                    <ul>
                      <li><h4>Monthly Subscription<br>(1 Month)</h4></li>
                      <li><h4>Can be used in unlimited Job Post</h4></li>
                      <li><h4>Subscription Amount : Rs.2000</h4></li>
                      </ul>
                      <div>
                        <form method="post" action="<?php echo get_permalink( get_page_by_path( 'payment' ) ); ?>">
                          <?php 
                          $current_time = date("Y-M-d",time());
                          $future_timestamp = strtotime("+1 month");
                          $final_future = date("Y-M-d",+$future_timestamp);
                          ?>
                          <input type="hidden" name="during" id="during" value="1 Month">
                          <input type="hidden" name="package_name" id="package_name" value="Silver">
                          <input type="hidden" name="amount" id="amount" value="2000">
                          <input type="hidden" name="currency" id="currency" value="INR">
                          <input type="hidden" name="last_date" id="last_date" value="<?php echo $final_future; ?>">
                          <input type="submit" class="btn btn-dark" name="oneMonth" id="oneMonth" value="SUBSCRIBE">
                        </form>
                      </div>

                  </div>
                </div>
                <div class="col-md-4">
                  <div class="img-box">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/subscription.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-1">
                  <div class="detail-box">
                    <h1><u>GOLD</u></h1>
                    <ul>
                      <li><h4>Quarterly Subscription<br>(4 Months)</h4></li>
                      <li><h4>Can be used in unlimited Job Post</h4></li>
                      <li><h4>Subscription Amount : Rs.4000</h4></li>
                    </ul>
                    <div>
                      <form method="post" action="<?php echo get_permalink( get_page_by_path( 'payment' ) ); ?>">
                          <?php 
                          $current_time4 = date("Y-M-d",time());
                          $future_timestamp4 = strtotime("+4 month");
                          $final_future4 = date("Y-M-d",+$future_timestamp4);
                          ?>
                          <input type="hidden" name="package_name" id="package_name" value="Gold">
                          <input type="hidden" name="during" id="during" value="4 Months">
                          <input type="hidden" name="amount" id="amount" value="4000">
                          <input type="hidden" name="currency" id="currency" value="INR">
                          <input type="hidden" name="last_date" id="last_date" value="<?php echo $final_future4; ?>">
                          <input type="submit" class="btn btn-dark" name="fourMonth" id="fourMonth" value="SUBSCRIBE">
                        </form>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="img-box">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/subscription.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="carousel-item active">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-4 offset-md-1">
                    <div class="detail-box">
                      <h1><u>PLATINUM</u></h1>
                      <ul>
                      <li><h4>Yearly Subscription<br>(12 Months)</h4></li>
                      <li><h4>Can be used in unlimited Job Post</h4></li>
                      <li><h4>Subscription Amount :Rs.6000 </h4></li>
                      </ul>
                      <div>
                        <form method="post" action="<?php echo get_permalink( get_page_by_path( 'payment' ) ); ?>">
                          <?php 
                          $current_time12 = date("Y-M-d",time());
                          $future_timestamp12 = strtotime("+12 month");
                          $final_future12 = date("Y-M-d",+$future_timestamp12);
                          ?>
                          <input type="hidden" name="during" id="during" value="1 Year">
                          <input type="hidden" name="package_name" id="package_name" value="Platinum">
                          <input type="hidden" name="amount" id="amount" value="6000">
                          <input type="hidden" name="currency" id="currency" value="INR">
                          <input type="hidden" name="last_date" id="last_date" value="<?php echo $final_future12; ?>">
                          <input type="submit" class="btn btn-dark" name="oneYear" id="oneYear" value="SUBSCRIBE">
                        </form>
                      </div>
                    </div>
                  </div>
                <div class="col-md-4">
                  <div class="img-box">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/subscription.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
    
  </div>
<?php get_footer();