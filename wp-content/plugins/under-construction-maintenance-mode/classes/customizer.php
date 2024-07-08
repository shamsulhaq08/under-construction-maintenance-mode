<?php
/**
 *
 */
class UCMM_WPBrigade_Entities {

  function __construct()
  {
    $this->_hooks();
  }

  public function _hooks() {

    add_action( 'customize_register', array( $this, 'customize_ucmm_wpbrigade' ) );
    add_action( 'wp_footer', array( $this, 'ucmm_wpbrigade_output_youtube_background' ) );
  }


  /**
  * Register plugin settings Panel in WP Customizer
  *
  * @param	$wp_customize
  * @since	1.0.0
  */
  public function customize_ucmm_wpbrigade( $wp_customize ) {

   //Select Sanitization

    //select sanitization function
    function ucmm_sanitize_select( $input, $setting ){

      //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
      $input = sanitize_key($input);

      //get the list of possible select options
      $choices = $setting->manager->get_control( $setting->id )->choices;

      //return input if valid or return default option
      return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

  }

    //file input sanitization function

    function ucmm_sanitize_file( $file, $setting ) {

    //allowed file types
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
    );

    //check file type from file name
    $file_ext = wp_check_filetype( $file, $mimes );

    //if file has a valid mime type return it, otherwise return default
    return ( $file_ext['ext'] ? $file : $setting->default );
  }

  //checkbox sanitization function
  function sanitize_checkbox( $input ){

    //returns true if checkbox is checked
    // Boolean check.
    return ( ( isset( $input ) && true == $input ) ? true : false );
  }
 //	=============================
    //	= Panel for UCMM WPBrigade  =
    //	=============================
    $wp_customize->add_panel( 'ucmm_wpbrigade_panel', array(
      'title'						=> __( 'Under Construction', 'ucmm-wpbrigade' ),
      'description'			=> __( 'Customize Your WordPress Under Construction Page :)', 'ucmm-wpbrigade' ),
      'priority'				=> 30,
    ) );

    //	=============================
    //	= Section for Logo		      =
    //	=============================
    $wp_customize->add_section(
    'ucmm_wpbrigade_logo_section',
    array(
      'title'				 => __( 'Logo', 'ucmm-wpbrigade' ),
      'description'	 => __( 'Customize Your Logo', 'ucmm-wpbrigade' ),
      'priority'		 => 5,
      'panel'				 => 'ucmm_wpbrigade_panel',
    ) );

    $wp_customize->add_setting(
    'ucmm_wpbrigade_customization[ucmm_logo]',
    array(
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage',
      'sanitize_callback' => 'ucmm_sanitize_file',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ucmm_wpbrigade_customization[ucmm_logo]', array(
      'label'		  => __( 'Logo Image:', 'ucmm-wpbrigade' ),
      'section'	  => 'ucmm_wpbrigade_logo_section',
      'priority'	=> 5,
      'settings'	=> 'ucmm_wpbrigade_customization[ucmm_logo]'
    ) ) );


    $logo_control = array( 'ucmm_logo_width', 'ucmm_logo_height', 'ucmm_logo_padding', 'ucmm_logo_hover', 'ucmm_logo_hover_title' );
    $logo_default = array( '100px', '100px', '200px', '', '' );
    $logo_label   = array(
      __( 'Logo Width:', 'ucmm-wpbrigade' ),
      __( 'Logo Height:', 'ucmm-wpbrigade' ),
      __( 'Padding Bottom:', 'ucmm-wpbrigade' ),
      __( 'Logo URL:', 'ucmm-wpbrigade' ),
      __( 'Logo Hover Title:', 'ucmm-wpbrigade' )
    );

    $logo = 0;
    while ( $logo < 2 ) :

      $wp_customize->add_setting( "ucmm_wpbrigade_customization[{$logo_control[$logo]}]", array(
        'default'					=> $logo_default[$logo],
        'type'						=> 'option',
        'capability'			=> 'manage_options',
        'transport'       => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',

      ) );

	$wp_customize->add_control(
		$logo_control[$logo],
		array(
			'label'             => $logo_label[$logo],
			'section'           => 'ucmm_wpbrigade_logo_section',
			'priority'          => 10,
			'settings'          => "ucmm_wpbrigade_customization[{$logo_control[$logo]}]",
		)
	);

      $logo++;
    endwhile;

    //	=============================
    //	= Section for Background		=
    //	=============================
    $wp_customize->add_section( 'ucmm_wpbrigade_background_section', array(
      'title'				 => __( 'Background', 'ucmm-wpbrigade' ),
      'description'	 => '',
      'priority'		 => 10,
      'panel'				 => 'ucmm_wpbrigade_panel',
    ) );

   $wp_customize->add_setting( 'ucmm_wpbrigade_customization[setting_background]', array(
      'default'        =>  UCMM_WPBRIGADE_DIR_URL . 'img/coming-soon.png',
      'type'					 => 'option',
      'capability'		 => 'manage_options',
      'transport'      => 'postMessage',
      'sanitize_callback' => 'ucmm_sanitize_file',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ucmm_wpbrigade_customization[setting_background]', array(
      'label'		   => __( 'Background Image:', 'ucmm-wpbrigade' ),
      'section'	   => 'ucmm_wpbrigade_background_section',
      'priority'	 => 10,
      'settings'	 => 'ucmm_wpbrigade_customization[setting_background]',
    ) ) );

