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
    $inputIban = htmlspecialchars($_POST['iban']);
    $inputSub = htmlspecialchars($_POST['subscription']);

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
      $inputPhone, $inputStreet, $inputNumber, $inputPostal, 'user', $inputIban, $inputSub);
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

        <input class="float-left" type="text" placeholder="Username" required name="username"/><br><br>
        <input class="float-left" type="password" placeholder="Password" required name="password"/><br><br>
        <input class="float-left" type="password" placeholder="Repeat" required name="repeat"/><br><br>
        <input class="float-left" type="text" placeholder="First name" required name="name"/><br><br>   
        <input class="float-left" type="text" placeholder="Insertion" required name="insertion"/><br><br>
        <input class="float-left" type="text" placeholder="Last name" required name="lastname"/><br><br>
        <input class="float-left" type="date" placeholder="Birthday" required name="birthday"/><br><br>
        <input class="float-left" type="email" placeholder="E-mail" required name="email"/><br><br>
        <input class="float-left" type="text" placeholder="Phone number" required name="phone"/><br><br>
        <input class="float-left" type="text" placeholder="Street" required name="street"/><br><br>
        <input class="float-left" type="text" placeholder="House number" required name="house_number"/><br><br>
        <input class="float-left" type="text" placeholder="Postal code" required name="postal_code"/><br><br>
        <input class="float-left" type="text" placeholder="Iban number" required name="iban"/><br><br>
        <select class="float-left" required name="subscription">
            <?php
            $subscriptions = Subscription::find();
            foreach ($subscriptions as $subscription){
                echo "<option value=". $subscription->getId() .">". $subscription->getName() ."</option>";
            }
            ?>
        </select>*kies uw abonnement<br><br>

        <input type="submit" value="Register"/>
    </form>

</div>
