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
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do banco de dados - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wpdb' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'wp' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'wp' );

/** Nome do host do MySQL */
define( 'DB_HOST', '127.0.0.1:3307' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'rmC{:)Ara+Q;q7p<2-I69Bb<$@[a:bwgSHL~u4.n{xY.KmK7-mW_zTqAdY!:+>BM' );
define( 'SECURE_AUTH_KEY',  ' QJrNi^`,nW `B8|U0uTC|?%BzA1_^1CEocZ0VnM9}Y,t/lB}?UNo!l;F$bIaN`C' );
define( 'LOGGED_IN_KEY',    '30H(|hEq2#:7ysk<KJcCM:lFl;JS` ?I7TtpA%wY)1$h|Acr#w&1KUMk/cS_pW|H' );
define( 'NONCE_KEY',        'V9r&Fr&ftF@IQ:d;K-ShM`}-)#)eB5Zxa0qj}-Y:s.=}ucaWA#C?s0oOIV.ezZ`q' );
define( 'AUTH_SALT',        'ugAV{NUo{iv5aILZ3^HJtM.qr`k7Wf8}I)OQ{-Y$,cJ_d-6U:`-J1~/YW1rHf,_Y' );
define( 'SECURE_AUTH_SALT', 'W39DUxR#GLF=E*Pt-yP#/hkk!SlRvm7DzjtsSx%=ic}B&=ANF0|$}`w]{VYXF&TB' );
define( 'LOGGED_IN_SALT',   'xK>/J+g6/^JH7/D#9ba1AJFtS^B]i >7h6Ln8[M,2Fhootg;Fr$-SI~>]_vNt-q#' );
define( 'NONCE_SALT',       'TDqdag$.MT~(;mzX/j:Lwvng@fX?#[w7R$S^Wm1ehd;#OrX3>8/z0bQolHjV?P</' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

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

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
