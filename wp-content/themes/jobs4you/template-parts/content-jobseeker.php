<div class="col-6 mb-4">
    <a class="dash-card" href="<?php echo get_permalink( get_page_by_path( 'my-profile' ) ); ?>">
        <h2 class="m-0">Generate Resume</h2>
    </a>
</div>

<div class="col-6 mb-4">
    <a class="dash-card" href="<?php echo get_permalink( get_page_by_path( 'applied-jobs' ) ); ?>">
        <h2 class="m-0">View Job</h2>
    </a>
</div>
<div class="col-6 mb-4">
    <a class="dash-card" href="<?php echo get_permalink( get_page_by_path( 'change-password' ) ); ?>">
        <h2 class="m-0">Change Password</h2>
    </a>
</div>
<div class="col-6 mb-4">
    <a class="dash-card" href="<?php echo wp_logout_url( get_permalink( get_page_by_path( 'login' ) ) ); ?>">
        <h2 class="m-0">Log Out</h2>
    </a>
</div>