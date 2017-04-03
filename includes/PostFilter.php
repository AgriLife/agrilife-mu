<?php

class PostFilter {

    public function __construct() {

        add_filter( 'image_send_to_editor', array( $this, 'remove_protocol' ), 10, 9 );
    }

  /**
     * Remove the url protocol of images attched to posts
     *
     * @since  1.0.0
     * @access public
     * @return string return custom output for inserted images in posts
     */
  public function remove_protocol($html, $id, $caption, $title, $align, $url) {
    // remove protocol
    $newhtml = str_replace(array('http://','https://'), '//', $html);
    return $newhtml;
  }
}
