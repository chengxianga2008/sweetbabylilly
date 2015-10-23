<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'kees_sbl');

/** MySQL database username */
define('DB_USER', 'Juliette');

/** MySQL database password */
define('DB_PASSWORD', 'hlv6D3^8');

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
define('AUTH_KEY',         '/8/25gFLYAGX-`>7$kISS(|K7@xmycZ4Wd`emH&zA:4-gLG+3yG&^[q#1TU7|}Bb');
define('SECURE_AUTH_KEY',  'Q3/!]saJZ`V%B3f&;h2#FD[0/!9[bSpPjE`d=!_[CG)>G`RH#xl0KCVlZ?Ta}Ccj');
define('LOGGED_IN_KEY',    '|/.Q+|B88r`+HI96esui-5lv O>qD5Btj~yr,Wv0bt-iLs30az.IT-164*f2C:+a');
define('NONCE_KEY',        'A6+du/Ltu+kjeMt(CqIrEv,.-Yng)<U,>e_p:ud oi8>#Lrrn!8aLqlJov>/ww8$');
define('AUTH_SALT',        '-clYy1y$[fF2ZJhK-.LlH*2147qr[9Dpf|w]6}q6`N7xe{f=woJ:KIOr;ykRSgy,');
define('SECURE_AUTH_SALT', 'Wr-63adtVK(^qCk$Nl&-%C2Tpbwo-|n!;*=FY0M|xnbJWc[}aE-PzkH/*`doZyzq');
define('LOGGED_IN_SALT',   'B));C#hy?@DFrQu**NO-&.4w6?t@hH8@_)1FLSTzLU5B#Obb!#5C3<OOH)?8<%Uv');
define('NONCE_SALT',       '.Gw0]>8K@(6We^-K2W~M@<#9@+L3K,1z:H#o9|jf:t$9fUmP r lQp=_k._nIqj9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
