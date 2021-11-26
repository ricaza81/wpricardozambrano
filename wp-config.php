<?php
define('WP_CACHE', true); // Added by WP Rocket
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpricardozambrano' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'B6e<nLZjWcc*QZ*}{ahYWgAjEtO*rX?;NMh[6G~K$,KKTwp|cdeC(R++Vq2gIMdG' );
define( 'SECURE_AUTH_KEY',  'VG.P[gM_d#$Y=]2J2v%H{Hs)jl!z($D8Qv:v,%-0H-e$v`P%[t]sE.ym0*@3AG %' );
define( 'LOGGED_IN_KEY',    '<UO]R)CdVh~:<UAq4l.=ET2&f=|0[JTtf w}_gFjN[<lizzYlUN_HfU?Awd3G8Kz' );
define( 'NONCE_KEY',        '4Izg_;,E=^TT3fD@H:}7kVTv:292DITx9~[a(CkjgmY9W7t>R|DQ3RZ)ex|c4,Ou' );
define( 'AUTH_SALT',        '4$Apbt}!9[U?)*4{ew6trf%8}Z!8f4fwDlR)Q@IXf^.SgaH|!?H0 Wec .13>fma' );
define( 'SECURE_AUTH_SALT', '^6[4A)$f96+7S]:H<e.9FU2?pTN@]rw4fvJ+##7E-HX,sHvmUa5j7l0m3/z&.LyW' );
define( 'LOGGED_IN_SALT',   '8E[,fQFL lYP9YnGGjwa73>@sJ80,$;)2V`L?Aq*Q#xDFOKOPCiUd3mm8eT&[cP7' );
define( 'NONCE_SALT',       'Fz7.V(RBebIkVX8JDdI51b51E=gO0u;aer!EDg)*!$T*F[!oCicos27x2IQ`+L$o' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
