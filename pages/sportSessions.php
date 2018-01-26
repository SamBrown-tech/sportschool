<?php

$locations = Location::find();
foreach($locations as $location){
    echo $location->getSession_start();
}

?>
