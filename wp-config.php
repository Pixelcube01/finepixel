<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          ')D_9)n~a7;2<R~NP!^]*>RbKy!]XjkVA>oKU go6:5ZLU[7cpH2bey/v/0dOKp7j' );
define( 'SECURE_AUTH_KEY',   'JJj)C/ L8]C/poRNkiBGI4/RWQ2<1@{o2;SbgwH7h.ScVgt$257RsQXJc/`UF!V*' );
define( 'LOGGED_IN_KEY',     '!$aI2;FZjNlV!@`@#xh&Y_Hk/-?G{OR36L1_{|nFZ*-x&(7/?B-ij DuM#Qdl<3H' );
define( 'NONCE_KEY',         ';k[3 xpoF[c/Vrif!Zq3{?xH}i(FA/{)D@;KTeBz{&_$cA:PaE<iz>b%H&R`SydC' );
define( 'AUTH_SALT',         'BE4c|MTzt.hr]6UpFX(7!t2198UD)RYP@mg$2K]eX44xjcxDG3|Zbbkr.DV?WwD/' );
define( 'SECURE_AUTH_SALT',  'x#-G#^W%B)9IdQ]L%+^:QbjQc@Y%c$mnKP* K~9/vFxOc>q3IR ]7C|ZrpQ,+:z=' );
define( 'LOGGED_IN_SALT',    'T$=M+UI5]}[3{8%vqQd;$1CJS_(E;su.Q6swHo=]yu ;8h9h[qgS%7GSz1561q<d' );
define( 'NONCE_SALT',        ',@N8:(p[1g7^22 kz W..A]73r Rzp[A)&~<0=J;EYz]IjrbDNd$pBq>h3ZPpjL;' );
define( 'WP_CACHE_KEY_SALT', 'H@aB%*mmTa#XgVpM}-yi9r~7hYEE=0z-ybA(na86zjz[u3ao^iUyX|W<,O(q@U+=' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
