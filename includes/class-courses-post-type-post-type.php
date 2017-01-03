<?php
/**
 * Courses Post Type
 *
 * @package   Courses_Post_Type
 * @author   Tuan Anh Le
 * @author   Theme Star
 * @license   GPL-2.0+
 * @link     https://themestar.co.uk/courses-post-type/
 * @copyright 2016 Tuan Anh Le,Theme Star
 */

/**
 * Courses post type.
 *
 * @package Courses_Post_Type
 * @author Tuan Anh Le
 * @author Theme Star
 */
class Courses_Post_Type_Post_Type extends Gamajo_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'Courses';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                  => __( 'Courses', 'Courses-post-type' ),
			'singular_name'         => __( 'Courses Item', 'Courses-post-type' ),
			'menu_name'             => _x( 'Courses', 'admin menu', 'Courses-post-type' ),
			'name_admin_bar'        => _x( 'Courses Item', 'add new on admin bar', 'Courses-post-type' ),
			'add_new'               => __( 'Add New Item', 'Courses-post-type' ),
			'add_new_item'          => __( 'Add New Courses Item', 'Courses-post-type' ),
			'new_item'              => __( 'Add New Courses Item', 'Courses-post-type' ),
			'edit_item'             => __( 'Edit Courses Item', 'Courses-post-type' ),
			'view_item'             => __( 'View Item', 'Courses-post-type' ),
			'all_items'             => __( 'All Courses Items', 'Courses-post-type' ),
			'search_items'          => __( 'Search Courses', 'Courses-post-type' ),
			'parent_item_colon'     => __( 'Parent Courses Item:', 'Courses-post-type' ),
			'not_found'             => __( 'No Courses items found', 'Courses-post-type' ),
			'not_found_in_trash'    => __( 'No Courses items found in trash', 'Courses-post-type' ),
			'filter_items_list'     => __( 'Filter Courses items list', 'Courses-post-type' ),
			'items_list_navigation' => __( 'Courses items list navigation', 'Courses-post-type' ),
			'items_list'            => __( 'Courses items list', 'Courses-post-type' ),
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
			'rewrite'         => array( 'slug' => 'Courses', ), // Permalinks format
			'menu_position'   => 5,
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-format-video' : false ,
			'has_archive'     => true,
		);

		return apply_filters( 'Coursesposttype_args', $args );
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
			1  => __( 'Courses item updated.', 'Courses-post-type' ),
			2  => __( 'Custom field updated.', 'Courses-post-type' ),
			3  => __( 'Custom field deleted.', 'Courses-post-type' ),
			4  => __( 'Courses item updated.', 'Courses-post-type' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Courses item restored to revision from %s', 'Courses-post-type' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Courses item published.', 'Courses-post-type' ),
			7  => __( 'Courses item saved.', 'Courses-post-type' ),
			8  => __( 'Courses item submitted.', 'Courses-post-type' ),
			9  => sprintf(
				__( 'Courses item scheduled for: <strong>%1$s</strong>.', 'Courses-post-type' ),
				/* translators: Publish box date format, see http://php.net/date */
				date_i18n( __( 'M j, Y @ G:i', 'Courses-post-type' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Courses item draft updated.', 'Courses-post-type' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View Courses item', 'Courses-post-type' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview Courses item', 'Courses-post-type' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}