//Setting for background Cover
    $wp_customize->add_setting( 'ucmm_wpbrigade_customization[background_cover]', array(
      'default'        => 'auto',
      'type'					 => 'option',
      'capability'		 => 'manage_options',
      'transport'      => 'postMessage',
      'sanitize_callback' => 'ucmm_sanitize_select',
    ) );


    $wp_customize->add_control( 'ucmm_wpbrigade_customization[background_cover]', array(
      'settings'	 => 'ucmm_wpbrigade_customization[background_cover]',
      'label'		   => __( 'Background Image Size:', 'ucmm-wpbrigade' ),
      'section'	   => 'ucmm_wpbrigade_background_section',
      'priority'	 => 11,
      'type'			 => 'select',
      'choices'					=> array(
        'auto'					=> 'auto',
        'cover'				  => 'cover',
        'contain'			  => 'contain',
        'initial'			  => 'initial',
        'inherit'			  => 'inherit',    ),
         ) ) ;

        // settings for background Repeat
    $wp_customize->add_setting( 'ucmm_wpbrigade_customization[background_repeat]', array(
      'default'        => 'no-repeat',
      'type'					 => 'option',
      'capability'		 => 'manage_options',
      'transport'      => 'postMessage',
      'sanitize_callback' => 'ucmm_sanitize_select',
    ) );


    $wp_customize->add_control( 'ucmm_wpbrigade_customization[background_repeat]', array(
      'settings'	    => 'ucmm_wpbrigade_customization[background_repeat]',
      'label'		      => __( 'Background Repeat:', 'ucmm-wpbrigade' ),
      'section'	      => 'ucmm_wpbrigade_background_section',
      'priority'	    => 11,
      'type'					=> 'select',
      'choices'				=> array(
        'repeat'				=> 'repeat',
        'repeat-x'			=> 'repeat-x',
        'repeat-y'			=> 'repeat-y',
        'no-repeat'		  => 'no-repeat',
        'initial'			  => 'initial',
        'inherit'			  => 'inherit',
      ),
    ) );

    //Settings for Background Position
    $wp_customize->add_setting( 'ucmm_wpbrigade_customization[background_position]', array(
      // 'default'        => 'center',
      'type'					 => 'option',
      'capability'		 => 'manage_options',
      'transport'      => 'postMessage',
      'sanitize_callback' => 'ucmm_sanitize_select',
    ) );

    $wp_customize->add_control( 'ucmm_wpbrigade_customization[background_position]', array(
      'settings'	 => 'ucmm_wpbrigade_customization[background_position]',
      'label'		   => __( 'Background Position:', 'ucmm-wpbrigade' ),
      'section'	   => 'ucmm_wpbrigade_background_section',
      'priority'	 => 11,
      'type'			 => 'select',
      'choices'		 => array(
        'left'		 => 'left',
        'center'	 => 'center',
        'bottom'	 => 'bottom',
        'top'		   => 'top',
        'right'  	 => 'right',
        'initial'	 => 'initial',
        'inherit'	 => 'inherit',
        'unset'		 => 'unset',

    ) ) );

       // New Setting for Mobile Background Image
