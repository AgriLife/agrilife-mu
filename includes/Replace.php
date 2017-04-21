<?php

/**
 * Class to compile the site data
 */
class Replace {

  /**
   * The array of site data
   * @var array
   */
  private $sites;

  /**
   * Constructor function. Sets the data compilation in motion
   */
  public function __construct() {

    $this->get_sites();
    $this->update_widgets();
    $this->output_commands();

  }

  /**
   * Sets the $sites property by pulling from the wp_blogs table.
   *
   * @since 1.0.0
   * @access private
   * @global $wpdb
   */
  private function get_sites() {

    global $wpdb;

    $sites = $wpdb->get_results(
      "SELECT blog_id,path FROM {$wpdb->blogs}
      WHERE site_id = '{$wpdb->siteid}'
      AND spam = '0'
      AND deleted ='0'
      AND archived = '0'
      order by blog_id", ARRAY_A
    );

    $this->sites = $sites;

  }

  /**
   * Update text widgets to remove image URL protocols
   *
   * @since 1.1.0
   * @access private
   * @uses AgriLife_Site
   */
  private function update_widgets() {

    global $wpdb;

    $sites = $this->sites;

    $protocol = '//';

    if( defined( 'AMU_SECUREPROTOCOL' ) ){
      $protocol = AMU_SECUREPROTOCOL ? 'https://' : 'http://';
    }

    foreach ( $sites as $site ) {

      // Update widget values
      // [todo] fix single site installs not being able to update their text widgets due to lack of admin page
      $widgetvalues = get_blog_option( intval( $site['blog_id'] ), 'widget_text', false );

      if( $widgetvalues !== false && !empty($widgetvalues) ){

        $needsupdate = false;

        foreach( $widgetvalues as $key=>$value ){

          if( is_array( $value ) && in_array( 'text', $value ) ){

            $text = $value['text'];
            $pattern = '/src=(\'|")http:\/\//';

            if( preg_match( $pattern, $text ) == 1 && $protocol != 'http://' ){

              $needsupdate = true;

              $text = preg_replace( $pattern, "src=$1{$protocol}", $text );

              $widgetvalues[$key]['text'] = $text;

            }

          }

        }

        if( $needsupdate )
          update_blog_option( $site['blog_id'], 'widget_text', $widgetvalues );

      }

    }

  }

  /**
   * Output SQL commands that will secure the network's database entries
   *
   * @since 1.1.4
   * @access private
   * @uses AgriLife_Site
   */
  private function output_commands() {

    $sites = $this->sites;

    $sql_commands = '';

    foreach ( $sites as $site ) {

      // Build SQL commands to update siteurl and home rows in wp_options
      $sql_commands .= str_replace('blogid', $site['blog_id'], "UPDATE `wp_blogid_options`
SET `option_value` = ( Replace (option_value, 'http://', 'https://') )
WHERE `wp_blogid_options`.`option_name` = 'siteurl'
OR `wp_blogid_options`.`option_name` = 'home';
");

    }

    echo $sql_commands;

  }

}
