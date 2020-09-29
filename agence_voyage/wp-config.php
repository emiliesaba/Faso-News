<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'voyage' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$-).*|S/.jWO L6/ &efjZ3fvS$v{6rE+AgvsDMtcLjtmE-f1@D+v|1o1eOJh7?5');
  define('SECURE_AUTH_KEY',  '(Ss.bciPI4CV+KinGl.8qE!$(JPJsGfv,gU5k`gr?0Z>giljU-/<;0Xh4b ~jcEN');
  define('LOGGED_IN_KEY',    '.WSC5WtY#~lp(C=ukTDju:Ah_Q(-&8t$B&MPKja*XG$+.vkc &m +?F3v@JZ%kr/');
  define('NONCE_KEY',        '+I|tvPx4W`)I,[$9`Pj XR 8X80tDx<7-Tl=Aix~/,eADY$baC76,+FheUy^zzZ+');
  define('AUTH_SALT',        '+_PC5xnXZ*Dl*bc[E|^ebnD{Z-^~]+rP7)-t(r3oyqWkOk.s91$4;Kt~ey> vJk#');
  define('SECURE_AUTH_SALT', '3G5nW{hRqCpjRy(V#v3+-QLxV?&~IY+iDe`XSP2KgOSj@1AwfuTJ}/-wrD,ZqDFm');
  define('LOGGED_IN_SALT',   'PzOo&o$kl;Z~+,#/1d?c*DLf1W{J?tb|}tA+Mb@m0!*Ze_FVXV.neLk-gIz|0w#d');
  define('NONCE_SALT',       '|fr|p?`))M_0B^!W{N9Ivt1*_/55%PH+69:JWD@h|Z_<M;iNI0Ax[L|`HpeOOsZM');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
