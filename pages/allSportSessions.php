<div class="jumbotron page_layout">
    <div class="container">
        <h1>Overzicht trainingssessies</h1>
        <table class="table">
            <!-- Creates the tableheaders -->
            <tr>
                <th>Datum</th>
                <th>Begintijd</th>
                <th>Eindtijd</th>
                <th>Locatie</th>
                <th>Klant</th>
            </tr>
            <?php
            // Retreives data from database
            $sessions = Sport_session::find();

            // Displays all sessions
            foreach($sessions as $session)
            {
                echo '<tr><td>'.substr($session->getSession_start(), 0, 10).'</td>';
                echo '<td>'.substr($session->getSession_start(), 11, 5).'</td>';
                echo '<td>'.substr($session->getSession_end(), 11, 5).'</td>';
                echo '<td>'.$session->getLocation()->getName().'</td>';
                $user = $session->getUser();
                echo '<td>'.ucfirst($user->getName())." ".$user->getInsertion()." ".ucfirst($user->getLastname()).'</td></tr>';
            } ?>
        </table>
    </div>
</div>
