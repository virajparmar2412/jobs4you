<?php
/* 
* Template Name: Jobs
*/
get_header();
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
?>
<!-- job section -->
<section class="job_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Recommended jobs <br>
          <span>
            15000+ Job Available For you
          </span>
        </h2>
      </div>
      <?php if($categories){ ?>
      <div class="handler_btn-box" id="myTab" role="tablist">
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
      </div>
      <?php } wp_reset_query(); ?>
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
      

    </div>
</section>
<!-- end job section -->
<?php get_footer();