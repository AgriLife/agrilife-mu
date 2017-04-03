<?php

class RequiredDOM {

    public function __construct() {

        add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );

        add_action( 'wp_head', array( $this, 'add_skip_nav_link') );

        if(AGL_THEME_NAME != 'texas4-h'){
            add_action( 'genesis_before', array( $this, 'add_required_head_content'), 2 );
        } else {
            add_action( 'genesis_footer', array( $this, 'add_required_head_content'), 2 );
        }

        add_action( 'genesis_setup', array( $this, 'remove_default_footer' ) );

        add_action( 'genesis_footer', array( $this, 'genesis_do_footer' ), 6 );

    }

    /**
     * Provides the styles for header and footer links
     *
     * @return HTML
     */
    function register_plugin_styles() {
        wp_register_style( 'aglinks-plugin', AGL_DIR_URL . 'css/aglinks.css' );
        wp_enqueue_style( 'aglinks-plugin' );
    }

    /**
     * Removes existing footer content
     *
     * @return void
     */
    function remove_default_footer() {
        remove_action( 'genesis_footer', 'genesis_do_footer' );
    }

    /**
     * Provides the skip links
     *
     * @return HTML
     */
    public function add_skip_nav_link()
    {
        ?>
        <div class="agl-skip-link">
        <a href="#content" title="Skip to content" tabindex="1">Skip to content</a>
        </div>
        <?php
    }

    /**
     * Provides the header links
     *
     * @return HTML
     */
    public function add_required_head_content()
    {
        ?><div class="agl-agency-bar <?php echo AGL_THEME_NAME; ?>">
            <div class="agency-wrap">
                <ul>
                    <li class="tfs-item"><a href="http://texasforestservice.tamu.edu/"><span>Texas A&amp;M Forest Service</span></a></li><li class="tvmdl-item"><a href="http://tvmdl.tamu.edu/"><span>Texas A&amp;M Veterinary Medical Diagnostics Laboratory</span></a></li><li class="ext-item"><a href="http://agrilifeextension.tamu.edu/"><span>Texas A&amp;M AgriLife Extension Service</span></a></li><li class="res-item"><a href="http://agriliferesearch.tamu.edu/"><span>Texas A&amp;M AgriLife Research</span></a></li><li class="college-item"><a href="http://aglifesciences.tamu.edu/"><span>Texas A&amp;M College of Agrculture and Life Sciences</span></a></li>
                </ul>
            </div>
        </div><?php
    }

    /**
     * Provides the footer links
     *
     * @return HTML
     */
    public function genesis_do_footer()
    {
        ?>
            <div class="wrap agl-footer-wrap <?php echo AGL_THEME_NAME; ?>">
                <div class="footer-container">
                    <ul class="req-links">
                        <li><a href="http://agrilife.org/required-links/compact/">Compact with Texans</a></li>
                        <li><a href="http://agrilife.org/required-links/privacy/">Privacy and Security</a></li>
                        <li><a href="http://itaccessibility.tamu.edu/" target="_blank">Accessibility Policy</a></li>
                        <li><a href="http://publishingext.dir.texas.gov/portal/internal/resources/DocumentLibrary/State%20Website%20Linking%20and%20Privacy%20Policy.pdf" target="_blank">State Link Policy</a></li>
                        <li><a href="http://www.tsl.state.tx.us/trail" target="_blank">Statewide Search</a></li>
                        <li><a href="http://veterans.tamu.edu/" target="_blank">Veterans Benefits</a></li>
                        <li><a href="http://fcs.tamu.edu/families/military_families/" target="_blank">Military Families</a></li>
                        <li><a href="https://secure.ethicspoint.com/domain/en/report_custom.asp?clientid=19681" target="_blank">Risk, Fraud &amp; Misconduct Hotline</a></li>
                        <li><a href="http://www.texashomelandsecurity.com/" target="_blank">Texas Homeland Security</a></li>
                        <li><a href="http://veterans.portal.texas.gov/">Texas Veteran's Portal</a></li>
                        <li><a href="http://agrilifeas.tamu.edu/hr/diversity/equal-opportunity-educational-programs/" target="_blank">Equal Opportunity</a></li>
                        <li class="last"><a href="http://agrilife.org/required-links/orpi/">Open Records/Public Information</a></li>
                    </ul>
                </div>
                <div class="footer-container-tamus">
                    <?php
                        function agl_footer_container_tamus(){
                            $content = '<a href="http://tamus.edu/" title="Texas A&amp;M University System"><img class="footer-tamus" src="' . AGL_DIR_URL . 'img/footer-tamus-maroon.png" alt="Texas A&amp;M University System Member"></a>';
                            $output = apply_filters( 'agl_footerlogo', $content );
                            if ( $output != '' ){
                                echo $output;
                            } else {
                                echo $content;
                            }
                        }
                        agl_footer_container_tamus();
                    ?>
                </div>
            </div>
        <?php
    }
}
