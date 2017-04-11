<?php

class PostFilter {

    public function __construct() {

        add_filter( 'image_send_to_editor', array( $this, 'remove_protocol' ), 10, 9 );

        add_filter( 'the_content', array( $this, 'correct_srcset_attributes' ), 10, 10 );
    }

  /**
     * Remove the url protocol of images attched to posts
     *
     * @since  1.0.0
     * @access public
     * @return string return custom output for inserted images in posts
     */
  public function remove_protocol($html, $id, $caption, $title, $align, $url) {

    $protocol = '//';

    if( defined( 'AMU_SECUREPROTOCOL' ) ){
        $protocol = AMU_SECUREPROTOCOL ? 'https://' : 'http://';
    }

    $newhtml = str_replace( 'http://', $protocol, $html );

    return $newhtml;

  }

  /**
     * Remove the url protocol of image srcset attributes attched to pages and posts
     *
     * @since  1.1.2
     * @access public
     * @return string return updated post content
     */
  public function correct_srcset_attributes( $content ) {

    $protocol = '//';

    if( defined( 'AMU_SECUREPROTOCOL' ) ){
        $protocol = AMU_SECUREPROTOCOL ? 'https://' : 'http://';
    }

    preg_match_all('/srcset="([^"]+)"/i', $content, $matches);

    foreach( $matches[1] as $key=>$srcset ){

        $newsrcset = str_replace( "http://", $protocol, $srcset );

        $content = str_replace( $matches[0][$key], "srcset=\"{$newsrcset}\"", $content );

    }

    return $content;

  }

}
