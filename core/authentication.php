<?php

$auth = [];
//==== Roles ====
//Define your roles here
$auth['guest'] = [];
$auth['user'] = [];
$auth['admin'] = [];

//==== Pages ====
//Define pages for each role. Is a user is not authenticated to visit a page
//he is automatically redirected to the first page in the list of pages he is
//allowed to visit.
array_push($auth['guest'], 'login', 'register');
array_push($auth['guest'], 'home');
array_push($auth['guest'], 'subscription');

array_push($auth['user'], 'home');
array_push($auth['user'], 'send-mail');
array_push($auth['user'], 'sportSessions', 'session');
array_push($auth['user'], 'subscription');
array_push($auth['user'], 'account', 'logout');

array_push($auth['admin'], 'home');
array_push($auth['admin'], 'newLocation', 'allLocations');
array_push($auth['admin'], 'allDevices');
array_push($auth['admin'], 'allSportSessions');
array_push($auth['admin'], 'account', 'allAccounts', 'logout');

//Determine page
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}

//Determine role
if (!isset($_SESSION['role']) || array_search($_SESSION['role'], array_keys($auth)) === false) {
    $_SESSION['role'] = 'guest';
}

//Check to see if the role can visit the requested page
if(array_search($page, $auth[$_SESSION['role']]) === false) {
    //If not, redirect him to the first page in the list
    header("location: ?page=" . $auth[$_SESSION['role']][0]);
    exit();
}
