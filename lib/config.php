<?php

// display all error except deprecated and notice  
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_STRICT );
// turn on output buffering 
// ob_start();

require_once("constants.php");
require_once("common_functions.php");

/*
 * turn off magic-quotes support, for runtime e, as it will cause problems if enabled
 */
if (version_compare(PHP_VERSION, 5.3, '<') && function_exists('set_magic_quotes_runtime')) set_magic_quotes_runtime(0);

// set currentPage in the local scope
$currentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

try {	
	/*mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or DIE('Connection to host is failed, perhaps the service is down!');	
	mysql_select_db(DB_DATABASE) or DIE('Database name is not available!'); */
	
	$db_conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	// $db_conn->query("SET time_zone='+05:30'");
	
	// Check connection
	if (mysqli_connect_error()) {
		die("Database connection failed: " . mysqli_connect_error());
	}
} catch (Exception $ex) {
    echo errorMessage($ex->getMessage());
	$db_conn->close();
    die;
}

// $output = ob_get_contents();
// ob_end_clean();

?>