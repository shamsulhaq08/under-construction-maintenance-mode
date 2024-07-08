<?php
/**
 * @var $ucmm_wpbrigade_array get_option
 * @since 1.0.0
 */
$ucmm_wpbrigade_array = (array) get_option( 'ucmm_wpbrigade_customization' );

/**
 * If a certain value exists in the settings array, return the value 
 *
 * @param [string] $ucmm_key
 * @param [array] $ucmm_wpbrigade_array
 * 
 * @return void
 */
function ucmm_wpbrigade_option_key( $ucmm_key, $ucmm_wpbrigade_array ) {

	if ( array_key_exists( $ucmm_key, $ucmm_wpbrigade_array ) ) {

		return $ucmm_wpbrigade_array[ $ucmm_key ];

	}
	// else {
	// return false;
	// }
}
/**
 * ucmm_wpbrigade_default_option_key
 *
 * @since 1.0.2
 * @version 1.5.0
 */
function ucmm_wpbrigade_default_option_key( $ucmm_key, $ucmm_wpbrigade_array, $default = true ) {

	if ( array_key_exists( $ucmm_key, $ucmm_wpbrigade_array ) ) {

		return $ucmm_wpbrigade_array[ $ucmm_key ];

	} else {
		return $default;
	}
}

$ucmm_bg_mobile         = ucmm_wpbrigade_option_key( 'setting_background_mobile', $ucmm_wpbrigade_array );
$ucmm_bg_video = ucmm_wpbrigade_option_key('setting_background_video', $ucmm_wpbrigade_array);
$ucmm_bg                = ucmm_wpbrigade_option_key( 'setting_background', $ucmm_wpbrigade_array );
$ucmm_logo              = ucmm_wpbrigade_option_key( 'ucmm_logo', $ucmm_wpbrigade_array );
$ucmm_header            = ucmm_wpbrigade_option_key( 'header_text', $ucmm_wpbrigade_array );
$ucmm_footer            = ucmm_wpbrigade_option_key( 'footer_text', $ucmm_wpbrigade_array );
$ucmm_logo_width        = ucmm_wpbrigade_option_key( 'ucmm_logo_width', $ucmm_wpbrigade_array );
$ucmm_logo_height       = ucmm_wpbrigade_option_key( 'ucmm_logo_height', $ucmm_wpbrigade_array );
$ucmm_seo_title         = ucmm_wpbrigade_option_key( 'ucmm_seo_title', $ucmm_wpbrigade_array );
$ucmm_seo_description   = ucmm_wpbrigade_option_key( 'ucmm_seo_description', $ucmm_wpbrigade_array );
$ucmm_seo_url           = ucmm_wpbrigade_option_key( 'ucmm_seo_url', $ucmm_wpbrigade_array );
$ucmm_seo_sitename      = ucmm_wpbrigade_option_key( 'ucmm_seo_sitename', $ucmm_wpbrigade_array );
$ucmm_seo_admin         = ucmm_wpbrigade_option_key( 'ucmm_seo_admin', $ucmm_wpbrigade_array );
$ucmm_seo_keywords      = ucmm_wpbrigade_option_key( 'ucmm_seo_keywords', $ucmm_wpbrigade_array );
$ucmm_custom_css        = ucmm_wpbrigade_option_key( 'ucmm_custom_css', $ucmm_wpbrigade_array );
$ucmm_ga_tracking_code  = ucmm_wpbrigade_option_key( 'ucmm_ga_tracking_code', $ucmm_wpbrigade_array );
$ucmm_footer_love       = ucmm_wpbrigade_default_option_key( 'ucmm_display_footer_text', $ucmm_wpbrigade_array );
$ucmm_schedule_end_time = ucmm_wpbrigade_option_key( 'ucmm_schedule_end', $ucmm_wpbrigade_array );
$ucmm_show_end_time     = ucmm_wpbrigade_option_key( 'ucmm_schedule_show_end_time', $ucmm_wpbrigade_array );
$ucmm_time_text_color 	= ucmm_wpbrigade_option_key( 'ucmm_schedule_text_color', $ucmm_wpbrigade_array );
$ucmm_header_text_color = ucmm_wpbrigade_option_key( 'ucmm_header_text_color', $ucmm_wpbrigade_array );
$ucmm_footer_text_color = ucmm_wpbrigade_option_key( 'ucmm_footer_text_color', $ucmm_wpbrigade_array );
$ucmm_love_position     = ucmm_wpbrigade_option_key( 'ucmm_display_footer_text_position', $ucmm_wpbrigade_array );
$ucmm_love_text_color   = ucmm_wpbrigade_option_key( 'ucmm_love_text_color', $ucmm_wpbrigade_array );

