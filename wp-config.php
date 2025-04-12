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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'jobs4you' );

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
define( 'AUTH_KEY',         'hILs8?$^aO&%x&fVI$^$V+j_G7RQpY7YSSI{`A]%7r_f9jFMhkMv0W|W|`(  qGt' );
define( 'SECURE_AUTH_KEY',  'B(V9sHgc.Qj6~>BbO;N,E!vZ--w9r7q-j0m9eR0m6|T97[Z,<5[{E:]<sp+=4,zx' );
define( 'LOGGED_IN_KEY',    '4|P_ANT~8p<mU( x?Krqk5LX~lsAB}%74`(i+v~r/xsU)BE*Fr>Frc8=.)rbMM(A' );
define( 'NONCE_KEY',        '>*P~Rz.rncjkyOc*c`t9UdUbK$u7 dIj~j0R._N;E fcDK9tmTFgRc^%#JPj<[tq' );
define( 'AUTH_SALT',        'Jh`!Cy_-$Lv0?L0*AB3jY_g7W$g3vGq8?/6cqs=dqDKf*8wUx#bU5*`Mi/[L{(N3' );
define( 'SECURE_AUTH_SALT', 'H3`*^E!Fg=Y:x^~Y9fU`i1;|jC@wc)^t(nW;kk#o-[:<NY224P;uiroJt0YZ%Mw#' );
define( 'LOGGED_IN_SALT',   '!K}R|O814EUFkO. o=.I*oW|32RVm$LX<tlAchldCdD|n!>MdVz.TNR=?$])4]r&' );
define( 'NONCE_SALT',       '(Teog+1Es(^~_`!N$Il^T/RZhH^]N{ZFzo,Ix32RLQE{m7Xz{DA #>?Hisj_]T./' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'job4U_';

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
