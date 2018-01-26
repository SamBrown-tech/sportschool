<?php

if(isset($_POST['username'])) {

    $inputUser = htmlspecialchars($_POST['username']);
    $inputPass = htmlspecialchars($_POST['password']);
    $inputPas2 = htmlspecialchars($_POST['repeat']);
    $inputName = htmlspecialchars($_POST['name']);
    $inputInsertion = htmlspecialchars($_POST['insertion']);
    $inputLast = htmlspecialchars($_POST['lastname']);
    $inputBirth = htmlspecialchars($_POST['birthday']);
    $inputEmail = htmlspecialchars($_POST['email']);
    $inputPhone = htmlspecialchars($_POST['phone']);
    $inputStreet = htmlspecialchars($_POST['street']);
    $inputNumber = htmlspecialchars($_POST['house_number']);
    $inputPostal = htmlspecialchars($_POST['postal_code']);

    //Validate input
    $errors = [];

    if(strlen($inputPass) < 8) {
      array_push($errors, "Password should be at least 8 characters!");
    }

    if($inputPass != $inputPas2) {
      array_push($errors, "Passwords do not match!");
    }

    if(count($errors) > 0) {
      foreach($errors as $error) {
        App::addError($error);
      }
    } else {
      //Register user
      $user = User::register($inputUser, $inputPass, $inputName, $inputInsertion, $inputLast, $inputBirth, $inputEmail,
      $inputPhone, $inputStreet, $inputNumber, $inputPostal, 'user');
      if($user) {
          echo $user->getUsername();

          App::redirect("home");
      }
    }
}
?>
<div class="container">
    <h1>
        REGISTER
    </h1>

    <form action="?page=register" method="POST">

        <input type="text" placeholder="Username" required name="username"/><br/>
        <input type="password" placeholder="Password" required name="password"/><br/>
        <input type="password" placeholder="Repeat" required name="repeat"/><br/>
        <input type="text" placeholder="First name" required name="name"/><br/>
        <input type="text" placeholder="Insertion" required name="insertion"/><br/>
        <input type="text" placeholder="Last name" required name="lastname"/><br/>
        <input type="date" placeholder="Birthday" required name="birthday"/><br/>
        <input type="email" placeholder="E-mail" required name="email"/><br/>
        <input type="text" placeholder="Phone number" required name="phone"/><br/>
        <input type="text" placeholder="Street" required name="street"/><br/>
        <input type="text" placeholder="House number" required name="house_number"/><br/>
        <input type="text" placeholder="Postal code" required name="postal_code"/><br/>

        <input type="submit" value="Register"/>
    </form>

</div>
