<?php

ini_set('display_errors', 1);

define('DSN', 'mysql:host=localhost;dbname=answer_poll');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

session_start();

require_once(__DIR__ . '/functions.php');