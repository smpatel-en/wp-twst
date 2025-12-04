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
define("DB_NAME", "local");

/** Database username */
define("DB_USER", "root");

/** Database password */
define("DB_PASSWORD", "root");

/** Database hostname */
define("DB_HOST", "localhost");

/** Database charset to use in creating database tables. */
define("DB_CHARSET", "utf8");

/** The database collate type. Don't change this if in doubt. */
define("DB_COLLATE", "");

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
define(
    "AUTH_KEY",
    '&(7p6bmnMj%^$.64JT^#l~6MM6y{f(xjTKaP{cH?;]}!-?mF@.XMj0c;W1PCk]s.',
);
define(
    "SECURE_AUTH_KEY",
    "+i_DX740Opaf_O(D;lYsNlI@f{a%?;c#3DwEv)^HJ_Hno_^9h>ZkUKr`^MV5*SyU",
);
define(
    "LOGGED_IN_KEY",
    '<?0XxoheY l{9#R7zVw;nl[$N`Qqjs1Nuud(Hx>X--mn2)H_*+D;T>R0aC;IK#]9',
);
define(
    "NONCE_KEY",
    "!S5C1tBn3[ Ne~l1^Jix +inj7^>qMUh,L_1E,bIaBPo+^J{MT|[>`L*>0D9tT|D",
);
define(
    "AUTH_SALT",
    "qU543{_6f=%%m0Wz:RSE3_nB_7p!THX:OW:(I,a|%.kv9y:u~KHHz0*6WT{#Q}2;",
);
define(
    "SECURE_AUTH_SALT",
    "6F.8MWE6pw(HH>t2mlW9Z?at^=?jgYq9kg;5Rlw0!qqN 3kNo)(VS`idl5*<cEZp",
);
define(
    "LOGGED_IN_SALT",
    "Bmx_o.X!9isiiR7RSH.}o/#?s3e]Q7~n%48eBy,u?qp3]o-Y~!93S,~F>M2<|D>%",
);
define(
    "NONCE_SALT",
    "Sd5&Q#ek)6pljp2BIwF?yDC<IZTKik1_X0IA]Y:.iwD,D7q({Y=`V%~A.wPE1ZSP",
);
define(
    "WP_CACHE_KEY_SALT",
    ')nY5OA$Thm5Wz*D?m9y>qOwl~K=zG5xDY]$@lTm~!kJ4[Q;X${wr,8PGCIyPcC+M',
);

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = "wp_";

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
if (!defined("WP_DEBUG")) {
    define("WP_DEBUG", true);
    define("WP_DEBUG_DISPLAY", true);
    define("WP_DEBUG_LOG", true);
}

define("WP_ENVIRONMENT_TYPE", "local");
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined("ABSPATH")) {
    define("ABSPATH", __DIR__ . "/");
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . "wp-settings.php";
