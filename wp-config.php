<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hackathon_3' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8W,ZoG,RO-yq(*YQf|U[7Z4On+2>xQP-CyqQF;0>-W8,f$VV%>wd6f|t?W_;l#dv' );
define( 'SECURE_AUTH_KEY',  'ly1*T,,GzX0v]MNfvbGI~|[j{uQ$^Lc/Q/;K#PE@6p|hy7jYt2I_bLf8Sv-3tG1Y' );
define( 'LOGGED_IN_KEY',    ' o)UY%|DQYnr1)d$a(e%gF>[= i>$TT&$LCe_rcZM52Gjm~}l[b]A$kQ~!8<8k^P' );
define( 'NONCE_KEY',        '].:mJ#G*hBfc`Yc#0<_wnXu|d0U,VxEO-eDv,7:6k[L%T0=@$R4p3Ar.hAwKOpFm' );
define( 'AUTH_SALT',        '>8jd0<Afc+4!6QswbcrN-G=uQ4(2tRQI.^I[>CP2#y$%x9*7QDq9k4rMzI@9/Q[s' );
define( 'SECURE_AUTH_SALT', '&da6Zxf8D_Ay6X:s`eB!m~OScwlGTH*EB><9_n4n^[2ZPo(7WG=3T,j+i9nATiVg' );
define( 'LOGGED_IN_SALT',   'Je!?L8ic.((ufaRHw%I-@TxrOmcDph3&ng^ZEgRF9aztRPM//o;cPHt2~dOrpTzZ' );
define( 'NONCE_SALT',       '!+?0p#^.Qte<=NV&EOZ4&~``]!9n[,NH>/E{D9$K+H#Qi tU I&%BX$E%AyVGOI{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
