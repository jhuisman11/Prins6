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
define('DB_NAME', 'prins6');

/** MySQL database username */
define('DB_USER', 'prins6DB');

/** MySQL database password */
define('DB_PASSWORD', 'prins6Admin');

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
define('AUTH_KEY',         ')mSED@Nc[DmbQ$-N*%^K5x&;V2=D<.c{f*+BK#~tCI4JKDb5oQ8GtU?2J eI;J,|');
define('SECURE_AUTH_KEY',  '5qc4DdN4i$G&o*`-8.x%j)x`r<o1kE@7>en^ 5aV@e3-FuHjbzsz9{IA_}bp@A%X');
define('LOGGED_IN_KEY',    '<#W5@!)~|8Y[rr-LC(ou%%nu@~Fc,bpn]t6O3_knmIWy-cpa0(z]%$GHocByT*m(');
define('NONCE_KEY',        'E),<,c>&jR#tE!@xa$wi:JCFD*uhHtOaP^NE`ieD-_9oKM!~3)~l1e=o4Z=cs8}m');
define('AUTH_SALT',        'h-!)y25NawL90_`X=`)53R;m#YCE5@kK1Z|kD[RG!~aFyq0SPf<u6cfWyDZ/DEjc');
define('SECURE_AUTH_SALT', '?)p`{w~G`:C%EhYn]LgyK?) @A~gRcXsb0CG 7e(jATlM1Pu}l&y`h=8V,K`e,er');
define('LOGGED_IN_SALT',   'uH8qZD$mP/Yq_z5Gq*c tObHmlV.W=x}%G2prm>4k-0.0fkc+Nn_Y6QDcReGd|};');
define('NONCE_SALT',       '3F!M]V1)W.EZ:hk-^FY&mdYCbaO;XZSl7,Z/NVrdscdI(axo#z3}4b#{^edDAT_,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