$wp_customize->add_setting( 'ucmm_wpbrigade_customization[setting_background_mobile]', array(
  'default'            => '',
  'type'               => 'option',
  'capability'         => 'manage_options',
  'transport'          => 'postMessage',
  'sanitize_callback'  => 'ucmm_sanitize_file',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ucmm_wpbrigade_customization[setting_background_mobile]', array(
  'label'         => __( 'Mobile Background Image:', 'ucmm-wpbrigade' ),
  'section'       => 'ucmm_wpbrigade_background_section',
  'priority'      => 20, // Adjust priority as needed
  'settings'      => 'ucmm_wpbrigade_customization[setting_background_mobile]',
) ) );



    //	=============================
    //	= Section for Text          =
    //	=============================
    $wp_customize->add_section( 'ucmm_wpbrigade_text_section', array(
      'title'				 => __( 'Text Section', 'ucmm-wpbrigade' ),
      'description'	 => '',
      'priority'		 => 15,
      'panel'				 => 'ucmm_wpbrigade_panel',
    ) );

    $wp_customize->add_setting( "ucmm_wpbrigade_customization[header_text]", array(
      'default'				=> __("UNDER CONSTRUCTION", 'ucmm-wpbrigade'),
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ucmm_wpbrigade_customization[header_text]', array(
      'label'						 => __( 'Header Text', 'ucmm-wpbrigade'),
      'section'					 => 'ucmm_wpbrigade_text_section',
      'priority'				 => 5,
      'settings'				 => "ucmm_wpbrigade_customization[header_text]"
    ) );
    
	//	= Header Text Color setting =

	$wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_header_text_color]', array(
		'default'				  	=> '#ffffff',
			'type'					    => 'option',
			'capability'		    => 'manage_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ucmm_wpbrigade_customization[ucmm_header_text_color]', array(
			'label'		   => __( 'Header Text Color:', 'ucmm_wpbrigade' ),
			'section'	   => 'ucmm_wpbrigade_text_section',
			'priority'	 => 10,
			'settings'	 => 'ucmm_wpbrigade_customization[ucmm_header_text_color]'
		) ) );
    $wp_customize->add_setting( "ucmm_wpbrigade_customization[footer_text]", array(
      'default'				=> __( 'We are working hard to bring you new experience!', 'ucmm-wpbrigade' ),
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage',
      'sanitize_callback' => 'wp_kses_post',
    ) );

	/**
	 * Add the subheading textarea.
	 *
	 * @since 1.0.0
	 * @version 1.4.1
	 */
    $wp_customize->add_control( 'ucmm_wpbrigade_customization[footer_text]', array(
      'label'		=> __( 'Subheading Text', 'ucmm-wpbrigade'),
      'description'	=> __( 'A new experience. You can use HTML tags here.', 'ucmm-wpbrigade' ),
      'type'		=> 'textarea',
      'section'		=> 'ucmm_wpbrigade_text_section',
      'priority'	=> 10,
      'settings'	=> "ucmm_wpbrigade_customization[footer_text]"
    ) );

    $wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_footer_text_color]', array(
		'default'			=> '#ffffff',
		'type'				=> 'option',
		'capability'		=> 'manage_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
	  ) );
  
	  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ucmm_wpbrigade_customization[ucmm_footer_text_color]', array(
		'label'		 => __( 'Subheading Text Color:', 'ucmm_wpbrigade' ),
		'section'	 => 'ucmm_wpbrigade_text_section',
		'priority'	 => 10,
		'settings'	 => 'ucmm_wpbrigade_customization[ucmm_footer_text_color]'
	  ) ) );
            

    //	=============================
    //	= Section for Footer Love   =
    //	=============================

    $wp_customize->add_section( 'section_footer_love', array(
      'title'		   	=> __( 'Show Some Love', 'ucmm-wpbrigade' ),
      // 'description'	=> __( 'Show some love', 'ucmm-wpbrigade' ),
      'priority'		=> 20,
      'panel'			=> 'ucmm_wpbrigade_panel',
    ) );

    $wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_display_footer_text]', array(
      'default'        		=> true,
      'type'           		=> 'option',
      'capability'		 	=> 'manage_options',
      'transport'      		=> 'postMessage',
      'sanitize_callback'	=> 'sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'ucmm_wpbrigade_customization[ucmm_display_footer_text]', array(
      'settings' 	=> 'ucmm_wpbrigade_customization[ucmm_display_footer_text]',
      'label'		=> __( 'Please help other learn about this free plugin by placing a small link in the footer. Thank you very much!', 'ucmm-wpbrigade'),
      'section'		=> 'section_footer_love',
      'priority'	=> 5,
      'type'		=> 'checkbox',

    ) );

	/**
	 * Add the Love Position.
	 *
	 * @version 1.5.0
	 */
    $wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_display_footer_text_position]', array(
		'default'           => 'right',
		'type'              => 'option',
		'capability'        => 'manage_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ucmm_sanitize_select',
	  ) );

    $wp_customize->add_control( 'ucmm_wpbrigade_customization[ucmm_display_footer_text_position]', array(
		'settings' => 'ucmm_wpbrigade_customization[ucmm_display_footer_text_position]',
		'label'    => __( 'Position:', 'ucmm-wpbrigade' ),
		'section'  => 'section_footer_love',
		'priority' => 6,
		'type'     => 'select',
		'choices'  => array(
			'right'  => __( 'Right', 'ucmm-wpbrigade' ),
			'left'   => __( 'Left', 'ucmm-wpbrigade' ),
			'center' => __( 'Center', 'ucmm-wpbrigade' ),
		),
	) ) ;

	/**
	 * Add the Love text color option.
	 *
	 * @since 1.5.1
	 */ 
	$wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_love_text_color]', array(
		'default'			=> '#ffffff',
		'type'				=> 'option',
		'capability'		=> 'manage_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ucmm_wpbrigade_customization[ucmm_love_text_color]', array(
		'label'		 => __( 'Text Color:', 'ucmm_wpbrigade' ),
		'section'	 => 'section_footer_love',
		'priority'	 => 10,
		'settings'	 => 'ucmm_wpbrigade_customization[ucmm_love_text_color]'
	) ) );
	
    //	=============================
    //	= Section for Social Links  =
    //	=============================

    $social_control = array( 'ucmm_facebook', 'ucmm_twitter', 'ucmm_linkedin', 'ucmm_youtube', 'ucmm_instagram', 'ucmm_pinterest', 'ucmm_codepen' );
    $social_default = array( "ucmm_facebook" => "", "ucmm_twitter" => "", "ucmm_linkedin" => "",
                             "ucmm_youtube" => "",  "ucmm_instagram" => "", "ucmm_linkedin" => "", "ucmm_codepen" => "",
                             "ucmm_pinterest" => "");
    $social_label   = array(
      "ucmm_facebook"  => __( 'Facebook Link:', 'ucmm-wpbrigade' ),
      "ucmm_twitter"   => __( 'Twitter Link:', 'ucmm-wpbrigade' ),
      "ucmm_linkedin"  => __( 'Linkedin Link:', 'ucmm-wpbrigade' ),
      "ucmm_google"    => __( 'Google Plus Link:', 'ucmm-wpbrigade' ),
      "ucmm_youtube"   =>__( 'YouTube Link:', 'ucmm-wpbrigade' ),
      "ucmm_instagram" => __( 'Instagram Link:', 'ucmm-wpbrigade' ),
      "ucmm_pinterest" => __( 'Pinterest Link:', 'ucmm-wpbrigade' ),
      "ucmm_codepen"   => __( 'Codepen Link:', 'ucmm-wpbrigade' )
    );
    // $social_sanitizations = array( 'ucmm_facebook_sanitization', 'ucmm_twitter_sanitization', 'ucmm_linkedin_sanitization',
    // 'ucmm_youtube_sanitization', 'ucmm_instagram_sanitization', 'ucmm_pinterest_sanitization', 'ucmm_codepen_sanitization')

    $wp_customize->add_section( 'ucmm_social_icon_section', array(
      'title'				 => __( 'Add Social Accounts', 'ucmm-wpbrigade' ),
      'priority'		 => 25,
      'panel'				 => 'ucmm_wpbrigade_panel',
    ) );


  foreach( $social_control as $key => $social ):

      $wp_customize->add_setting(
        "ucmm_wpbrigade_customization[$social]", array(
        // 'default'				=> isset( $social_default[$social] ) ? esc_url_raw( $social_default[$social] ) : '' ,
        'type'					=> 'option',
        'capability'			=> 'manage_options',
        'transport'        		=> 'postMessage',
        'sanitize_callback'	    => 'esc_url_raw',
      ) );

      $wp_customize->add_control( $social, array(
		'label'			=> $social_label[$social],
        'section'		=> 'ucmm_social_icon_section',
        'priority'		=> 10,
		'settings'		=> "ucmm_wpbrigade_customization[{$social}]",
		'input_attrs'	=> array(
		'placeholder'	=> __( 'https://www.'.explode( 'ucmm_', $social)[1].'.com/Link', 'ucmm-wpbrigade' )),
      ) );


  endforeach;

    //	=============================
    //	= Section for Custom CSS		=
    //	=============================
    $wp_customize->add_section(
    'ucmm_section_css',
    array(
      'title'		=> __( 'Custom CSS', 'ucmm-wpbrigade' ),
      'description'	=> '',
      'priority'	=> 30,
      'panel'		=> 'ucmm_wpbrigade_panel',
    ) );

    $wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_custom_css]', array(
      //'default'         	=> "/* You can add your custom CSS here. */",
      'type'				=> 'option',
      'capability'			=> 'manage_options',
      'transport'       	=> 'postMessage',
      'sanitize_callback'	=> 'wp_strip_all_tags'
    ) );

    $wp_customize->add_control( 'ucmm_wpbrigade_customization[ucmm_custom_css]', array(
      'label'			=> __( 'Customize CSS', 'ucmm-wpbrigade' ),
      'type'			=> 'textarea',
      'section'			=> 'ucmm_section_css',
      'input_attrs' 	=> array(
      'placeholder'		=> __( 'You can add your custom CSS here.', 'ucmm-wpbrigade' ) ),
      'priority'		=> 5,
      'settings'		=> 'ucmm_wpbrigade_customization[ucmm_custom_css]'
    ) );

    //	=============================
    //	= Section for SEO Configuration
    //	=============================

    $seo_control = array( 'ucmm_seo_title', 'ucmm_seo_description', 'ucmm_seo_url', 'ucmm_seo_sitename', 'ucmm_seo_admin', 'ucmm_seo_keywords' );
    $seo_default = array( "", "", get_bloginfo( 'url' ), get_bloginfo( 'name' ), "", "" );
    $seo_sanitize = array( 'sanitize_text_field', 'sanitize_text_field', 'esc_url_raw', 'sanitize_text_field', 'sanitize_text_field', 'sanitize_text_field');
    $seo_label   = array(
      __( 'SEO Title:', 'ucmm-wpbrigade' ),
      __( 'SEO Description:', 'ucmm-wpbrigade' ),
      __( 'SEO URL:', 'ucmm-wpbrigade' ),
      __( 'SEO Site Name:', 'ucmm-wpbrigade' ),
      __( 'SEO Author Name:', 'ucmm-wpbrigade' ),
      __( 'SEO Keywords:', 'ucmm-wpbrigade' )
    );

    $wp_customize->add_section(
    'ucmm_seo_section',
    array(
      'title'			=> __( 'SEO Configuration', 'ucmm-wpbrigade' ),
      'description'		=> '',
      'priority'		=> 35,
      'panel'			=> 'ucmm_wpbrigade_panel',
    ) );

    $seo = 0;
    while ( $seo < 6 ) :

      $wp_customize->add_setting(
        "ucmm_wpbrigade_customization[{$seo_control[$seo]}]", array(
        'default'				=> $seo_default[$seo],
        'type'					=> 'option',
        'capability'			=> 'manage_options',
        'transport'       		=> 'postMessage',
        'sanitize_callback'		=> $seo_sanitize[$seo],
      ) );

      $wp_customize->add_control( $seo_control[$seo], array(
        'label'		=> $seo_label[$seo],
        'section'	=> 'ucmm_seo_section',
        'settings'	=> "ucmm_wpbrigade_customization[{$seo_control[$seo]}]"
      ) );

      $seo++;
    endwhile;

    //	=============================
    //	= Section for Google Analytics
    //	=============================
    $wp_customize->add_section(
    'ucmm_ga_tracking_section',
    array(
      'title'			=> __( 'Google Analytics Tracking Code', 'ucmm-wpbrigade' ),
      'description'		=> '',
      'priority'		=> 40,
      'panel'			=> 'ucmm_wpbrigade_panel',
    ) );

    $wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_ga_tracking_code]', array(
      //'default'        	=> "/* Google Analytics Tracking Code here. */",
      'type'	   			=> 'option',
      'capability'			=> 'manage_options',
      'transport'        	=> 'postMessage',
      'sanitize_callback'	=> 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'ucmm_wpbrigade_customization[ucmm_ga_tracking_code]', array(
      'label'			=> __( 'Google Analytics Tracking Code', 'ucmm-wpbrigade' ),
      'type'			=> 'textarea',
      'section'			=> 'ucmm_ga_tracking_section',
      'priority'		=> 5,
      'input_attrs'		=> array(
        'placeholder'   => __( 'Google Analytics Tracking Code here.', 'ucmm-wpbrigade' ) ),
      'settings'		=> 'ucmm_wpbrigade_customization[ucmm_ga_tracking_code]'
    ) );

    //	===================================
    //	= Section for Start and End time	=
    //	===================================
