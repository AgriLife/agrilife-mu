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
    $this->print_query();

  }

  /**
   * Sets the $sites property by pulling from the wp_blogs table.
   *
   * @since 0.1
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
   * Updates site option in the database for easy access throughout WordPress
   *
   * @since 0.1
   * @uses AgriLife_Site
   */
  public function print_query() {

    global $wpdb;

    $sites = $this->sites;

    foreach ( $sites as $site ) {
    	if($site['blog_id'] != 1){
	    	echo "
UPDATE wp_" . $site['blog_id'] . "_posts
SET post_content = ( Replace ( post_content, 'src=\"http:', 'src=\"' ) )
WHERE  Instr(post_content, 'jpeg') > 0
  OR Instr(post_content, 'jpg') > 0
  OR Instr(post_content, 'gif') > 0
  OR Instr(post_content, 'png') > 0;";
	    }

    }

  }

}
