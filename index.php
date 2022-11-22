<?php
if (!(function () { // HTTPS FORWORD
    if (array_key_exists("HTTPS", $_SERVER) && 'on' === $_SERVER["HTTPS"]) {
        return true;
    }
    if (array_key_exists("SERVER_PORT", $_SERVER) && 443 === (int)$_SERVER["SERVER_PORT"]) {
        return true;
    }
    if (array_key_exists("HTTP_X_FORWARDED_SSL", $_SERVER) && 'on' === $_SERVER["HTTP_X_FORWARDED_SSL"]) {
        return true;
    }
    if (array_key_exists("HTTP_X_FORWARDED_PROTO", $_SERVER) && 'https' === $_SERVER["HTTP_X_FORWARDED_PROTO"]) {
        return true;
    }
    return false;
})()) {
	header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
	exit();
}
if (str_starts_with($_SERVER['HTTP_HOST'], "dc.")) { // Discord Redirect
	header("Location: https://discord.com/invite/umF3ndhkEP", true, 301);
	die();
}
if (!defined("IMPATH")) {
	define("IMPATH", dirname(__FILE__));
}
require_once(IMPATH.'/vendor/autoload.php');
require(IMPATH.'/system/core.php');
