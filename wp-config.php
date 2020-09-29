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
define( 'DB_NAME', 'newswp' );

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
  define('AUTH_KEY',         '3dHOM+KDH`amzP6L_/E]~PmZeOSq/^F6,(=}>k<]<~^2l9: HD){~7|r4n?;14~v');
  define('SECURE_AUTH_KEY',  '`kx#AC{:CUku<c1}@9t44T@w8l.0M^ub= h] Cl}bh7rF? q|L5g,(9i;GiN]TDM');
  define('LOGGED_IN_KEY',    '6gRH?1X(0x(b;j&4h+K`u,z4RlHU+#n:e]Z>{(N)u3NqMe3%Syrv!s=-+vVT wuF');
  define('NONCE_KEY',        'eld6|Z#8kZf:tgZ)OEI(EJf})kI-vDvkm:!>[{GO#bDzT~%Xj/M_PZ<Zo|)>E#y4');
  define('AUTH_SALT',        '{f<~$!M7#Rd~yxO;h3$ZY/s`Shv,QU|yv4uInuM{ _63Tv%a.i|PPi)NibnXNUB[');
  define('SECURE_AUTH_SALT', '7h.-u_St@TLu|6y2{!uhbW{$+&/l&XyA8t-|LcHxgTfN{g#WXPo>0zw}Ml Qd3i`');
  define('LOGGED_IN_SALT',   '%O~S-`3Kha-d24+QloMmo3[S=,UX,n@*CEtjOfAb-9*on~>*7+:^_.?K/5s}>U_q');
  define('NONCE_SALT',       '<UwN{Vtk)-lLBqpwj%l@+K!@o!-P3HFB?&Q~!A diiv/UcbaEDuT>s7[fm,,ZXRE');
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
