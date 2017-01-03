<?php
/**
 * Service Post Type
 *
 * @package   service_Post_Type
 * @author    Tuan Anh Le
 * @author    Tuan Anh Le
 * @license   GPL-2.0+
 * @link      http://themestar/service-post-type/
 * @copyright 2016 Tuan Anh Le
 */

/**
 * service post type.
 *
 * @package service_Post_Type
 * @author  Tuan Anh Le
 * @author  Tuan Anh Le
   @author  Tuan Anh Le
 */
class service_Post_Type_Post_Type extends Gamajo_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'service';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                  => __( 'Service', 'service-post-type' ),
			'singular_name'         => __( 'service Item', 'service-post-type' ),
			'menu_name'             => _x( 'Service', 'admin menu', 'service-post-type' ),
			'name_admin_bar'        => _x( 'Service Item', 'add new on admin bar', 'service-post-type' ),
			'add_new'               => __( 'Add New Item', 'service-post-type' ),
			'add_new_item'          => __( 'Add New service Item', 'service-post-type' ),
			'new_item'              => __( 'Add New service Item', 'service-post-type' ),
			'edit_item'             => __( 'Edit service Item', 'service-post-type' ),
			'view_item'             => __( 'View Item', 'service-post-type' ),
			'all_items'             => __( 'All service Items', 'service-post-type' ),
			'search_items'          => __( 'Search service', 'service-post-type' ),
			'parent_item_colon'     => __( 'Parent service Item:', 'service-post-type' ),
			'not_found'             => __( 'No service items found', 'service-post-type' ),
			'not_found_in_trash'    => __( 'No service items found in trash', 'service-post-type' ),
			'filter_items_list'     => __( 'Filter service items list', 'service-post-type' ),
			'items_list_navigation' => __( 'Service items list navigation', 'service-post-type' ),
			'items_list'            => __( 'Service items list', 'service-post-type' ),
		);

		$supports = array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'comments',
			'author',
			'custom-fields',
			'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'service', ), // Permalinks format
			'menu_position'   => 5,
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-admin-site' : false ,
			'has_archive'     => true,
		);

		return apply_filters( 'serviceposttype_args', $args );
	}

	/**
	 * Return post type updated messages.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type updated messages.
	 */
	public function messages() {
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'service item updated.', 'service-post-type' ),
			2  => __( 'Custom field updated.', 'service-post-type' ),
			3  => __( 'Custom field deleted.', 'service-post-type' ),
			4  => __( 'service item updated.', 'service-post-type' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'service item restored to revision from %s', 'service-post-type' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'service item published.', 'service-post-type' ),
			7  => __( 'service item saved.', 'service-post-type' ),
			8  => __( 'service item submitted.', 'service-post-type' ),
			9  => sprintf(
				__( 'service item scheduled for: <strong>%1$s</strong>.', 'service-post-type' ),
				/* translators: Publish box date format, see http://php.net/date */
				date_i18n( __( 'M j, Y @ G:i', 'service-post-type' ), strtotime( $post->post_date ) )
			),
			10 => __( 'service item draft updated.', 'service-post-type' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View service item', 'service-post-type' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview service item', 'service-post-type' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}