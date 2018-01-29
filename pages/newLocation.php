<?php

if(isset($_POST['name'])) {

    // Sets variables with the user input
    $inputName = htmlspecialchars($_POST['name']);
    $inputDescription = htmlspecialchars($_POST['description']);
    $inputPostal = htmlspecialchars($_POST['postal_code']);
    $inputNumber = htmlspecialchars($_POST['house_number']);

	// Registers Location
	$location = Location::register($inputName, $inputDescription, $inputPostal, $inputNumber);
	if($location) {
        App::redirect("home");
    }
}
?>
<div class="jumbotron page_layout">
    <div class="container">
        <h1>Voeg een nieuwe locatie toe</h1>
        <?php
        // Displays form
        $form = Location::addLocationForm()->getHTML();
        echo $form; ?>
    </div>
</div>
