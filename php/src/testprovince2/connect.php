<?php

$info = array(
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'thereds',
    'dbname' => 'db_thaiprovin'
);


$conn = mysqli_connect($info['host'], $info['user'], $info['password'], $info['dbname']) or die('Error connection database!');
mysqli_set_charset($conn, 'utf8');