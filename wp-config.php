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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'portfolio' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3307' );

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
define( 'AUTH_KEY',         'y8S2WyuQnchC[AHP<dI$YBHox7@>WI?LHMY4DkTeFvMjhBh8tBH6lPr5,^8c(>K}' );
define( 'SECURE_AUTH_KEY',  'QdOa@npc _[4 I5N5l8g)yKn-+=+v*,t]lXg/]UJui&N/ceXmy{f2-j}Plyu6hF=' );
define( 'LOGGED_IN_KEY',    'd+?aFA5>KY:v<+.WtKeWr>p P+<u{!r5*6J=saN%`0ytG AWLir4|O;MF^2`jcn*' );
define( 'NONCE_KEY',        'NO>|f*ZUrI_,+,(MVZ:x]IS:IUs?[=Ys Td~JQ6e{)k{,G}0d]g QQqIWRtCWD<~' );
define( 'AUTH_SALT',        'e|%fo),p,-,zh[Ym3o]o0 [BdxI5=P6.),N*DI1@4%rN7X ?FU;^?EbggX;e4[[s' );
define( 'SECURE_AUTH_SALT', '+*Ts1p0k:tw[WrOB@K0l~poD]J;!G1]Y!ChD]K.krLf#6ix0.USK1fwrF*5h;R5M' );
define( 'LOGGED_IN_SALT',   'r2_chJ*Gee@{lgmUQp&z>1kr<]HNaVkcz8ioc`o@PTrGSBldg1dvFZ1A+eF7Q3r$' );
define( 'NONCE_SALT',       'v9FZewxQ2Aw+sNV1]ALxf:,^u5CUEz7~a4DgmEt0UK!-(-[dy@BX>D W?mzL [/T' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