$social_network = array( 'ucmm_facebook', 'ucmm_twitter', 'ucmm_linkedin', 'ucmm_youtube', 'ucmm_instagram', 'ucmm_pinterest', 'ucmm_codepen' );

$social_links = array();

foreach ( $social_network as $key => $value ) {

	$ucmm_social_links[ $value ] = ucmm_wpbrigade_option_key( $value, $ucmm_wpbrigade_array );

}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- <link rel="icon" href="<?php // echo site_icon_url(); ?>" sizes="32x32" /> -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="<?php echo $ucmm_seo_title; ?>" />
	<meta name="description" content="<?php echo $ucmm_seo_description; ?>" />
	<meta name="url" content="<?php echo $ucmm_seo_url; ?>" />
	<meta name="site_name" content="<?php echo $ucmm_seo_sitename; ?>" />
	<meta name="author" content="<?php echo $ucmm_seo_admin; ?>">
	<meta name="keywords" content="<?php echo $ucmm_seo_keywords; ?>">
	<title><?php echo get_bloginfo( 'name' ); ?></title>

	<link href="<?php echo plugins_url( 'assets/css/fa-brands.min.css', __FILE__ ); ?>" rel="stylesheet">
	<link href="<?php echo plugins_url( 'assets/css/fontawesome.min.css', __FILE__ ); ?>" rel="stylesheet">

	<!--Adding Google analytics code-->
	<?php if ( ! empty( $ucmm_ga_tracking_code ) ) : ?>
		<?php echo $ucmm_ga_tracking_code; ?>
	<?php endif; ?>

	<style media="screen">
	html{
		height: 100%;
	}
	body{
		display: table;
		min-height: 100%;
		margin: 0;
		text-align: center;
		width: 100%;
		<?php if ( !empty($ucmm_bg_video) ) : ?>
			background: transparent;
		<?php else : ?>
			background-image: url(<?php echo null != $ucmm_bg ? $ucmm_bg : plugins_url( 'img/coming-soon.png', __FILE__ ); ?>);
			background-size: cover;
			background-position: center;
		<?php endif; ?>
	}
	h1{
		font-size: 60px;
		color: <?php echo $ucmm_header_text_color?>;
		text-transform: uppercase;
		margin: 0;
	}
	.ucmm-logo{
		<?php if ( '' == $ucmm_logo ) : ?>
		padding-top: 70px;
		<?php else : ?>
		padding-top: 20px;
		<?php endif; ?>
		vertical-align: middle;
		text-align: center;
		width: 100%;
		font-size: 50px;
		font-weight: bold;
		color: #fff;
	}
	.ucmm-logo img{
		width: <?php echo empty( $ucmm_logo_width ) ? '100px' : $ucmm_logo_width; ?>;
		height: <?php echo empty( $ucmm_logo_height ) ? '100px' : $ucmm_logo_height; ?>;
	}
	h2{
		font-size: 20px;
		color: <?echo $ucmm_footer_text_color?>;
		margin: 0;
		font-family: inherit;
	}
	h2 a{
		color: inherit;
	}
	.footer-love {
		position: absolute;
		color: #fff;
		bottom: 0;
		padding: 20px;
		padding-bottom: 5px;
		width: 100%;
		box-sizing: border-box;
		text-align: <?php echo isset( $ucmm_love_position ) ? sanitize_text_field( $ucmm_love_position ) : 'right'; ?>
	}
	.footer-love a{
		text-decoration: none;
		color: #fff;
	}
	.footer-love a:hover{
		color: #3BB9FF;
	}
	/* Icons style start here */
	.ucmm-social-icons{
		position: absolute;
		bottom: 30px;
		width: 100%;
		left: 0;
	}
	.ucmm-icon{
		width: 40px;
		height: 40px;
		display: inline-block;
		line-height: 40px;
		border-radius: 50%;
		margin: 5px;
	}
	.ucmm-icon .fab{
		color: #fff;
		vertical-align: middle;
		font-size: 18px;
		line-height: 40px;
	}
	.ucmm-facebook-icon{
		background: #4266C9;
		<?php if( empty( $ucmm_social_links['ucmm_facebook'] ) ) { ?>
		display: none;
		<?php } ?>
	}
	<?php if ( ! $ucmm_footer_love ) { ?>
		#customize-control-ucmm_wpbrigade_customization-ucmm_display_footer_text_position {
			display: none !important;
		}
	<?php } ?>
	.footer-love, .footer-love a {
		color: <?php echo isset( $ucmm_love_text_color ) ? sanitize_hex_color( $ucmm_love_text_color ) : '#fff' ?>
	}
	.ucmm-twitter-icon{
		background: #1DA1F2;
		<?php if( empty( $ucmm_social_links['ucmm_twitter'] ) ) { ?>
			display: none
		<?php } ?>
	}
	.ucmm-linkedin-icon{
		background: #2867B2;
		<?php if( empty( $ucmm_social_links['ucmm_linkedin'] ) ) { ?>
		display: none;
		<?php } ?>
	}
	.ucmm-google-icon{
		background: #d34836;
		<?php if( empty( $ucmm_social_links['ucmm_google'] ) ) { ?>
		display: none;
		<?php } ?>
	}
	.ucmm-youtube-icon{
		background: #FF0000;
		<?php if( empty( $ucmm_social_links['ucmm_youtube'] ) ) { ?>
		display: none;
		<?php } ?>
	}
	.ucmm-instagram-icon{
		background: #DD2A7B;
		<?php if( empty( $ucmm_social_links['ucmm_instagram'] ) ) { ?>
		display: none;
		<?php } ?>
	}
	.ucmm-pinterest-icon{
		background: #BD081C;
		<?php if( empty( $ucmm_social_links['ucmm_pinterest'] ) ) { ?>
		display: none;
		<?php } ?>
	}
	.ucmm-codepen-icon{
		background: #000;
		<?php if( empty( $ucmm_social_links['ucmm_codepen'] ) ) { ?>
		display: none;
		<?php } ?>
	}

	/*----- schedule time-----*/
	.ucmm_schedule_time{
		padding-top: 15px;
		font-size: 50px;
		color: <? echo $ucmm_time_text_color?>;
}
@media only screen and (max-width: 600px) {
	h1{
		font-size:40px;
	}

	body{
		display: table;
		min-height: 100%;
		margin: 0;
		text-align: center;
		width: 100%;
		background-image: url(<?php echo null != $ucmm_bg_mobile ? $ucmm_bg_mobile : plugins_url( 'img/coming-soon.png', __FILE__ ); ?>);
		background-size: cover;
		background-position: center;

	}
}

	<?php if ( ! empty( $ucmm_custom_css ) ) : ?>
		<?php echo $ucmm_custom_css; ?>
	<?php endif; ?>
	</style>

