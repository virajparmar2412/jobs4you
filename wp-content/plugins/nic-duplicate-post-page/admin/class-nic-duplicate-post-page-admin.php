<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://www.indianic.com/enquiry
 * @since      1.0.0
 *
 * @package    Nic_Duplicate_Post_Page
 * @subpackage Nic_Duplicate_Post_Page/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nic_Duplicate_Post_Page
 * @subpackage Nic_Duplicate_Post_Page/admin
 * @author     MageINIC <bhavesh.vala@indianic.com>
 */
class Nic_Duplicate_Post_Page_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nic_Duplicate_Post_Page_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nic_Duplicate_Post_Page_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nic-duplicate-post-page-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nic_Duplicate_Post_Page_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nic_Duplicate_Post_Page_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nic-duplicate-post-page-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function nic_duplicate_post_link( $actions, $post ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *		 
		 */

		if( ! current_user_can( 'edit_posts' ) ) {
			return $actions;
		}

		$url = wp_nonce_url(
			add_query_arg(
				array(
					'action' => 'nic_duplicate_post_or_page_draft_mode',
					'post' => intval($post->ID),
				),
				'admin.php'
			),
			basename(__FILE__),
			'duplicate_nonce'
		);

		$actions[ 'duplicate' ] = '<a href="' . esc_url($url) . '" title="'.esc_attr(esc_html('Duplicate this item')).'" rel="permalink">'.esc_html('WP Duplicate').'</a>';

		return $actions;

	}

	/**
	 * Duplicate Posts and pages as draft mode
	 * 
	 * @since 1.0.0
	 * 
	 */
	public function nic_duplicate_post_or_page_draft_mode() {

		if ( empty( $_GET[ 'post' ] ) ) {
			wp_die( 'No post to duplicate has been provided!' );
		}

		if ( ! isset( $_GET[ 'duplicate_nonce' ] ) || ! wp_verify_nonce( $_GET[ 'duplicate_nonce' ], basename( __FILE__ ) ) ) {
			return;
		}

		/***************************
		*Get the original post id
		***************************/
		$post_id = absint( $_GET[ 'post' ] );

		/****************************
		*The original post data useing get_post() function
		****************************/
		$post = get_post( $post_id );

		/****************************
		 * Current user to be the new post author,
		 * then change next couple of lines to this: $new_author = $post->post_author;
		 ****************************/
		$current_user = wp_get_current_user();
		$new_author = $current_user->ID;

		if ( $post ) {
			
			/****************************
			* New post or page data array
			****************************/

			$args = array(
				'comment_status' => intval($post->comment_status),
				'ping_status'    => intval($post->ping_status),
				'post_author'    => intval($new_author),
				'post_content'   => $post->post_content,
				'post_excerpt'   => $post->post_excerpt,
				'post_name'      => sanitize_text_field($post->post_name),
				'post_parent'    => intval($post->post_parent),
				'post_password'  => sanitize_text_field($post->post_password),
				'post_status'    => 'draft',
				'post_title'     => sanitize_text_field($post->post_title),
				'post_type'      => sanitize_text_field($post->post_type),
				'to_ping'        => intval($post->to_ping),
				'menu_order'     => intval($post->menu_order)
			);			
			$new_post_id = wp_insert_post( $args );
			/****************************
			 * get all current post terms and set them to the new post/page as draft
			 ****************************/
			$taxonomies = get_object_taxonomies( get_post_type( $post ) );
			if( $taxonomies ) {
				foreach ( $taxonomies as $taxonomy ) {
					$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
					wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
				}
			}

			/****************************
			 * duplicate all post meta
			 ****************************/
			$post_meta = get_post_meta( $post_id );
			if( $post_meta ) {

				foreach ( $post_meta as $meta_key => $meta_values ) {

					if( '_wp_old_slug' == $meta_key ) {
						continue;
					}

					foreach ( $meta_values as $meta_value ) {
						add_post_meta( $new_post_id, $meta_key, $meta_value );
					}
				}
			}

			
			/****************************
			*or we can redirect to all posts with a message
			*****************************/
			wp_safe_redirect(
				add_query_arg(
					array(
						'post_type' => ( 'post' !== get_post_type( $post ) ? get_post_type( $post ) : false ),
						'saved' => 'post_duplication_created'
					),
					admin_url( 'edit.php' )
				)
			);
			exit;

		} else {
			wp_die( 'Post creation failed, could not find original post.' );
		}

	}

	public function nic_duplication_admin_send_notice() {
		
		$screen = get_current_screen();

		if ( 'edit' !== $screen->base ) {
			return;
		}
	    
	    if ( isset( $_GET[ 'saved' ] ) && 'post_duplication_created' == $_GET[ 'saved' ] ) {

			 echo '<div class="notice notice-success is-dismissible"><p>'.esc_html('Post copy created.').'</p></div>';
			 
	    }
	}

}
