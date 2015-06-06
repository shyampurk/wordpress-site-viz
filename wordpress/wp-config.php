<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6!Dd*!EwIl%{F_.v>Ywrdwc]9MG=*@h|q5fSuV_/)}B9Z>[qa.JUg,LlOM>XJj3{');
define('SECURE_AUTH_KEY',  '41g? N+T)2*sq-Gge,cy3- 9rfqWF16u .WDs P#ib-*g3}JnNrpl;%2/_#QR:/&');
define('LOGGED_IN_KEY',    '4gyw}g+)+kUJ5lLJJ|g[vYzDh(qr<%QLQ9KLYoaL6GmYj.k;7 df%.8PNmS;t}78');
define('NONCE_KEY',        't8#hg6D%;]`dUtVcMZ42BZ[ihv.Uzx J~F&G8V)k^5sUz?1=m~keIpJ_Q=pSi|>5');
define('AUTH_SALT',        '5K(QI,(V`cze#YP9,Ry`dBUPcji;dIsb)kEHC:r)p~y1&9=vYO%g+z9o~u}N|NIS');
define('SECURE_AUTH_SALT', 'D&8}:7*)A/$:O/Qs%{$Yr~SUC{y7$t]#uig&@.jv6x)`KpXUvu4uxk(5mzR1D]hT');
define('LOGGED_IN_SALT',   ')nKc((-+s]F4V6L8$irN:Dc Y?(FHlwpc;j#iW/4$S[6=2csAHJh+WI`pmTqD3[Q');
define('NONCE_SALT',       '+s0fCCR[9IqpiXkcp_58:D7j=w}W/; ~.FDrv]BIoNTMBg84(Uwa/=ZiKpnBoEF_');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
