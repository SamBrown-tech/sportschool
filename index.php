<?php

session_start();
//Include models

spl_autoload_register(function ($class_name) {
    if(file_exists('model/' . $class_name . '.php')) {
        include 'model/' . $class_name . '.php';
    }
    else{
        include 'class/' . $class_name . '.php';
    }
});

FrameworkException::errorInit();

//handle all page authentication in this file

include 'core/authentication.php';

echo "<html>";
    echo "<head>";
        include 'core/head.php';
    echo "</head>";
    echo "<body>";

        include 'core/header.php';

        include "pages/" . $page . ".php";

        include 'core/footer.php';

        App::displayErrors();

    echo "</body>";
echo "</html>";
