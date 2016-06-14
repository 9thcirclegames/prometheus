<?php

/**
 * wp-less
 * https://github.com/oncletom
 */
if( !class_exists("WPLessPlugin")){
  require_once( dirname(__FILE__) . '/wp-less/bootstrap-for-theme.php' );
}
$less = WPLessPlugin::getInstance();
$less->dispatch();

/**
 * retina.js
 * https://github.com/scottjehl/Respond
 */
function prometheus_retina() {
    wp_enqueue_script( 'retina-js', get_stylesheet_directory_uri() . '/prometheus/js/retina.min.js', array(), '1.3.0', 'true' );
}

/**************************************
 * CUSTOM DIVI MODULES - Experimental *
 **************************************/
function doCustomModules(){
 if(class_exists("ET_Builder_Module")){
    require_once( dirname(__FILE__) . '/classes/divi-custom-modules.php' );
 }
}

function prepareCustomModule(){
 global $pagenow;

 $is_admin = is_admin();
 $action_hook = $is_admin ? 'wp_loaded' : 'wp';
 $required_admin_pages = array( 'edit.php', 'post.php', 'post-new.php', 'admin.php', 'customize.php', 'edit-tags.php', 'admin-ajax.php', 'export.php' ); // list of admin pages where we need to load builder files
 $specific_filter_pages = array( 'edit.php', 'admin.php', 'edit-tags.php' ); // list of admin pages where we need more specific filtering
 $is_edit_library_page = 'edit.php' === $pagenow && isset( $_GET['post_type'] ) && 'et_pb_layout' === $_GET['post_type'];
    $is_role_editor_page = 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'et_divi_role_editor' === $_GET['page'];
    $is_import_page = 'admin.php' === $pagenow && isset( $_GET['import'] ) && 'wordpress' === $_GET['import']; // Page Builder files should be loaded on import page as well to register the et_pb_layout post type properly
    $is_edit_layout_category_page = 'edit-tags.php' === $pagenow && isset( $_GET['taxonomy'] ) && 'layout_category' === $_GET['taxonomy'];

 if ( ! $is_admin || ( $is_admin && in_array( $pagenow, $required_admin_pages ) && ( ! in_array( $pagenow, $specific_filter_pages ) || $is_edit_library_page || $is_role_editor_page || $is_edit_layout_category_page || $is_import_page ) ) ) {
    add_action($action_hook, 'doCustomModules', 9789);
 }
}
prepareCustomModule();

/*************
 * WIDGETS   *
 *************/
	
/**
 * 9th Circle Games Logo Widget
 */
class NinthCircleGames_Logo_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'NinthCircleGames_Logo_Widget', // Base ID
			__('9th Circle Games Logo', 'ninthcirclegames_text_domain'), // Name
			array( 'description' => __( 'This widget shows the 9th Circle Games logo in a suitable div', 'ninthcirclegames_text_domain' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
  
    // check for template in active theme
		$template = locate_template(array('ninthcirclegames_logo_template.php'));
		
		// if none found use the default template
		if ( $template == '' ) $template = 'ninthcirclegames_logo_template.php';
				
		include ( $template );
	}
    
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$logo_url = ( isset( $instance['logo_url'] ) ) ? $instance['logo_url'] : 'https://static.gabrielebaldassarre.com/assets/sites/4/2016/03/footer-logo.png';
    $link_url = ( isset( $instance['link_url'] ) ) ? $instance['link_url'] : 'https://9thcircle.it';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'logo_url' ); ?>"><?php _e( 'Logo URL:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'logo_url' ); ?>" name="<?php echo $this->get_field_name( 'logo_url' ); ?>" type="text" value="<?php echo esc_attr( $logo_url ); ?>">
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'link_url' ); ?>"><?php _e( 'Link URL:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['logo_url'] = ( ! empty( $new_instance['logo_url'] ) ) ? strip_tags( $new_instance['logo_url'] ) : '';
    $instance['link_url'] = ( ! empty( $new_instance['link_url'] ) ) ? strip_tags( $new_instance['link_url'] ) : '';
		return $instance;
	}
} // class NithCircleGames_Logo_Widget
 add_action( 'widgets_init', function(){
     register_widget( 'NinthCircleGames_Logo_Widget' );
});

/**
 * 9th Circle Games Brand Widget
 */
class NinthCircleGames_Brand_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'NinthCircleGames_Brand_Widget', // Base ID
			__('9th Circle Games Corporate Data', 'ninthcirclegames_text_domain'), // Name
			array( 'description' => __( 'This widget shows the 9th Circle Games corporate details and social channels', 'ninthcirclegames_text_domain' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
  
    // check for template in active theme
		$template = locate_template(array('ninthcirclegames_brand_template.php'));
		
		// if none found use the default template
		if ( $template == '' ) $template = 'ninthcirclegames_brand_template.php';
				
		include ( $template );
	}
    
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$eden_url = ( isset( $instance['eden_url'] ) ) ? $instance['eden_url'] : 'https://eden.9thcircle.it';
    $woc_url = ( isset( $instance['woc_url'] ) ) ? $instance['woc_url'] : 'https://woc.9thcircle.it';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'eden_url' ); ?>"><?php _e( 'Eden URL:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'eden_url' ); ?>" name="<?php echo $this->get_field_name( 'eden_url' ); ?>" type="text" value="<?php echo esc_attr( $eden_url ); ?>">
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'woc_url' ); ?>"><?php _e( 'Wisdom of Cthulhu URL:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'woc_url' ); ?>" name="<?php echo $this->get_field_name( 'woc_url' ); ?>" type="text" value="<?php echo esc_attr( $woc_url ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['woc_url'] = ( ! empty( $new_instance['woc_url'] ) ) ? strip_tags( $new_instance['woc_url'] ) : '';
    $instance['eden_url'] = ( ! empty( $new_instance['eden_url'] ) ) ? strip_tags( $new_instance['eden_url'] ) : '';
		return $instance;
	}
} // class NithCircleGames_Brand_Widget
 add_action( 'widgets_init', function(){
     register_widget( 'NinthCircleGames_Brand_Widget' );
});