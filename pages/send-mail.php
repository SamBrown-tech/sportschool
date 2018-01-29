<div class="jumbotron page_layout">
    <div class="container">
        <?php
        if(isset($_POST['Text1'])) {

            // Sets variables with the user input
            $to = 'benno@sportschool.com';
            $subject = htmlspecialchars($_POST['subject']);

            $message = htmlspecialchars($_POST['Text1']);
            $headers = 'From: ' .$user->getEmail();

            // Sends email
            if(mail($to, $subject, $message, $headers)){
                echo '<script>window.alert("Email verstuurd");</script>';
            }
        }
        // Retreive data from database
        $user = App::getUser();
        ?>
        <!-- Email form -->
        <h1>E-mail een medewerker</h1>
        <form method="POST">
            <b>Afzender</b><br>
            <input type="text" name="email" value="<?php echo $user->getEmail();?>" readonly/><br>
            <br><b>Onderwerp</b><br>
            <input type="text" name="subject"/><br>
            <br><b>Typ hier uw mail</b><br>
            <textarea name="Text1" cols="24" rows="5"></textarea><br><br>

        	<input type="submit" value="versturen"/>
        </form>
    </div>
</div>
