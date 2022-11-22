<?php
if (!defined('SYS')) {
	define('SYS', dirname(__FILE__));
}
error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR);
define('CONTENT', SYS.'/content');
define('E', SYS.'/elements');
define('PANEL', CONTENT.'/panel');
// PAGE
if(strpos($_SERVER['REQUEST_URI'], '?')===false) { // Jeśli URI nie ma zapytania GET
	if (!isset($URI)) {  // & ustawione URI
		$URI = $_SERVER['REQUEST_URI'];
	}
} else { // Jeśli URI ma zapytanie GET
	if (!isset($URI)) {
		$URI = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));
	}
}
if (file_exists(CONTENT.$URI.'.php')) { // Plik z rozszerzeniem php
	$page = $URI.'.php';
} else if (strpos($_SERVER['REQUEST_URI'], '/service')!==false) {
	$page = '/service.php';
} else if (file_exists(CONTENT.$URI)) {
	if (!is_dir(CONTENT.$URI)) { // Inny plik
		if (pathinfo(CONTENT.$URI)['extension']!=='php') { // Sprawdza czy plik nie ma rozszerzenia php
			$page = $URI;
		} else {
			$page = '/error/404.php';
		}
	} else { // Strona główna
		if (file_exists(CONTENT.$URI.'/index.php')) { // Folder z index.php w środku
			$page = $URI.'/index.php'; 
		} else { // Error
			$page = '/error/404.php';
		}
	}
} else { // Error
	$page = '/error/404.php';
}
$mongo_db = new MongoDB\Client('mongodb://localhost:27017');
@require_once(CONTENT.$page);
