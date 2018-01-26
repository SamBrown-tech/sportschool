<?php
if (!defined('PHP_VERSION_ID')) {
    $version = explode('.', PHP_VERSION);

    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}
if (PHP_VERSION_ID < 70000) {
    echo FrameworkException::message("Your PHP version is too low. Use at least PHP 7");
}
?>
<title>Sportschool Benno</title>
<link rel="stylesheet" href="assets/css/main.css"/>
<link rel="stylesheet" href="assets/css/header.css"/>
<link rel="stylesheet" href="assets/css/navbar.css"/>
<link rel="stylesheet" href="assets/css/exception.css"/>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
