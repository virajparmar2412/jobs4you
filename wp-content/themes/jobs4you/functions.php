<?php
/**
 * Implement the after setup theme.
 */
require get_template_directory() . '/inc/after_setup_theme.php';
/**
 * Implement the enqueue scripts and styles.
 */
require get_template_directory() . '/inc/wp_enqueue_scripts.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Ajax
 */
require get_template_directory() . '/inc/ajax.php';

require get_template_directory() . '/inc/subscriber.php';


/**
 * Admin side
 */
require get_template_directory() . '/inc/adminreports.php';

/**
 * Forgot Password
 */
require get_template_directory() . '/inc/forgot_email_fn.php';