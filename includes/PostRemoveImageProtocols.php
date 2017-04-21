<?php

require_once AMU_DIR_PATH . 'vendor/Settings.php';

class PostRemoveImageProtocols {

    /** The Settings Framework object */
    private $wpsf = null;

    public function __construct() {

        add_action( 'network_admin_menu', array( $this, 'plugin_network_admin_menu' ) );

    }

    /**
     * Registers the network administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since 1.0.0
     * @access public
     */
    public function plugin_network_admin_menu() {

        $this->wpsf = new Settings( $this->path . 'lib/plugin-settings.php' );

        add_submenu_page(
            'sites.php',
            'Secure Content',
            'Secure Content',
            'manage_network',
            'amu-secure-content',
            array( $this, 'plugin_admin_page' )
        );

    }

    /**
     * Renders the options page for this plugin.
     *
     * @since 1.0.0
     * @access public
     */
    public function plugin_admin_page() {

        ob_start();

        $fields = $this->wpsf;
        require_once AMU_DIR_PATH . 'views/admin-securecontent.php';

        $settings_page = ob_get_contents();
        ob_clean();

        echo $settings_page;

    }

}
