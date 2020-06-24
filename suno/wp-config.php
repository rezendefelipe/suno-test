<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'suno' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'C`P^iVVkX|;K(.w1e0k_v_Pr$=;!|k*CfN> $oEL[_E:u>U9W(s5DW4riN89ZhU?');
define('SECURE_AUTH_KEY',  ' &<uvl,RJqD2;Z+*e=i5iN*]?+Jv[D`DtxKs#:kWxG9#,Y.fmv.(Ih/Cz6M.ez/4');
define('LOGGED_IN_KEY',    'bGt1SYc^v;y+lZlcUMG!{6RWgtNyJfj-&]|4T+~wqR}ybKJr4PB3yd:iojGA[3vL');
define('NONCE_KEY',        'FHg%c2t~B.u{`gU(fQVdwvwt;FJ?,AN6|2=e&Y;Q6uvaIL,7#l!o(KpgtP^e+#rC');
define('AUTH_SALT',        '#pSx*}DZ-bVX}H)QhV1Rp?7p%yXF|eV@?`PCzt3pH)j@+R(ouyPj9o+K$+kF^-kG');
define('SECURE_AUTH_SALT', 'N93v+m)?T$;!AZI%hF-.Q_-^e:6E%n`d0-3--;knW6HfV6vz !iy2U(%tRD(Qu|-');
define('LOGGED_IN_SALT',   'C[|/wlUB)ACD_--=J3jKe2t31W)hVKsunM_|H&}U+:uD=a>%!CZ~@3k3iu,~y@/8');
define('NONCE_SALT',       'q+?`4:K*2xeo}rZ-L3J@WOwW*kX|vYw ZXWiW{Tm0e*Cuh}; We^^va1]gB@,3RX');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_suno_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
