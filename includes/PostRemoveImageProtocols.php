<?php

require_once AMU_DIR_PATH . 'vendor/Settings.php';

class PostRemoveImageProtocols {

    /** The Settings Framework object */
    private $wpsf = null;

    public function __construct() {

        add_action( 'network_admin_menu', array( $this, 'plugin_admin_menu' ) );
    }

    /**
     * Registers the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @todo Change 'Page Settings' to the title of your plugin admin page
     * @todo Change 'update_core' to the required capability
     * @todo Change 'plugin-settings' to the slug of your plugin
     */
    public function plugin_admin_menu() {

        $this->wpsf = new Settings( $this->path . 'lib/plugin-settings.php' );

        add_submenu_page(
            'sites.php',
            'Search and Replace',
            'Search and Replace',
            'manage_network',
            'amu-search-replace',
            array( $this, 'plugin_admin_page' )
        );

    }

    /**
     * Renders the options page for this plugin.
     */
    public function plugin_admin_page() {

        ob_start();

        $fields = $this->wpsf;
        require_once AMU_DIR_PATH . 'views/admin-searchreplace.php';

        $settings_page = ob_get_contents();
        ob_clean();

        echo $settings_page;

    }

}
