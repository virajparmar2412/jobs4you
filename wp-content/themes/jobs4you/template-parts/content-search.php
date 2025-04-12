<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jobs4you
 */

?>
<div class="job-card">
   <div class="job-info-left">
      <?php the_title( sprintf( '<h5 class="job-title">', esc_url( get_permalink() ) ), '</h5>' ); ?>
      <h6 class="company-name"><?php the_author(); ?></h6>
      <span class="job-subtext"><span class="job-subtitle">Exp:</span> <?php echo get_field("experience"); ?></span>
      <span class="job-subtext"><span class="job-subtitle">Skills:</span> <?php echo get_field("skills"); ?></span>
      <span class="job-subtext"><span class="job-subtitle">Location:</span> <?php echo get_field("location"); ?></span>
      <p class="job-desc"><?php echo get_the_excerpt(); ?></p>
   </div>
   <?php
   if(is_user_logged_in()){   
      $user_id = get_current_user_id();
      $role = get_role_by_id($user_id);
      if($role == 'jobseeker_user'){
         ?>
         <a class="btn btn-dark" href="<?php echo get_permalink(188); ?>/?jobid=<?php echo get_the_ID(); ?>" >Apply Now</a>
         <?php
      }
   }
   ?>
</div>