<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、MySQL、テーブル接頭辞、秘密鍵、ABSPATH の設定を含みます。
 * より詳しい情報は {@link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 * wp-config.php の編集} を参照してください。MySQL の設定情報はホスティング先より入手できます。
 *
 * このファイルはインストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さず、このファイルを "wp-config.php" という名前でコピーして直接編集し値を
 * 入力してもかまいません。
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'core');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'core');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'dotcaerux');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '41x.H}_~{1s_C1FJFi# u$Vt!X@Na^,-JxYFlbpa/M>nHYi8ee!4t3W~am~o]a)+');
define('SECURE_AUTH_KEY',  '0rOH&&0]pKtvQCdG qQ2NGlIT0{T?koS=8TU|1!W*Q;M}afb`T[ .AUbrajosP[|');
define('LOGGED_IN_KEY',    'yd8I{p^H@$N:01e?7alD>Kr*F9*+c0;>9]ZO+S$*NoF%-^+WY$wQA0/@!xHA+dnt');
define('NONCE_KEY',        '~;qH%6KU!*f7sSsS<U6R0)&qJ4q$MIZzu;WtE*.+|Rv_}Z9|2upb&,WLDfK9+6D/');
define('AUTH_SALT',        'h{fJ}S//Ki?n^Ne hBU4HJu9SD@u<w%}A=Jw^4h8iW50*W>=d,A`c?K<($B-z$n^');
define('SECURE_AUTH_SALT', 'cfOETvH53$!a1+[PbZxY4%tqnZa C[>,:DA]mHb[/!T$=YW`:e5$_hc$V|<_y/fr');
define('LOGGED_IN_SALT',   'P&Vj~`^.1(@@-P<PnuO?Y]paw Jhg*3b7UM@d*{I&hlZ(EKo=b2bl{`5hsJJJ*qf');
define('NONCE_SALT',       'Sp|S6~Daapkn4@F 3Hi>4W^J!NLp62fiQ9ooY*QgE5{x#buIYL<881.9s&R@@zF>');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 */
define('WP_DEBUG', false);

#define('WP_ALLOW_MULTISITE', true);
#define('FORCE_SSL_ADMIN', true);
#define('WP_CACHE', true);

define('FS_METHOD', 'ftpext');
define('FTP_HOST', 'localhost');
define('FTP_USER', 'kusanagi');
#define('FTP_PASS', '*****');

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
