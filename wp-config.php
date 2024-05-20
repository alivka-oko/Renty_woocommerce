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
define('DB_NAME', 'rentytry');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'WAW0[Do3Vc.y8Pu^3yaH@@f>4Je$z)pnd*Tr}y/wb$BbX[uKXu RLNb9;t1wv!iW');
define('SECURE_AUTH_KEY',  'OmM7%HnosY]4ANloh_y$BS|7x4.DHbOe(kM^?x:a;#`L~|8vF_N:n0N@`U|T*/Kq');
define('LOGGED_IN_KEY',    '=/M5V#bhR@YXfVX_{}:SDxUmrwCT_&XeIr6P +TVxh.)neDizR|*C=JulM<+Ni9f');
define('NONCE_KEY',        '}EUs#cEw|RCC??]2Za,M6QBe-SBswMI?1WMz04[e~zEF0`l@_jDXF{{-JfFKFY?>');
define('AUTH_SALT',        'GE,$#7:g9!Y<4uGYGp;_4$?c[<5$`cl6kQhDsyeWV3CR^JBjGoBUm$I-ol68}BTT');
define('SECURE_AUTH_SALT', 'O1X;Zs7]p=,wl|i7H5*%i7oMT$<.JCnZMbcwunVY;+_:/:&uPp/+q&m?*.YDd7Uf');
define('LOGGED_IN_SALT',   'pcB[UPgC9Hx**D!5!fB$<}k!+t] DD9{N$No>?s*%W>9HoCPbX41FmsC#Bp$+Z;R');
define('NONCE_SALT',       'I!.;!{^gtyt4}z}fAm0E% _brky!C/#8=^Xkz_qf3si2ZQ._aQZfY)!s|I,%X0MY');

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
