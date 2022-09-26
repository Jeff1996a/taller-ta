<?php

	/**
 	* Constantes para la base de datos
 	*/
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	define('DB_HOST', $url["host"]);
	define('DB_USER', $url["user"]);
	define('DB_PASSWORD', $url["pass"]);
	define('DB_DATABASE_NAME', substr($url["path"],1));
	define('DB_CHARSET', 'UTF8');
	
	/**
 	* Constantes de nombres de archivos
 	*/
	define('PAGINA_ERROR', 'error_page.php');
