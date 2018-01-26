<?php

if(isset($_POST['username'])) {

    //Validate input!
    //Register user
    $inputUser = htmlspecialchars($_POST['username']);
    $inputPass = htmlspecialchars($_POST['password']);
    $user = User::login($inputUser, $inputPass);

    if($user) {
        App::redirect("home");
    } else {
        App::addError("invalid combination");
        App::refresh();
    }
}
?>
<div class="container">
    <h1>
        LOGIN
    </h1>
    <form action="?page=login" method="POST">

        <input type="text" placeholder="Username" required name="username"/><br/>
        <input type="password" placeholder="Password" required name="password"/><br/>

        <input type="submit" value="Login"/>
    </form>

</div>
