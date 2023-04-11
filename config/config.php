<?php
date_default_timezone_set('America/Montreal');

define("BASE_URL", "http://localhost/lasalle/final");

define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DBNAME", "kidsGames");


$headers = @get_headers(BASE_URL . "/css/bootstrap.min.css");
if($headers && strpos( $headers[0], '200')) {

} else {
    header("Location: error.php");
}