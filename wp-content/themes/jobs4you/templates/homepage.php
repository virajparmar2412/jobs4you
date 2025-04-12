<?php
/* 
* Template Name: Homepage
*/
get_header('home');
/*====================================
 * Queries 
 *====================================*/

/**************************************
 * 1. Category Section Query
 **************************************/
$categories_section = get_field('categories_section');
/**************************************
 * 2. Get Category Query
 **************************************/
$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC',
    'hide_empty'      => false,
    'parent' => 0,
) );
/**************************************
 * 3. Get Feature Section Query
 **************************************/
$featured_job_title = get_field('featured_job_title');
$short_details = get_field('short_details');
$button_text = get_field('button_text');
$button_url = get_field('button_url');
$side_feature_image = get_field('side_feature_image');

/**************************************
* 4. Client Testimonials Section
**************************************/ 
$client_testimonials_title = get_field('client_testimonials_title');
$client_testimonials = have_rows('client_testimonials');

/*====================================
 * HTML
 *====================================*/


/**************************************
* 1. Find section
**************************************/ 
?>
<section class="find_section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 offset-lg-1 col-md-9 offset-md-1">
        <form action="<?php echo get_permalink(185) ?>" method="get">
          <div class="form_container">
            <div class="box b-1">
              <input type="text" name="keywords" class="form-control" id="tags" placeholder="Job Title or Keywords ">
            </div>
            <?php if($categories){ ?>
            <div class="box b-2">
              <select class="custom-select h-100" id="inputGroupSelect01" name="jobType">
                <option selected disabled value="">Job Timing</option>
                <?php foreach( $categories as $category ) { ?>                  
                  <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
                <?php } ?>    
              </select>
            </div>
            <?php } wp_reset_query(); ?>
            <div class="box b-3">
              <select class="custom-select h-100" id="inputGroupSelect02" name="jobCategory">
                <option selected disabled>Category</option>
              </select>
            </div>
            <div class="btn-box">
              <input type="submit" class="btn-yello" value="Search">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php 
/**************************************
* 2. Category Section
**************************************/ 
?>
<?php if($categories_section){ ?>  
  <section class="job_section layout_padding-bottom">
    <div class="container">
      <?php if($categories_section['title'] || $categories_section['sub_title']){ ?>
        <div class="heading_container">
          <h2>
            <?php if($categories_section['title']){ ?>
              <?php echo $categories_section['title']; ?> <br>
            <?php } ?>
            <?php if($categories_section['sub_title']){ ?>
              <span>
                <?php echo $categories_section['sub_title']; ?>
              </span>
            <?php } ?>
          </h2>
        </div>
      <?php } ?>
      <?php if($categories_section['category'] == 1){ ?>
        <div class="handler_btn-box" id="myTab" role="tablist">        
          <?php if($categories){ ?>
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <?php 
                  $i=1;
                  foreach( $categories as $category ) {
                      if($i == 1){ $activeCls = 'active';  }else{  $activeCls = '';  }                
                      echo '<li class="nav-item">
                          <a class="nav-link '.$activeCls.' " id="jb-'.$category->term_id.'-tab" data-toggle="tab" href="#jb-'.$category->term_id.'" role="tab" aria-controls="jb-'.$category->term_id.'"
                            aria-selected="true">'.$category->name.'</a>
                        </li>';
                  $i++;} ?>
              </ul>
          <?php } wp_reset_query(); ?>
        </div>
      
        <?php if($categories){ ?>
          <div class="tab-content" id="myTabContent">
            <?php 
            $j=1;
            foreach( $categories as $category ) { 
                if($j == 1){ $activeParentCls = 'fade show active';  }else{  $activeParentCls = '';  }  ?>
                <div class="job_board tab-pane <?php echo $activeParentCls; ?>" id="jb-<?php echo $category->term_id; ?>" role="tabpanel" aria-labelledby="jb-<?php echo $category->term_id; ?>-tab">
                  <div class="content-box">
                    <div class="content layout_padding2-top">
                        <?php    
                        $subcategories = get_categories( array(
                            'orderby' => 'id',
                            'order' => 'DESC',
                            'number' => 8,
                            'hide_empty' => false,
                            'parent' => $category->term_id,
                        ) );  ?>
                        <?php foreach( $subcategories as $sub_category ) {  ?>
                          <div class="box">
                            <h3><?php echo $sub_category->name; ?></h3>
                            <a href="<?php echo get_category_link( $sub_category->term_id ); ?>">View</a>
                          </div>
                        <?php } ?>                      
                    </div>
                    <div class="btn-box">
                      <a href="<?php echo get_category_link( $category->term_id ); ?>">
                        See More
                      </a>
                    </div>
                  </div>
                </div>
            <?php $j++; } ?>            
          </div>
        <?php } wp_reset_query(); ?>
      <?php } ?>
    </div>
  </section>  
<?php } ?>
<?php 
/**************************************
* 3. Feature Job Section
**************************************/ 
?>
<?php if(($featured_job_title) || ($short_details) || ($button_text) || ($side_feature_image)){ ?>  
  <section class="feature_section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 offset-md-1">
          <div class="detail-box">
            <?php if($featured_job_title){ ?>
            <h2>
              <?php echo $featured_job_title; ?>
            </h2>
            <?php } ?>
            <p>
              <?php echo $short_details; ?>
            </p>
            <a href="<?php echo $button_url; ?>">
              <?php echo $button_text; ?>
            </a>
          </div>
        </div>
        <div class="col-md-6 px-0">
          <div class="img-box">
            <img src="<?php echo $side_feature_image; ?>" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>  
<?php } ?>
<?php 
/**************************************
* 4. Client Testimonials Section
**************************************/ 
?>
<?php if(($client_testimonials) || ($client_testimonials_title)){ ?>
  <section class="client_section ">
    <div class="container layout_padding">
      <?php if($client_testimonials_title){ ?>
        <div class="heading_container">
          <h2>
            <?php echo $client_testimonials_title; ?>
          </h2>
        </div>
      <?php } ?>
      <?php if((have_rows('client_testimonials'))){ ?>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="sr-only">Next</span>
          </a>
          <div class="carousel-inner">
            <?php $l=1; while(have_rows('client_testimonials')) : the_row(); 
              $client_image = get_sub_field('client_image');
              $client_name = get_sub_field('client_name');
              $client_testimonial = get_sub_field('client_testimonial');
              if($l==1){
                $cl = 'active';
              }else{
                $cl = '';
              }
              ?>
              <?php if(($client_image) || ($client_name) || ($client_testimonial)){ ?>
                <div class="carousel-item <?php echo $cl; ?>">
                  <div class="box">
                    <?php if(($client_image)){ ?>
                      <div class="img-box">
                        <img src="<?php echo $client_image; ?>" alt="">
                      </div>
                    <?php } ?>
                    <?php if(($client_name) || ($client_testimonial)){ ?>
                      <div class="detail-box">
                        <?php if(($client_name)){ ?>
                          <h5>
                            <?php echo $client_name; ?>
                          </h5>
                        <?php } ?>
                        <?php if(($client_testimonial)){ ?>
                          <p>
                            <?php echo $client_testimonial; ?>
                          </p>
                        <?php } ?>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>
            <?php $l++; endwhile; ?>
            
          </div>
        </div>
      <?php } ?>
    </div>
  </section>  
<?php } ?>  
<?php 
/**************************************
* 5. Footer
**************************************/ 
get_footer(); ?>
