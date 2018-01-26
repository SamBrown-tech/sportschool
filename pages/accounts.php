<div class="jumbotron page_layout">
    <div class="container">
        <h1>Overzicht klanten</h1>
        <table class="table">
            <tr>
                <th>Gebruikersnaam</th>
                <th>Naam</th>
                <th>Geboortedatum</th>
                <th>E-mail</th>
                <th>Telefoon</th>
                <th>Straat</th>
                <th>Huisnummer</th>
                <th>Postcode</th>
                <th>Abonnement</th>
            </tr>
            <?php
            $users = User::find();
            $customers = User::findBy('role', 'user');

            // Checks if the user is a customer and displays data in a table
            foreach($users as $user){
                if($user->getRole() == 'user'){
                    echo '<tr><td>'.$user->getUsername().'</td>';
                    echo '<td>'.ucfirst($user->getName()).' '.$user->getInsertion().' '.ucfirst($user->getLastname()).'</td>';
                    echo '<td>'.$user->getBirthday().'</td>';
                    echo '<td>'.$user->getEmail().'</td>';
                    echo '<td>'.$user->getPhone().'</td>';
                    echo '<td>'.$user->getStreet().'</td>';
                    echo '<td>'.$user->getHouse_number().'</td>';
                    echo '<td>'.$user->getPostal_code().'</td>';
                    echo '<td>'.ucfirst($user->getSubscription()->getName()).'</td></tr>';
                }
            }
            ?>
        </table>
            <?php
            echo '<h4>Er zijn momenteel ' . count($customers).' klanten.</h4>';
            ?>
    </div>
</div>