$isset_time_zone = get_option( 'timezone_string');
$time_warn = __( '' , 'ucmm-wpbrigade' );
if($isset_time_zone == '') {
$time_warn = sprintf( __( 'Please update your WordPress %1$s time Zone%2$s before making a maintenance schedule ', 'ucmm-wpbrigade' ), '<a href="' . admin_url( 'options-general.php' ) . '">', '</a>' , 'ucmm-wpbrigade' );
}
    $wp_customize->add_section(
    'ucmm_schedule_section',
    array(
      'title'		=> __( 'UCMM Start and End schedule', 'ucmm-wpbrigade' ),
      'priority'	=> 54,
      'panel'		=> 'ucmm_wpbrigade_panel',
    ) );
    $wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_schedule_show_end_time]', array(
      // 'default'          => " default value",
      'type'				=> 'option',
      'capability'			=> 'manage_options',
      'transport'        	=> 'postMessage',
      'sanitize_callback'	=> 'sanitize_checkbox'

		) );
    $wp_customize->add_control( 'ucmm_wpbrigade_customization[ucmm_schedule_show_end_time]', array(
		'label'			=> __( 'Show Maintenance Schedule', 'ucmm-wpbrigade' ),
		'description'	=> $time_warn,
		'type'			=> 'checkbox',
		'section'		=> 'ucmm_schedule_section',
		'priority'		=> 5,
		'settings'		=> 'ucmm_wpbrigade_customization[ucmm_schedule_show_end_time]'
    ) );

	$wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_schedule_start]', array(
      //'default'         => " default value",
      'type'			=> 'option',
      'capability'			  => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback'	=> 'sanitize_text_field'

    ) );
    $wp_customize->add_control( 'ucmm_wpbrigade_customization[ucmm_schedule_start]', array(
      'label'						  => __( 'Start Maintenance Mode From', 'ucmm-wpbrigade' ),
      'description'				=> __( 'WordPress Time Zone : '. get_option( 'timezone_string') , 'ucmm-wpbrigade' ),
      'type'						  => 'datetime-local',
      'section'					  => 'ucmm_schedule_section',
      'priority'				  => 5,
      'settings'				  => 'ucmm_wpbrigade_customization[ucmm_schedule_start]'
		) );

		$wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_schedule_end]', array(
      //'default'         => " default value",
      'type'						  => 'option',
      'capability'			  => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'ucmm_wpbrigade_customization[ucmm_schedule_end]', array(
			'label'						 => __( 'End Maintenance Mode At', 'ucmm-wpbrigade' ),
			'description'			 => __( 'WordPress Time Zone : '. get_option( 'timezone_string') , 'ucmm-wpbrigade' ),
      'type'						 => 'datetime-local',
      'section'					 => 'ucmm_schedule_section',
      'priority'				 => 6,
      'settings'				 => 'ucmm_wpbrigade_customization[ucmm_schedule_end]'
		) );
		$wp_customize->add_setting( 'ucmm_wpbrigade_customization[ucmm_schedule_text_color]', array(
			'default'					  => '#fff',
      'type'					    => 'option',
      'capability'		    => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.

    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ucmm_wpbrigade_customization[ucmm_schedule_text_color]', array(
			'label'						 => __( 'Color', 'ucmm-wpbrigade' ),
			'description'			 => __( '"Time Counter" and "Redirect Message"', 'ucmm-wpbrigade' ),
      'section'					 => 'ucmm_schedule_section',
      'priority'				 => 7,
      'settings'				 => 'ucmm_wpbrigade_customization[ucmm_schedule_text_color]'
    ) ) );


  }

}
?>

