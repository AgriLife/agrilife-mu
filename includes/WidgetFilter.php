<?php

class WidgetFilter {

    public function __construct() {

        add_filter( 'widget_update_callback', array( $this, 'remove_protocol' ), 10, 4 );

    }

  /**
     * Remove the url protocol of images added to text widgets
     *
     * @since  1.1.0
     * @access public
     * @return string return custom output for inserted images in posts
     */
    public function remove_protocol( $instance, $new, $old, $obj ) {

        $protocol = defined( 'AMU_SECUREPROTOCOL' ) ? 'https://' : '//';

        if( 'text' === $obj->id_base && !empty( $instance['text'] ) ) {

            // Remove image protocol
            $instance['text'] = str_replace( "src=\"http://", "src=\"{$protocol}", $instance['text'] );

            $instance['text'] = str_replace( "src='http://", "src='{$protocol}", $instance['text'] );

        }

        return $instance;

    }

}
