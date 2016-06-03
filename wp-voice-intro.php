<?php
/*
Plugin Name: WP Voice Intro
Plugin URI:
Description: Voice, Intro, WP Voice Intro, page intro, audio, speech
Author: Mithu A Quayium
Version: 1.0
Author URI:
License: GPL2
TextDomain: wpvi
*/

define( 'WPVI_VERSION', '1.0' );
define( 'WPVI_FILE', __FILE__ );
define( 'WPVI_ROOT', dirname( __FILE__ ) );
define( 'WPVI_ROOT_URI', plugins_url( '', __FILE__ ) );
define( 'WPVI_ASSET_URI', WPVI_ROOT_URI . '/assets' );

class WPVI_Init {

    public function __construct() {
        $this->includes();
    }


    /**
     * Includes necessary files
     */
    public function includes() {

        include_once 'public-content.php';

        if( is_admin() ) {
            include_once 'admin-meta.php';
        }
    }

    /**
     * Initializes the WPVI_Init() class
     *
     * Checks for an existing WPVI_Init() instance
     * and if it doesn't find one, creates it.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function init() {

        static $instance = false;

        if ( ! $instance ) {
            $instance = new WPVI_Init();
        }

        return $instance;
    }
}

WPVI_Init::init();