<?php
function ucmm_customize_register($wp_customize) {
  // Add panel for Under Construction settings
  $wp_customize->add_panel('ucmm_wpbrigade_panel', array(
      'title'       => __('Youtube Video Background', 'ucmm-wpbrigade'),
      'description' => __('Customize Your WordPress Under Construction Page', 'ucmm-wpbrigade'),
      'priority'    => 30,
  ));

  // Section for Under Construction settings
  $wp_customize->add_section('ucmm_under_construction_section', array(
      'title'    => __('Youtube Video Background', 'ucmm-textdomain'),
      'priority' => 5,
      'panel'    => 'ucmm_wpbrigade_panel',
  ));

  // Setting for YouTube video link
  $wp_customize->add_setting('ucmm_youtube_background_video', array(
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
      'transport'         => 'refresh',
  ));

  // Control for YouTube Video Link
  $wp_customize->add_control('ucmm_youtube_background_video', array(
      'label'       => __('YouTube Background Video', 'ucmm-textdomain'),
      'section'     => 'ucmm_under_construction_section',
      'settings'    => 'ucmm_youtube_background_video',
      'type'        => 'text',
      'description' => __('Enter the YouTube video link to be used as background.', 'ucmm-textdomain'),
  ));

  // Setting for Background Position
  $wp_customize->add_setting('ucmm_wpbrigade_customization_background_position', array(
      'default'           => 'center center',
      'sanitize_callback' => 'sanitize_text_field',
      'transport'         => 'refresh',
  ));

  // Control for Background Position
  $wp_customize->add_control('ucmm_wpbrigade_customization_background_position', array(
      'label'       => __('Background Position', 'ucmm-textdomain'),
      'section'     => 'ucmm_under_construction_section',
      'settings'    => 'ucmm_wpbrigade_customization_background_position',
      'type'        => 'text',
      'description' => __('Enter the background position (e.g., "center center").', 'ucmm-textdomain'),
  ));
}
add_action('customize_register', 'ucmm_customize_register');


?>
