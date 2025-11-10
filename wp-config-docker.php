<?php
define( 'WP_CACHE', true );

/**
 * The base configuration for WordPress (Docker version)
 *
 * @package WordPress
 */

// ** Database settings - Docker environment ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('WORDPRESS_DB_NAME') ?: 'wordpress_taoism' );

/** Database username */
define( 'DB_USER', getenv('WORDPRESS_DB_USER') ?: 'wordpress_user' );

/** Database password */
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') ?: 'wordpress_pass_123' );

/** Database hostname */
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') ?: 'db:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 */
define( 'AUTH_KEY',          '@g2m0@]DgDb[L([J}GR}LF5]j%.L2dd@hsL]}UxQefz~VG!B*STN#3}k@|Mj(& R' );
define( 'SECURE_AUTH_KEY',   '*@S;![b&uIRI3}F~wcN0}o#c~; .yw/]oWInJ&3ST*t9801-1(?W*42=358G!(C^' );
define( 'LOGGED_IN_KEY',     'YwSQ>mieWTK;=PA^mLynv]J~[7Nx:36pVn)Dl2$Z.=Kz^ T-pKs,|c,pJ_zt{V|_' );
define( 'NONCE_KEY',         'kM$ %Cv|m8.96*/vN*BnGAh;vJn!qQE $L.2ZHJ2v!3<a_vJGx3!^HR9{7Rd-]4a' );
define( 'AUTH_SALT',         'ZT$.pV$Qtb$/w&OFQg+8)^]bAM%>$OOg0cZ]uW#9Z6Grpk)G])yKtV/znrd%e8Kb' );
define( 'SECURE_AUTH_SALT',  '=`srq.=aa<faP9A;!-dIfzoei&?6;5ugi.@Y#76z)jK))7sQ9m{Dl&0Cy:L<_3 v' );
define( 'LOGGED_IN_SALT',    '%z!asd8n.v~0a(w56W;7seHA9^_$,?c@8y],Brw1dmCqF|BRZ[LAcE*nRvl4.F@d' );
define( 'NONCE_SALT',        ')?);|ilHOczd1>q~%vk-OoPB,o?xGcqo(%Bkf(u{qt3j4=OVWej8pY<Otar)!a^X' );
define( 'WP_CACHE_KEY_SALT', 'LFo_ma^46xG]+8|}(!_9s O(m$!{8b.`g!!db=]bv~o1cBnmB9!J1}MI{_LVuGkg' );

/**#@-*/

/**
 * WordPress database table prefix.
 */
$table_prefix = getenv('WORDPRESS_TABLE_PREFIX') ?: 'wp_';

/* Add any custom values between this line and the "stop editing" line. */

/**
 * For developers: WordPress debugging mode.
 */
define( 'WP_DEBUG', getenv('WORDPRESS_DEBUG') === 'true' );
define( 'WP_DEBUG_LOG', WP_DEBUG );
define( 'WP_DEBUG_DISPLAY', false );

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '2216597437b1d63c200561123d29960d' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );

// 允许直接更新和安装插件/主题
define( 'FS_CHMOD_DIR', (0755 & ~umask()) );
define( 'FS_CHMOD_FILE', (0644 & ~umask()) );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


