<?php
/**
 * Plugin Name: The Events Calendar Extension: Make Event Titles Link to the Event Website URLs
 * Description: Make event titles link to URLs from their respective "Event Website" fields.
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1971
 * License: GPLv2 or later
 */
 
defined( 'WPINC' ) or die;

class Tribe__Extension__Make_Event_Titles_Link_to_the_Event_Website_URLs {

    /**
     * The semantic version number of this extension; should always match the plugin header.
     */
    const VERSION = '1.0.0';

    /**
     * Each plugin required by this extension
     *
     * @var array Plugins are listed in 'main class' => 'minimum version #' format
     */
    public $plugins_required = array(
        'Tribe__Events__Main' => '4.2'
    );

    /**
     * The constructor; delays initializing the extension until all other plugins are loaded.
     */
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
    }

    /**
     * Extension hooks and initialization; exits if the extension is not authorized by Tribe Common to run.
     */
    public function init() {

        // Exit early if our framework is saying this extension should not run.
        if ( ! function_exists( 'tribe_register_plugin' ) || ! tribe_register_plugin( __FILE__, __CLASS__, self::VERSION, $this->plugins_required ) ) {
            return;
        }

        add_filter( 'tribe_get_event_link', array( $this, 'make_event_titles_link_to_event_website' ), 100, 2 );
    }

    /**
     * Make event titles link to URLs from their respective "Event Website" fields.
     *
     * @param string $link
     * @param int $post_id
     * @return string
     */
    public function make_event_titles_link_to_event_website( $link, $post_id ) {
        
        $website_url = tribe_get_event_website_url( $post_id );
    
        if ( ! empty( $website_url ) ) {
            $link = $website_url;
        }
    
        return $link;
    }
}

new Tribe__Extension__Make_Event_Titles_Link_to_the_Event_Website_URLs();
