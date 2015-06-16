<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'ifcfilms_com');

$config_name = substr($_SERVER['SERVER_NAME'], 0, strpos($_SERVER['SERVER_NAME'], '.'));
switch ($config_name) {
	case 'local':
		$pathinfo = pathinfo(__FILE__);
		$config_file = sprintf("%s/%s.local.%s", $pathinfo['dirname'], $pathinfo['filename'], $pathinfo['extension']);
		if(file_exists($config_file)){
			include $config_file;
		}
		else{
			throw new RuntimeException(sprintf('Please create a local config file %s', $config_file));
		}
		break;
	case 'dev':
		/** MySQL hostname */
		define('DB_HOST', getenv('AMCN_DB_HOST'));

		/** MySQL database username */
		define('DB_USER', 'ifcf_www');

		/** MySQL database password */
		define('DB_PASSWORD', '');
		break;
	case 'dev2':
		/** MySQL hostname */
		define('DB_HOST', getenv('AMCN_DB_HOST'));

		/** MySQL database username */
		define('DB_USER', 'ifcf_www');

		/** MySQL database password */
		define('DB_PASSWORD', 'I.E=T&VDvt');
		break;
	case 'stage':
		/** MySQL hostname */
		define('DB_HOST', getenv('AMCN_DB_HOST'));

		/** MySQL database username */
		define('DB_USER', 'ifcf_www');

		/** MySQL database password */
		define('DB_PASSWORD', '');
		break;
	case 'www':
		/** MySQL hostname */
		define('DB_HOST', getenv('AMCN_DB_HOST'));

		/** MySQL database username */
		define('DB_USER', 'ifcf_www');

		/** MySQL database password */
		define('DB_PASSWORD', '');
		break;
	default:
		die('No database configuration for: ' . $_SERVER['SERVER_NAME']);
		break;
}

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
define('AUTH_KEY',         ' 2/rJ_vEn< R~D4H;#?%n6EFf&Tdj$wje9tl0HYJh%P.^YgEt}SEgU3IbL+AvY;`');
define('SECURE_AUTH_KEY',  '|3QM|uyJm~E$os5x%vs;Qy9GgOX~^5G,}#pM93qb?bJ>{Z~?wYbCikL#uj(ex9Tc');
define('LOGGED_IN_KEY',    '|31?4;H?#:7A[>2VOf]wnNZ08day<~AwMndU_:}wh(~+reyE)wW$-9:eb-F3=s$;');
define('NONCE_KEY',        '#=%-z@X5{%)dg1oZu$BCQ%|FGy-Ufu}5!UVgh`F@i7H~[F0xo;d$ oMTL6Bamwo`');
define('AUTH_SALT',        'j|t=+5:~F+~p]cm^{Eta(IVcnRHlo#NKx{Y:XmTx+-6H^|eawA!PC^WDeP?:sAe^');
define('SECURE_AUTH_SALT', '7/7^y;2i*a_~^ie(: e;-Bz9i+I;BKn=A^n+l4%)fS@]|.G|y4pj#iGSwBmyb][{');
define('LOGGED_IN_SALT',   'K~lJRt~ep3<fGy(=K/_Ac;QTz[ZJ%a|PJO7 H]^m%+#b)6f|aE+knf|#RCR:Nx]{');
define('NONCE_SALT',       'yr*V`[&}|8m$`TKm8EAYE??YDGRd&9/=++KY12*w$8w~r&-C{j:m-_2+eY=P_j5&');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * Apply AMC Networks Custom Config Options
 */
define('WP_CACHE', false);

// Limit the Number of Saved Revisionsdefine('WP_POST_REVISIONS', 3);
 // Specify the Autosave Interval
define('AUTOSAVE_INTERVAL', 120); // in seconds

// Set the Cookie Domain
//define('COOKIE_DOMAIN', 'www.ifcfilms.com');

// Automated Trash Cleanup
define('EMPTY_TRASH_DAYS', 7); // empty weekly

// Blog Address and Site Address
define('WP_HOME', 'http://' . $_SERVER['SERVER_NAME']); // no trailing slash
define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME']); // no trailing slash

// Override Default File Permissions
//define('FS_CHMOD_DIR', (0755 & ~ umask()));
//define('FS_CHMOD_FILE', (0644 & ~ umask()));

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
