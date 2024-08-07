<?php

/**
 * Log file to know more about users website environment.
 * helps in debugging and providing support.
 *
 * @package    Under Construction Maintenance Mode
 * @since      1.0.5
 */

class Uccm_Logs_Info {

	/**
	 * Returns the plugin & system information.
	 * @access public
	 * @return string
	 */
	public static function get_sysinfo() {

		global $wpdb;
	
        $ucmm_setting_options = get_option( 'ucmm_wpbrigade_setting' );
        $ucmm_customization_option    = get_option( 'ucmm_wpbrigade_customization' );
    
		$active_theme    = wp_get_theme();

		$html = '### Begin System Info ###' . "\n\n";

		// Basic site info
		$html .= '-- WordPress Configuration --' . "\n\n";
		$html .= 'Site URL:                 ' . site_url() . "\n";
		$html .= 'Home URL:                 ' . home_url() . "\n";
		$html .= 'Multisite:                ' . ( is_multisite() ? 'Yes' : 'No' ) . "\n";
		$html .= 'Version:                  ' . get_bloginfo( 'version' ) . "\n";
		$html .= 'Language:                 ' . get_locale() . "\n";
		$html .= 'Table Prefix:             ' . 'Length: ' . strlen( $wpdb->prefix ) . "\n";
		$html .= 'WP_DEBUG:                 ' . ( defined( 'WP_DEBUG' ) ? WP_DEBUG ? 'Enabled' : 'Disabled' : 'Not set' ) . "\n";
		$html .= 'Memory Limit:             ' . WP_MEMORY_LIMIT . "\n";

		// Plugin Configuration
		$html .= "\n" . '-- Under Construction & Maintenance Mode --' . "\n\n";
		$html .= 'Plugin Version:           ' . UCMM_WPBRIGADE_VERSION . "\n";

		$html .= 'Plugin Settings:          ' . print_r( $ucmm_setting_options, true ) . "\n";
    $html .= 'Customizer Settings       ' . print_r( $ucmm_customization_option, true ) . "\n";


		// Server Configuration 
		$html .= "\n" . '-- Server Configuration --' . "\n\n";
		$html .= 'Operating System:         ' . php_uname( 's' ) . "\n";
		$html .= 'PHP Version:              ' . PHP_VERSION . "\n";
		$html .= 'MySQL Version:            ' . $wpdb->db_version() . "\n";

		$html .= 'Server Software:          ' . $_SERVER['SERVER_SOFTWARE'] . "\n";

		// PHP configs... now we're getting to the important stuff
		$html .= "\n" . '-- PHP Configuration --' . "\n\n";
		$html .= 'Safe Mode:                ' . ( ini_get( 'safe_mode' ) ? 'Enabled' : 'Disabled' . "\n" );
		$html .= 'Memory Limit:             ' . ini_get( 'memory_limit' ) . "\n";
		$html .= 'Post Max Size:            ' . ini_get( 'post_max_size' ) . "\n";
		$html .= 'Upload Max Filesize:      ' . ini_get( 'upload_max_filesize' ) . "\n";
		$html .= 'Time Limit:               ' . ini_get( 'max_execution_time' ) . "\n";
		$html .= 'Max Input Vars:           ' . ini_get( 'max_input_vars' ) . "\n";
		$html .= 'Display Errors:           ' . ( ini_get( 'display_errors' ) ? 'On (' . ini_get( 'display_errors' ) . ')' : 'N/A' ) . "\n";

		// WordPress active theme
		$html .= "\n" . '-- WordPress Active Theme --' . "\n\n";
		$html .=  $active_theme->get( 'Name' ) . ' '. $active_theme->get( 'Version' ) . ' by `' . $active_theme->get( 'Author' ) . "`\n";

		// WordPress active plugins
		$html .= "\n" . '-- WordPress Active Plugins --' . "\n\n";
		$plugins = get_plugins();
		$active_plugins = get_option( 'active_plugins', array() );
		foreach( $plugins as $plugin_path => $plugin ) {
			if( !in_array( $plugin_path, $active_plugins ) )
				continue;
			$html .= $plugin['Name'] . ': ' . $plugin['Version'] . "\n";
		}

		// WordPress inactive plugins
		$html .= "\n" . '-- WordPress Inactive Plugins --' . "\n\n";
		foreach( $plugins as $plugin_path => $plugin ) {
			if( in_array( $plugin_path, $active_plugins ) )
				continue;
			$html .= $plugin['Name'] . ': ' . $plugin['Version'] . "\n";
		}

		if( is_multisite() ) {
			// WordPress Multisite active plugins
			$html .= "\n" . '-- Network Active Plugins --' . "\n\n";
			$plugins = wp_get_active_network_plugins();
			$active_plugins = get_site_option( 'active_sitewide_plugins', array() );
			foreach( $plugins as $plugin_path ) {
				$plugin_base = plugin_basename( $plugin_path );
				if( !array_key_exists( $plugin_base, $active_plugins ) )
					continue;
				$plugin  = get_plugin_data( $plugin_path );
				$html .= $plugin['Name'] . ': ' . $plugin['Version'] . "\n";
			}
		}

		$html .= "\n" . '### End System Info ###';
		return $html;
	}
} // End of Class.
