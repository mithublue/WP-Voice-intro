<?php

class wpvi_admin_meta {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_custom_meta_box' ), 10, 2 );
        add_action( 'save_post',  array( $this, 'save_wpvi_data' ) );
    }

    /**
     * Meta box
     */
    public function add_custom_meta_box( $post_type , $post ) {
        add_meta_box(
            'wpvi-meta-box',
            __( 'WP Voice Intro' ),
            array( $this, 'render_voice_intro_meta_box' ),
            $post_type,
            'normal',
            'default'
        );
    }

    public function render_voice_intro_meta_box( $post ) {
        $nonce = wp_create_nonce( 'my-nonce' );
        $wpvi_meta = get_post_meta( $post->ID, 'wpvi_meta' , true );
        ?>
        <table>
            <tr>
                <td><input type="hidden" name="wpvi_meta[enabled]" value="false"/>
                    <input type="checkbox" name="wpvi_meta[enabled]" value="true"
                        <?php echo isset( $wpvi_meta['enabled'] ) && $wpvi_meta['enabled'] == 'true' ? 'checked' : ''; ?> />
                    <?php _e( 'Enable Voice Intro For this Page.', 'wpvi' ); ?>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td><?php _e( 'Text to speak', 'wpvi' ); ?></td>
                <td>
                    <textarea name="wpvi_meta[voice_text]" id="" cols="30" rows="3"><?php echo isset( $wpvi_meta['voice_text'] ) ? $wpvi_meta['voice_text'] : ''; ?></textarea>
                </td>
            </tr>
        </table>
    <?php
    }

    public function save_wpvi_data( $post_id ) {
        update_post_meta( $post_id, 'wpvi_meta' , $_POST['wpvi_meta'] );
    }


    public static function init() {
        new wpvi_admin_meta();
    }
}

wpvi_admin_meta::init();