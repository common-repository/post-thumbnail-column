<?php
/*
Plugin Name: Post Thumbnail Column
Plugin URI:  http://wordpress.org/plugins/post-thumbnail-column
Description: Adds a new column to posts list for featured images.
Version:     1.0
Author:      silver530
Author URI:  http://www.pixelwars.org
License:     GPLv2 or later
Text Domain: post_thumbnail_column
Domain Path: /langs/
*/


/*
Copyright (c) 2014, silver530.

This program is free software; you can redistribute it and/or 
modify it under the terms of the GNU General Public License 
as published by the Free Software Foundation; either version 2 
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
GNU General Public License for more details.

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


/* ============================================================================================================================================= */

	function post_thumbnail_column_load_textdomain()
	{
		load_plugin_textdomain( 'post_thumbnail_column', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' ); 
	}
	
	add_action( 'plugins_loaded', 'post_thumbnail_column_load_textdomain' );

/* ============================================================================================================================================= */

	if ( ! current_theme_supports( 'post-thumbnails' ) )
	{
		add_theme_support( 'post-thumbnails', array( 'post' ) );
	}

/* ============================================================================================================================================= */

	function post_thumbnail_column_add_new_post_column( $columns )
	{
		return array_merge( $columns, array( 'post_thumbnail_column' => __( 'Featured Image', 'post_thumbnail_column' ) ) );
	}
	
	add_filter( 'manage_posts_columns' , 'post_thumbnail_column_add_new_post_column' );
	
	
	function post_thumbnail_column_display_new_post_column( $column, $post_id )
	{
		if ( $column == 'post_thumbnail_column' )
		{
			if ( has_post_thumbnail() )
			{
				the_post_thumbnail( 'thumbnail' );
			}
		}
	}
	
	add_action( 'manage_posts_custom_column' , 'post_thumbnail_column_display_new_post_column', 10, 2 );

/* ============================================================================================================================================= */
	
?>