<?php

class wpvi_public{

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts_styles' ) );
    }

    public static function init() {
        new wpvi_public();
    }

    /**
     * Inlcude styles and css to the frondend
     */
    function wp_enqueue_scripts_styles() {

        if( is_page() || is_single() ) {
            global $post;

            $wpvi_meta = get_post_meta( $post->ID, 'wpvi_meta', true );
            if( !empty( $wpvi_meta ) && isset( $wpvi_meta['enabled'] ) && $wpvi_meta['enabled'] == 'true' ) {
                wp_enqueue_script( 'wpvi-core', WPVI_ASSET_URI.'/js/asd.js', array( 'jquery' ) );
                wp_enqueue_script( 'wpvi-js', WPVI_ASSET_URI.'/js/script.js', array( 'jquery', 'wpvi-core' ) );
                wp_localize_script( 'wpvi-js', 'wpvi_obj',  array(
                    'wpvi_meta' => $wpvi_meta,
                    'post_title' => $post->post_title
                ) );
            }

        }

    }
}

wpvi_public::init();