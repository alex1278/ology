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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ninja_ology');

/** MySQL database username */
define('DB_USER', 'ninja_ology');

/** MySQL database password */
define('DB_PASSWORD', 'alex1278');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'Qp(BeMi9b$Ebk8mk=pDVM!Mf#Kh!YeN;9%y5ik`,>NC#:ewOAQV96Q(B=KA!MA>4');
define('SECURE_AUTH_KEY',  'p_3W@| dEfBK]@/yk+A#S`mGS!_GO%K<d8w2&Am<|=Xfu3$[vNe<t7)AAuy?]`M=');
define('LOGGED_IN_KEY',    'v!TKG~O_(@12k]#jl~TIlr;n`3 XitS,0) oR8t8pi[VxPeHW${3?UCZWXo%T${]');
define('NONCE_KEY',        'NPH.)QP)]3WT]lc3}*-d{!VV 4y F+j)SmF)4B_No?OVWmrM>{kTo?RrdR 0C-F_');
define('AUTH_SALT',        'ziW:J%MGgN|udX>-<--zy(/-17At~sY,W1x(PschTy4I<$!JC5qRD9i=*+pVc#KQ');
define('SECURE_AUTH_SALT', 'j{BJ_=g3x`M<vqXrdiVVAHbMKr*J)k<7Hv8oA_5?zEqwC.pAR:n`*w0*mDMuA!N5');
define('LOGGED_IN_SALT',   'V{fYpw%:84QPh;| {!JgK%krDlhyIOBpD0)DwcUL_/,z@m3IyI~mNBC+j4y/ThAT');
define('NONCE_SALT',       'i2-z|h:wUYTk~Ih4brvn@RyQ|IF_d dQu%&o[:#!wtuo,x~BmD}9.U,^tT,N(H?I');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'qwerty13_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
