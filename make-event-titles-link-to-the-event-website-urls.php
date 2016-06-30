<?php
/**
 * Plugin Name: The Events Calendar — Make Event Titles Link to the Event Website URLs
 * Description: Make event titles link to URLs from their respective "Event Website" fields.
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1x
 * License: GPLv2 or later
 */
 
defined( 'WPINC' ) or die;

/**
 * Make event titles link to URLs from their respective "Event Website" fields.
 *
 * @param string $link
 * @param int $post_id
 * @return string
 */
function tribe_make_event_titles_link_to_event_website( $link, $post_id ) {
	
	$website_url = tribe_get_event_website_url( $post_id );

	if ( ! empty( $website_url ) ) {
		$link = $website_url;
	}

	return $link;
}

add_filter( 'tribe_get_event_link', 'tribe_make_event_titles_link_to_event_website', 100, 2 );