</head>
<body>
	<div class="ucmm-logo">

	 <img src="<?php echo $ucmm_logo; ?>" style="<?php echo ( '' == $ucmm_logo ) ? 'display:none' : ''; ?>"  >

		<h1>
		<?php
		if ( isset( $ucmm_header ) ) {
			echo $ucmm_header;
		} else{
			echo __( 'UNDER CONSTRUCTION', 'ucmm-wpbrigade' );
		}
		?>
		</h1>
		<h2>
		<?php
		if ( isset( $ucmm_footer ) ) {
			echo wp_kses_post( $ucmm_footer );
		} else{
			echo __( 'We are working hard to bring you new experience!', 'ucmm-wpbrigade' );

		}
		?>
		 </h2>

	</div>

	<div class="ucmm_schedule_time"> </div>

	<?php
	/*
	$social_icons  =array( 'ucmm_facebook_c', 'ucmm_twitter_c', 'ucmm_linkedin_c', 'ucmm_google_c', 'ucmm_youtube_c', 'ucmm_instagram_c', 'ucmm_pinterest_c', 'ucmm_codepen_c' );
	$social_links = array( 'ucmm_facebook', 'ucmm_twitter', 'ucmm_linkedin', 'ucmm_google', 'ucmm_youtube', 'ucmm_instagram', 'ucmm_pinterest', 'ucmm_codepen' );
	*/
	if( is_customize_preview() ){
		echo '<div class="ucmm-social-icons">';
		echo '<a class="ucmm-facebook-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_facebook'] . '"><i class="fab fa-facebook-f"></i></a>';
		echo '<a class="ucmm-twitter-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_twitter']  . '"><i class="fab fa-twitter"></i></a>';
		echo '<a class="ucmm-linkedin-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_linkedin'] . '"><i class="fab fa-linkedin"></i></a>';
		echo '<a class="ucmm-youtube-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_youtube'] . '"><i class="fab fa-youtube"></i></a>';
		echo '<a class="ucmm-instagram-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_instagram'] . '"><i class="fab fa-instagram"></i></a>';
		echo '<a class="ucmm-pinterest-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_pinterest'] . '"><i class="fab fa-pinterest"></i></a>';
		echo '<a class="ucmm-codepen-icon ucmm-icon" href="' .  $ucmm_social_links['ucmm_codepen'] . '"><i class="fab fa-codepen"></i></a>';
		echo '</div>';
	} else {

		if( ! ( $ucmm_social_links['ucmm_facebook'] == '' && $ucmm_social_links['ucmm_twitter']  == '' && $ucmm_social_links['ucmm_linkedin'] == '' && $ucmm_social_links['ucmm_youtube'] == '' && $ucmm_social_links['ucmm_instagram'] == '' && $ucmm_social_links['ucmm_pinterest'] == '' && $ucmm_social_links['ucmm_codepen'] == '' ) ) {
			echo '<div class="ucmm-social-icons">';
		}
		if( !($ucmm_social_links['ucmm_facebook'] == '' ) ){
			echo '<a class="ucmm-facebook-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_facebook'] . '"><i class="fab fa-facebook-f"></i></a>';
		}
		if( !($ucmm_social_links['ucmm_twitter'] == '' ) ){
			echo '<a class="ucmm-twitter-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_twitter'] . '"><i class="fab fa-twitter"></i></a>';
		}
		if( !( $ucmm_social_links['ucmm_linkedin'] == '' ) ){
			echo '<a class="ucmm-linkedin-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_linkedin'] . '"><i class="fab fa-linkedin"></i></a>';
		}
		if( !( $ucmm_social_links['ucmm_youtube'] == '' ) ){
			echo '<a class="ucmm-youtube-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_youtube'] . '"><i class="fab fa-youtube"></i></a>';
		}
		if( !( $ucmm_social_links['ucmm_instagram'] == '' ) ){
			echo '<a class="ucmm-instagram-icon ucmm-icon" href="'. $ucmm_social_links['ucmm_instagram'] . '"><i class="fab fa-instagram"></i></a>';
		}
		if( !( $ucmm_social_links['ucmm_pinterest'] == '' ) ){
			echo '<a class="ucmm-pinterest-icon ucmm-icon" href="'. $ucmm_social_links['ucmm_pinterest'] . '"><i class="fab fa-pinterest"></i></a>';
		}
		if( !( $ucmm_social_links['ucmm_codepen'] == '' ) ){
			echo '<a class="ucmm-codepen-icon ucmm-icon" href="' . $ucmm_social_links['ucmm_codepen'] . '"><i class="fab fa-codepen"></i></a>';
		}
		echo '</div>';
	}
	?>

	<?php if ( $ucmm_footer_love ) : ?>
		<div class="footer-love">
			<?php _e( 'Powered by:', 'ucmm-wpbrigade' ); ?> <a href="https://wordpress.org/plugins/under-construction-maintenance-mode/" target="_blank">WPBrigade</a>
		</div>
	<?php endif; ?>

