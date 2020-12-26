<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'blog');

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if ($mysqli->connect_error) {
    die('Connection fail to mysql ' . $mysqli->connect_error);
}