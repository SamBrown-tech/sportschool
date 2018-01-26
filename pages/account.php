<?php
$user = App::getUser();
var_dump($user);
if(isset($_POST['username'])) {
    $inputUsername = htmlspecialchars($_POST['username']);
	$inputName = htmlspecialchars($_POST['name']);
    $inputInsertion = htmlspecialchars($_POST['insertion']);
    $inputLast = htmlspecialchars($_POST['lastname']);
    $inputBirth = htmlspecialchars($_POST['birthday']);
    $inputEmail = htmlspecialchars($_POST['email']);
    $inputPhone = htmlspecialchars($_POST['phone']);
    $inputStreet = htmlspecialchars($_POST['street']);
    $inputHouse_number = htmlspecialchars($_POST['house_number']);
    $inputPostal_code = htmlspecialchars($_POST['postal_code']);
    $inputIban = htmlspecialchars($_POST['iban']);

	$errors = [];
    $user->setUsername($inputUsername);
	$user->setName($inputName);
    $user->setInsertion($inputInsertion);
    $user->setLastname($inputLast);
    $user->setBirthday($inputBirth);
    $user->setEmail($inputEmail);
    $user->setPhone($inputPhone);
    $user->setStreet($inputStreet);
    $user->setHouse_number($inputHouse_number);
    $user->setPostal_code($inputPostal_code);
    $user->setIban($inputIban);
	$user->save();
	App::redirect("home");
}

?>

<div class="jumbotron">
<div class="container">
    <h1>
        Wijzig Gebruiker
    </h1>
<form method="POST">
    <input type="text" prequired name="name" value="<?php echo $user->getUsername(); ?>" readonly/><br>
    <input type="text" prequired name="name" value="<?php echo $user->getName(); ?>"/><br>
    <input type="text" prequired name="insertion" value="<?php echo $user->getInsertion(); ?>"/><br>
    <input type="text" prequired name="lastname" value="<?php echo $user->getLastname(); ?>"/><br>
    <input type="date" prequired name="birthday" value="<?php echo $user->getBirthday(); ?>"/><br>
    <input type="text" prequired name="email" value="<?php echo $user->getEmail(); ?>"/><br>
    <input type="text" prequired name="phone" value="<?php echo $user->getPhone(); ?>"/><br>
    <input type="text" prequired name="street" value="<?php echo $user->getStreet(); ?>"/><br>
    <input type="text" prequired name="house_number" value="<?php echo $user->getHouse_number(); ?>"/><br>
    <input type="text" prequired name="postal_code" value="<?php echo $user->getPostal_code(); ?>"/><br>
    <input type="text" prequired name="iban" value="<?php echo $user->getIban(); ?>"/><br>

	<input type="submit" value="Edit"/>
</form>
</div>
</div>

?>
