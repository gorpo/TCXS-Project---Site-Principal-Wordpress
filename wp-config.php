<?php
define('WP_ALLOW_REPAIR', true);
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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'WPCACHEHOME', '/home/u923273795/domains/tcxsproject.com.br/public_html/wp-content/plugins/wp-super-cache/' );
define( 'WP_CACHE', true );
define( 'DB_NAME', "u923273795_tcxs" );

/** MySQL database username */
define( 'DB_USER', "u923273795_tcxs" );

/** MySQL database password */
define( 'DB_PASSWORD', "daimonae" );

/** MySQL hostname */
define( 'DB_HOST', "localhost" );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'n~1T]:+oL%a$)0}@|J64-$l..wxuE4EhL(QW|L;:e0Dw<%8zKJM8|`+L-:)30@Bk');
define('SECURE_AUTH_KEY',  'dJl;,Y/L>iy-.<Ho&KJ(cU2-K$U+}#urPXzJ[xRa>6^POm#$<tN?|lvK1)9h-+bb');
define('LOGGED_IN_KEY',    'N&_k &>k&S%QbcttCotM0?ACm*1+6A$J0oD8`G;,gs[3NIXKn[pAoujwgb?J--?g');
define('NONCE_KEY',        'mOw$-.r0w8NSO~!CfG/087|=Vf]O;s.ZU?]Xqrt^0~{R~zeDXO^fW<OaI6-$~!?Y');
define('AUTH_SALT',        '7o$Jfi967Nu-,|@V|P.2od(/m-6RUQ$y.Eh9}6^:@9g UQ7n.oV-+knit5XxZaeQ');
define('SECURE_AUTH_SALT', 'YUIyA8NGc3|ZP|YLjx9VO<* <oG.j%80ti/u.)-Bjvh2C; R<^9M**ocdq AIxa?');
define('LOGGED_IN_SALT',   'G|]TN%CJ)>b%`l SdxR6#t=Fhg&8wpQpD7u3y=~1W:YP_oEf:)?.opXXU)4`F&+m');
define('NONCE_SALT',       '%:Cbj.<pD9kc/g,/J9G:nIN*6+*}*|E*+R v}?#_O:y%n+m.+]5AZ^1mjWSj}R{u');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