</body>

<?php if ( $ucmm_show_end_time && $ucmm_schedule_end_time ) : // statr if  to show counter add counter script ?>
<script>

// Set the date we're counting down to.
var endDate = "<?php echo date( 'F j, Y H:i:s', strtotime( $ucmm_schedule_end_time ) ); ?>";
var countDownDate = new Date( endDate ).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var currentTime = new Date().toLocaleString("en-US", {timeZone: "<?php echo get_option( 'timezone_string' ); ?>"})

	var now = new Date( currentTime ).getTime();
  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	if( days >   0 ){
		days = days + "d "
	}else{
		days = ''
	}
  // Display the result in the element with id="demo"
  document.querySelector('.ucmm_schedule_time').innerHTML = days + hours + "h "
  + minutes + "m " + seconds + "s ";


  // If the count down is finished, write some text
  if (distance < 0) {

	clearInterval(x);

	document.querySelector('.ucmm_schedule_time').innerHTML = "<?php 

		// Filter to change the message to be shown on redirection.
		if ( ! is_customize_preview() ) {
			$redirect_message = __( 'Website is now LIVE! will be redirected to homepage shortly. If not, please refresh the page.', 'ucmm-wpbrigade' );
		} else {
			$redirect_message = __( 'Maintenance schedule has been expired. Please update the time or turn if off. ', 'ucmm-wpbrigade' );
		}

		// Filter to change the redirection and customizer message.
		$redirect_message = apply_filters( 'ucmm_redirect_message', $redirect_message );

		// Show the redirection or customizer message accordingly. 
		esc_html_e( $redirect_message );
	
	?>";
	if( distance == -1000 ) {
		//Redirect after 3 seconds
		setTimeout(function () {
					location.reload( true );
				}, 3000);
		}
	}
}, 1000 );

</script>
<?php endif; // end if to show counter add counter script ?>
</html>