<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

if ( ( $_SERVER[ 'HTTP_HOST' ] ?: $_SERVER[ 'SERVER_NAME' ] ) !== 'guesture.wip.lazaro.in' )
	if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/cms/wp-content/uploads/' ) !== false )
		return header( 'Location: http://guesture.wip.lazaro.in' . $_SERVER[ 'REQUEST_URI' ], true, 302 );

define( 'WP_HOME', 'http://' . ( $_SERVER[ 'HTTP_HOST' ] ?: $_SERVER[ 'SERVER_NAME' ] ) );
define( 'WP_SITEURL', 'http://' . ( $_SERVER[ 'HTTP_HOST' ] ?: $_SERVER[ 'SERVER_NAME' ] ) . '/cms' );

// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'guesture');

/** MySQL database username */
define('DB_USER', 'remotelazaro');

/** MySQL database password */
define('DB_PASSWORD', 't34m,l4z4r0,2');

/** MySQL hostname */
define('DB_HOST', '139.59.39.166');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'aHoMA<<GKU?)yP,.7w>%9NGNoyVxilx_`F:uL^%)Aln6Q|=i!bX*Uc;C~Zj&oNP?');
define('SECURE_AUTH_KEY',  '4^J-9]u;8Fuf[Fe4b9C}?uxIH`-^6Wkcez)XW}i-M>=ku^}2&Q5~mYUW6~P|uEjw');
define('LOGGED_IN_KEY',    '2;wj@UPO|Df,5K@tS.yh4b@aXO%b-UgZ]j%fF-wTp|Eetrqv{r?XJ}%86r]u:a:S');
define('NONCE_KEY',        '@5~U@%13WXn)D*!;7n;-e$(3eJq^OoLI8el>_8Bfw-LlN-!+Uhn5;6>7W#Y5-V~I');
define('AUTH_SALT',        '<8XqOC%9$t#/eG!=1#/YdBVFGC,1}:U#TQ*hFW*i*Kr}-Z)0{+|Bl&C=[~,lcWYf');
define('SECURE_AUTH_SALT', 'X/-K D>dbyC1H094cNt*{.9AqY.*F=EVMqT~xu`HiIJ7^b<lYD7T;o]t>8*XIOO|');
define('LOGGED_IN_SALT',   '9}}4H j*fqvdQ`sbsT1^z0H+$O:l|t)X-z(2U(;4458;6~d#,CRJxf6HCuq!oi1W');
define('NONCE_SALT',       'SzD-+R<V/g#OY`Tdvp7/Ux|c(2ZOH$Ls^w>YvTD9HvGe6W0aZu*^%e/YU*Rt4evs');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/**
 * Debug Logging
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
/**
 * Disable auto-updates
 */
define( 'WP_AUTO_UPDATE_CORE', false );
/**
 * Database
 */
// SQLite
define( 'USE_MYSQL', true );
define( 'DB_DIR', $_SERVER[ 'DOCUMENT_ROOT' ] . '/data/' );
define( 'DB_FILE', 'cms.db.sqlite' );


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
