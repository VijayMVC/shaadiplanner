<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

	// *********************************
	// RAJA: SECURITY - STRIP TAGS IN $_GET AND $_POST FOR THE ENTIRE APPLICATION
	foreach ($_GET as $key => $value) {
		if(!is_array($value)){
			$value = strip_tags($value);
			$value = str_replace('"', '', $value);
			$value = str_replace('<', '', $value);
			$value = str_replace('>', '', $value);
			$_GET[$key] = $value;
		}
	}

	foreach ($_POST as $key => $value) {
		if(!is_array($value)){
			$value = strip_tags($value);
			$value = str_replace('<', '', $value);
			$value = str_replace('>', '', $value);
			$_POST[$key] = $value;
		}
	}

require_once __DIR__.'/public/index.php';
