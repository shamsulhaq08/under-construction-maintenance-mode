<?php

/**
 * UCMM WPBrigade Settings
 *
 * @since 1.0.0
 */
if ( !class_exists( 'UCMM_WPBrigade_Setting' ) ) :

class UCMM_WPBrigade_Setting {

    private $settings_api;

    function __construct() {

      include_once( UCMM_WPBRIGADE_ROOT_PATH . '/classes/ucmm-wpbrigade-settings-api.php' );
      $this->settings_api = new UCMM_WPBrigade_Settings_API;

      add_action( 'admin_init', array( $this, 'ucmm_wpbrigade_setting_init' ) );
      add_action( 'admin_menu', array( $this, 'ucmm_wpbrigade_setting_menu' ) );
      add_action( 'wp_ajax_ucmm_help', array( $this, 'download_help' ) );
    }

    function ucmm_wpbrigade_setting_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_ucmm_settings_sections() );
        $this->settings_api->set_fields( $this->get_ucmm_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function ucmm_wpbrigade_setting_menu() {

      add_menu_page( __( 'Under Construction', 'ucmm-wpbrigade' ), __( 'Under Construction', 'ucmm-wpbrigade' ), 'manage_options', "ucmm_settings", '__return_null', '', 50 );

      add_submenu_page( 'ucmm_settings', __( 'Settings', 'ucmm-wpbrigade' ), __( 'Settings', 'ucmm-wpbrigade' ), 'manage_options', "ucmm_settings", array( $this, 'plugin_page' ) );

      add_submenu_page( 'ucmm_settings', __( 'Customizer', 'ucmm-wpbrigade' ), __( 'Customizer', 'ucmm-wpbrigade' ), 'manage_options', "under-construction-maintenance-mode", '__return_null' );
      add_submenu_page( 'ucmm_settings', __( 'Help', 'ucmm-wpbrigade' ), __( 'Help', 'ucmm-wpbrigade' ), 'manage_options', 'ucmm-help', array( $this, 'ucmm_help_page' ) );

    }

    function get_ucmm_settings_sections() {
        $sections = array(
            array(
                'id'    => 'ucmm_wpbrigade_setting',
                'title' => __( 'Settings', 'ucmm-wpbrigade' ),
                'desc'  => sprintf( __( 'Under Construction page is customizable through %1$sWordPress Customizer%2$s.', 'ucmm-wpbrigade' ), '<a href="' . admin_url( 'admin.php?page=under-construction-maintenance-mode' ) . '">', '</a>' ),
            ),
            // array(
            //     'id'    => 'ucmm_wpbrigade_mc_lists',
            //     'title' => __( 'MailChimp', 'ucmm-wpbrigade' ),
            //     'desc'  => __( 'MailChimp Lists', 'ucmm-wpbrigade' ),
            // ),
            // array(
            //     'id'    => 'ucmm_wpbrigade_seo',
            //     'title' => __( 'SEO Configuration', 'ucmm-wpbrigade' ),
            //     'desc'  => __( 'SEO Configuration', 'ucmm-wpbrigade' ),
            // ),
            // array(
            //     'id'    => 'ucmm_wpbrigade_premium',
            //     'title' => __( 'Try Primum Veriosn', 'ucmm-wpbrigade' )
            // )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_ucmm_settings_fields() {

      global $wp_roles;
			$ucmm_wpbrigade_roles = array();
			$ucmm_staus_string = sprintf( __( 'Check the field to activate the maintenance mode.' , 'ucmm-wpbrigade' ) );
			$ucmm_customizer_settings = get_option( 'ucmm_wpbrigade_customization' );
			$ucmm_customizer_enable = isset( $ucmm_customizer_settings['ucmm_schedule_show_end_time'] ) ? $ucmm_customizer_settings['ucmm_schedule_show_end_time'] : false;
				if( $ucmm_customizer_enable ) {
					$ucmm_staus_string .= sprintf( __( '%3$s%3$s Note: Scheduling maintenance from customizer is the primary setting. This option will not work if you have enabled the scheduled maintenance mode. %3$s If you want to use the default maintenance (this option), please deactivate the maintenance schedule from %1$s customizer%2$s and set this option again.', 'ucmm-wpbrigade' ), '<a href="' . admin_url( 'admin.php?page=under-construction-maintenance-mode' ) . '">', '</a>','<br>' , 'ucmm-wpbrigade' );
				}

      foreach( $wp_roles->roles as $role => $val ) {

        $ucmm_wpbrigade_roles['ucmm-wpbrigade_role_'.$role] = $val['name'];
      }
      $settings_fields = array(
        'ucmm_wpbrigade_setting' => array(
            array(
                'name'  => 'ucmm-status',
                'label' => __( 'Activate:', 'ucmm-wpbrigade' ),
                'desc'  => $ucmm_staus_string,
                'type'  => 'checkbox',
						),
            array(
              'name'                => 'ucmm-enable',
              'label'               => __( 'Disable Mode For:', 'ucmm-wpbrigade' ),
              'desc'                => __( 'Choose the roles to disable under construction mode for ', 'ucmm-wpbrigade' ),
              'type'                => 'multicheck',
              // 'default'             => array( 'ucmm-wpbrigade_role_administrator' => 'Administrator'),
              'options'             => $ucmm_wpbrigade_roles
            ),
          ),
        // 'ucmm_wpbrigade_seo' => array(
        //   array(
        //       'name'              => 'ucmm-seo-locale',
        //       'label'             => __( 'SEO Locale', 'ucmm-wpbrigade' ),
        //       'desc'              => __( 'Text input description', 'ucmm-wpbrigade' ),
        //       'placeholder'       => get_bloginfo('language'),
        //       'type'              => 'text',
        //       'sanitize_callback' => 'sanitize_text_field'
        //   ),
        //   array(
        //       'name'              => 'ucmm-seo-type',
        //       'label'             => __( 'SEO Type', 'ucmm-wpbrigade' ),
        //       'desc'              => __( 'Text input description', 'ucmm-wpbrigade' ),
        //       'placeholder'       => __( 'website', 'ucmm-wpbrigade' ),
        //       'type'              => 'text',
        //       'sanitize_callback' => 'sanitize_text_field'
        //   ),
        //   array(
        //       'name'              => 'ucmm-seo-title',
        //       'label'             => __( 'SEO Title', 'ucmm-wpbrigade' ),
        //       'desc'              => __( 'Text input description', 'ucmm-wpbrigade' ),
        //       'placeholder'       => get_bloginfo('name'),
        //       'type'              => 'text',
        //       'sanitize_callback' => 'sanitize_text_field'
        //   ),
        //   array(
        //       'name'              => 'ucmm-seo-desc',
        //       'label'             => __( 'SEO Description', 'ucmm-wpbrigade' ),
        //       'desc'              => __( 'Text input description', 'ucmm-wpbrigade' ),
        //       'placeholder'       => __( 'Text Input placeholder', 'ucmm-wpbrigade' ),
        //       'type'              => 'text',
        //       'sanitize_callback' => 'sanitize_text_field'
        //   ),
        //   array(
        //       'name'              => 'ucmm-seo-url',
        //       'label'             => __( 'SEO URL', 'ucmm-wpbrigade' ),
        //       'desc'              => __( 'Text input description', 'ucmm-wpbrigade' ),
        //       'placeholder'       => get_bloginfo('url'),
        //       'type'              => 'text',
        //       'sanitize_callback' => 'sanitize_text_field'
        //   ),
        //   array(
        //       'name'              => 'ucmm-seo-site-name',
        //       'label'             => __( 'SEO Site Name', 'ucmm-wpbrigade' ),
        //       'desc'              => __( 'Text input description', 'ucmm-wpbrigade' ),
        //       'placeholder'       => get_bloginfo('name'),
        //       'type'              => 'text',
        //       'sanitize_callback' => 'sanitize_text_field'
        //   ),
        //   array(
        //       'name'              => 'ucmm-seo-keyword',
        //       'label'             => __( 'SEO Keyword', 'ucmm-wpbrigade' ),
        //       'desc'              => __( 'Text input description', 'ucmm-wpbrigade' ),
        //       'placeholder'       => __( 'Text Input placeholder', 'ucmm-wpbrigade' ),
        //       'type'              => 'text',
        //       'sanitize_callback' => 'sanitize_text_field'
        //   ),
        // ),
        // 'ucmm_wpbrigade_mc_lists' => array(
        //   array(
        //     'name'  => 'ucmm-mc-api-key',
        //     'label' => __( 'API Key:', 'ucmm-wpbrigade' ),
        //     'desc'  => __( 'Mail Chimp Key.', 'ucmm-wpbrigade' ),
        //     'type'  => 'text'
        //   ),
        //   array(
        //     'name'    => 'selectbox',
        //     'label'   => __( 'Lists', 'ucmm-wpbrigade' ),
        //     'desc'    => __( 'Select the List', 'ucmm-wpbrigade' ),
        //     'type'    => 'select',
        //     'default' => 'no',
        //     'options' => array(
        //         // 'yes' => '55555555555555555',
        //         // 'no'  => '66666666666666666'
        //     )
        //   ),
        // ),
      );

      return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap ucmm-wpbrigade">';
        echo '<h2>' . __( 'Under Construction: Settings', 'ucmm-wpbrigade' ) . '</h2><br />';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }
    /**
     * get info
     * @since 1.0.5
     */
    public function ucmm_help_page() {

		 include UCMM_WPBRIGADE_DIR_PATH . 'classes/ucmm-logs.php';

			$html = '<div class="ucmm-wpbrigade-help-page">';
			$html .= '<h2>Help & Troubleshooting</h2>';
			$html .= sprintf( __( 'Free support is available on the %1$s plugin support forums%2$s.', 'ucmm-wpbrigade' ), '<a href="https://wordpress.org/support/plugin/under-construction-maintenance-mode" target="_blank">', '</a>' );
			$html .="<br /><br />";
			$html .= 'Found a bug or have a feature request? Please submit an issue <a href="https://wpbrigade.com/contact/" target="_blank">here</a>!';
			$html .= '<pre><textarea rows="25" cols="75" readonly="readonly">';
			$html .= Uccm_Logs_Info::get_sysinfo();
			$html .= '</textarea></pre>';
			$html .= '<input type="button" class="button ucmm-wpbrigade-log-file" value="' . __( 'Download Log File', 'ucmm-wpbrigade' ) . '"/>';
			$html .= '<span class="ucmm-log-file-sniper"><img src="'. admin_url( 'images/wpspin_light.gif' ) .'" /></span>';
			$html .= '<span class="ucmm-log-file-text">Under Construction Log File Downloaded Successfully!</span>';
			$html .= '</div>';
			echo $html;
    }
    /**
     * call back function of download help ajax
     * @since 1.0.5
     */
     public function download_help(){

       check_ajax_referer( 'ucmm_help_nonce', 'help_nonce' );

       if ( ! current_user_can( 'manage_options' ) ) {
         wp_die( 'error' );
       }

       include UCMM_WPBRIGADE_DIR_PATH . 'classes/ucmm-logs.php';
       echo Uccm_Logs_Info::get_sysinfo();
       wp_die();
     }
}



endif;
