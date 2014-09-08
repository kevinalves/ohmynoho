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
define('DB_NAME', 'comOhMy');

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
define('AUTH_KEY',         'kLHs#u&#q1| #-$>,.FlE;[_$H+9-;::@|HAV01_fJ#^qwRT8Hiwow~o(_C_4=Yn');
define('SECURE_AUTH_KEY',  'gv@@(medQO`NDNq.-iJ<@#;D{w2:_iQ4uD?x`@p%y/JjRIRh=t|Y^f7E/`j76v:>');
define('LOGGED_IN_KEY',    '=SwyTzbbN+n$&m:jClLJ|z?9re@QREq2okaBZ8;j?znFQDTgY47yv5/?5X=h{jIO');
define('NONCE_KEY',        '7[Ho.`)3L4ifVxhZQk=F9pjB`KC(|hK1`2!Wjb3_nm;s/=-:n+(lOt</8>)fX{{+');
define('AUTH_SALT',        '[lyt@+cz.pk!J-8ki}b_,_GaFJ|rt`H<`MIb>1D!|LAA5+wC)g6J@atpgHn6q;mA');
define('SECURE_AUTH_SALT', 'f,A#0wGF.8~JC,nobj#Q6[`c)+gjQ:^&.LFH8e9{`Qe}D_b@Njm0tc{Oe|iYqMe,');
define('LOGGED_IN_SALT',   '6+>;4(-Go Ycyc[UrY!/>OOtO:17qO0rxrE&=r[`6D/-R[!UtG#epE-!`b]RJM[i');
define('NONCE_SALT',       'j7+k6=`c[7q%?b:9<z4`q UU,5AHMLMB0zo(GqbRE0+.Z7)2#,}mbA$Vt|rMz^&|');

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
