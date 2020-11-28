<?php

// Include helpers
require_once( FRAMEWORK_URL . '/helpers.php' );
// Include breadcrumb
if ( ! is_admin() ) {
	require_once( FRAMEWORK_URL . '/functions/breadcrumb.php' );
}

// Include main framework class
require_once( FRAMEWORK_URL . '/classes/SQueen.php' );


/*
 * Configurable options on framework initialization
 */
/* Delete plugin version transient on Install plugins page */
$kleo_rem_plugin_transient = false;
if ( is_admin() && isset( $_GET['page'] ) && 'install-required-plugins' === $_GET['page'] ) {
	$kleo_rem_plugin_transient = true;
}

$theme_args = array(
	'required_plugins' => array(

		array(
			'name'               => 'SweetDate Theme Core',
			// The plugin name
			'slug'               => 'sweetdate-core',
			// The plugin slug (typically the folder name)
			'version'            => '1.1.2',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'source'             => get_template_directory() . '/lib/inc/sweetdate-core.zip',
			// The plugin source
			'required'           => true,
			// If false, the plugin is only 'recommended' instead of required
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Adds Functionality to SweetDate theme.',
		),

		array(
			'name'               => 'Elementor',
			// The plugin name
			'slug'               => 'elementor',
			// The plugin slug (typically the folder name)
			'required'           => true,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'Buddypress',
			// The plugin name
			'slug'               => 'buddypress',
			// The plugin slug (typically the folder name)
			'required'           => true,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '2.4',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'HubSpot All-In-One Marketing',
			// The plugin name
			'slug'               => 'leadin',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			// The plugin source
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'The ultimate free plugin for Forms, Popups, Live Chat.',
		),
		array(
			'name'               => 'bbPress',
			// The plugin name
			'slug'               => 'bbpress',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'Envato Market - Theme updates',
			// The plugin name
			'slug'               => 'envato-market',
			// The plugin slug (typically the folder name)
			'source'             => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			// The plugin source
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '2.0.1',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Automatic theme updates from Envato Market.',
		),
		array(
			'name'               => 'BP Profile Search',
			// The plugin name
			'slug'               => 'bp-profile-search',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
		),
		array(
			'name'               => 'rtMedia',
			// The plugin name
			'slug'               => 'buddypress-media',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'Woocommerce',
			// The plugin name
			'slug'               => 'woocommerce',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '3.0',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'Paid Memberships Pro',
			// The plugin name
			'slug'               => 'paid-memberships-pro',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '1.7.2.1',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			//'source'                => get_template_directory() . '/framework/inc/paid-memberships-pro.zip',
			'external_url'       => ''
		),
		array(
			'name'               => 'Revolution Slider',
			// The plugin name
			'slug'               => 'revslider',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => sweetdate_get_plugin_version( 'revslider' ),
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'source'             => sweetdate_get_plugin_src( 'revslider' ),
			'external_url'       => ''
		),
		array(
			'name'               => 'Sidebar Generator',
			// The plugin name
			'slug'               => 'sq-sidebar-generator',
			// The plugin slug (typically the folder name)
			'version'            => '1.2.0',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'source'             => get_template_directory() . '/lib/inc/sq-sidebar-generator.zip',
			// The plugin source
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
			'description'        => 'Generates as many sidebars as you need. Then place them on any page you wish.',
		),
	)
);

//instance of our theme framework
global $kleo_sweetdate;
$kleo_sweetdate = SQueen::instance( $theme_args );


require_once( FRAMEWORK_URL . '/theme_settings.php' );

// Include admin theme options if we are in admin
if ( is_admin() ) {
	require_once( FRAMEWORK_URL . '/theme_options.php' );
}

/* Theme install wizard */
require_once( FRAMEWORK_URL . '/inc/merlin/merlin.php' );
require_once( FRAMEWORK_URL . '/merlin-config.php' );

// Include frontend logic
require_once( FRAMEWORK_URL . '/frontend.php' );


/**
 * Get the source of the plugin depending on the version available
 *
 * @param string $name
 *
 * @return string
 */
function sweetdate_get_plugin_src( $name ) {

	$api_url = 'https://updates.seventhqueen.com/check/';
	$api_url = add_query_arg( 'action', 'download', $api_url );
	$api_url = add_query_arg( 'slug', $name . '.zip', $api_url );

	return $api_url;
}

/**
 * @param string $name Plugin name
 *
 * @return mixed|string
 */
function sweetdate_get_plugin_version( $name ) {

	// Don't make any extra requests if we are not on specific panel pages
	$theme_pages = isset( $_GET['page'] ) && ( 'sq-panel' == $_GET['page'] || 'install-required-plugins' == $_GET['page'] );
	if ( ! $theme_pages ) {
		return '';
	}

	$version        = '';
	$transient_name = 'sweetdate_plugin_v_' . $name;
	if ( isset( $_GET['sq_force_updates'] ) ) {
		delete_transient( $transient_name );
	}

	if ( $version = get_transient( $transient_name ) ) {
		return $version;
	}

	$url = 'https://updates.seventhqueen.com/check/?action=get_metadata&slug=' . $name;

	$purchase_get = wp_remote_get( $url );

	// Check for error
	if ( ! is_wp_error( $purchase_get ) ) {
		$response = wp_remote_retrieve_body( $purchase_get );

		// Check for error
		if ( ! is_wp_error( $response ) ) {
			$response = json_decode( $response );
			$version  = $response->version;
		}
	}

	set_transient( $transient_name, $version, 43200 );

	return $version;
}
