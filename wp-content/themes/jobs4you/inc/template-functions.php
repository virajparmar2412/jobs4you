<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package jobs4you
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jobs4you_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'jobs4you_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function jobs4you_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'jobs4you_pingback_header' );


add_filter('nav_menu_link_attributes', 'job4you_add_additional_class_on_a', 1, 3);
function job4you_add_additional_class_on_a($classes, $item, $args){
    if (isset($args->add_a_class)) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}

function job4you_add_additional_class($classes, $item, $args){
    if(isset($args->add_li_class)){
        $classes[] = $args->add_li_class;
    }
    return $classes;
}

add_filter('nav_menu_css_class', 'job4you_add_additional_class', 999, 3);

add_filter('use_block_editor_for_post', '__return_false', 10);


add_action( 'init', 'cp_change_post_object' );
// Change dashboard Posts to News
function cp_change_post_object() {
	$get_post_type = get_post_type_object('post');
	$labels = $get_post_type->labels;
	$labels->name = 'Jobs';
	$labels->singular_name = 'Jobs';
	$labels->add_new = 'Add Job';
	$labels->add_new_item = 'Add Job';
	$labels->edit_item = 'Edit Job';
	$labels->new_item = 'Jobs';
	$labels->view_item = 'View Job';
	$labels->search_items = 'Search Jobs';
	$labels->not_found = 'No Jobs found';
	$labels->not_found_in_trash = 'No Jobs found in Trash';
	$labels->all_items = 'All Jobs';
	$labels->menu_name = 'Jobs';
	$labels->name_admin_bar = 'Jobs';
}

if( function_exists('acf_add_options_page') ) {    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));    
}

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});


function job4you_update_custom_roles() {
    if ( get_option( 'job4you_custom_roles' ) < 1 ) {
        add_role( 'jobseeker_user', 'Jobseeker', array( 'read' => true, 'level_0' => true ) );        
        add_role( 'company_user', 'Company', array( 'read' => true, 'level_0' => true ) );
        update_option( 'job4you_custom_roles', 1 );
    }
   
}
add_action( 'init', 'job4you_update_custom_roles' );

// admin_init action works better than admin_menu in modern wordpress (at least v5+)
add_filter('show_admin_bar', '__return_false');
add_action( 'admin_init', 'my_remove_menu_pages' );//
function my_remove_menu_pages() {

   
   /*remove_menu_page('users.php'); // Users*/
   
   remove_menu_page( 'edit.php' );
   remove_menu_page('link-manager.php'); // Links
   remove_menu_page('update-core.php');   
   remove_menu_page('tools.php'); // Tools
   remove_menu_page('themes.php'); // Appearance
   remove_menu_page('edit-comments.php'); // Comments
   remove_menu_page('edit.php?post_type=page'); // Pages
   remove_menu_page('customize.php?return=%2Fwp-admin%2Fthemes.php');
   remove_menu_page('edit.php?post_type=acf-field-group'); // Posts
   remove_menu_page('options-general.php'); 
   remove_menu_page('plugins.php');
   remove_menu_page('upload.php');
   
   remove_menu_page('options-general.php'); 
   
  
}

/*
* Creating a function to create our CPT
*/
  
function custom_post_type() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Company', 'Post Type General Name', 'twentytwentyone' ),
        'singular_name'       => _x( 'Company', 'Post Type Singular Name', 'twentytwentyone' ),
        'menu_name'           => __( 'Company', 'twentytwentyone' ),
        'parent_item_colon'   => __( 'Parent Company', 'twentytwentyone' ),
        'all_items'           => __( 'All Company', 'twentytwentyone' ),
        'view_item'           => __( 'View Company', 'twentytwentyone' ),
        'add_new_item'        => __( 'Add New Company', 'twentytwentyone' ),
        'add_new'             => __( 'Add New', 'twentytwentyone' ),
        'edit_item'           => __( 'Edit Company', 'twentytwentyone' ),
        'update_item'         => __( 'Update Company', 'twentytwentyone' ),
        'search_items'        => __( 'Search Company', 'twentytwentyone' ),
        'not_found'           => __( 'Not Found', 'twentytwentyone' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
    );
      
// Set other options for Custom Post Type
      
    $args = array(
        'label'               => __( 'Company', 'twentytwentyone' ),
        'description'         => __( 'Company news and reviews', 'twentytwentyone' ),
        'labels'              => $labels,       
        'supports'            => array( 'title' ),
        'hierarchical'        => false,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
  
    );
      
    // Registering your Custom Post Type
    register_post_type( 'company', $args );
  
}
  
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
  
add_action( 'init', 'custom_post_type', 0 );

function random_username($string) {
    $pattern = " ";
    $firstPart = strstr(strtolower($string), $pattern, true);
    $secondPart = substr(strstr(strtolower($string), $pattern, false), 0,3);
    $nrRand = rand(0, 100);

    $username = trim($firstPart).trim($secondPart).trim($nrRand);
    return $username;
}

add_action('wp_logout','auto_redirect_after_logout');

function auto_redirect_after_logout(){
  wp_safe_redirect( get_permalink( get_page_by_path( 'login' ) ) );
  exit;
}

function get_role_by_id( $id ) {

    if ( !is_user_logged_in() ) { return false; }

    $oUser = get_user_by( 'id', $id );
    $aUser = get_object_vars( $oUser );
    $sRole = $aUser['roles'][0];
    return $sRole;

}


function admin_head_css(){
    echo '
    <style>
    tr.user-rich-editing-wrap, tr.user-admin-color-wrap, tr.user-comment-shortcuts-wrap, tr.user-url-wrap, .user-edit-php h2, tr.user-description-wrap, tr.user-profile-picture, div#application-passwords-section {
    display: none;
    }</style>';
}
add_action('admin_head','admin_head_css');


function new_contact_methods( $contactmethods ) {
    $contactmethods['user_flag'] = 'User Status';
    return $contactmethods;
}
add_filter( 'user_contactmethods', 'new_contact_methods', 10, 1 );


function new_modify_user_table( $column ) {
    $column['user_flag'] = 'User Status';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    $userRole = get_role_by_id($user_id);
    switch ($column_name) {
        case 'user_flag' :
            if($userRole != 'administrator'){
                return (get_the_author_meta( 'user_flag', $user_id ))?get_the_author_meta( 'user_flag', $user_id ):'deactive';
            }else{
                return get_the_author_meta( 'user_flag', $user_id );
            }
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );