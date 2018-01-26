<div class="jumbotron page_layout">
    <div class="container">
        <h1>Mijn trainingssessies</h1>

        <!-- Creates the tableheaders -->
        <table class="table">
            <tr>
                <th>Datum</th>
                <th>Begintijd</th>
                <th>Eindtijd</th>
                <th>Locatie</th>
            </tr>
            <?php
            $sessions = Sport_session::find();
            $current = App::getUser();

            // Displays sessions where the user is the current user
            foreach($sessions as $session){
                if($current->getId() == $session->getUser()->getId()){
                    echo '<tr><td>'.substr($session->getSession_start(), 0, 10).'</td>';
                    echo '<td>'.substr($session->getSession_start(), 11, 5).'</td>';
                    echo '<td>'.substr($session->getSession_end(), 11, 5).'</td>';
                    echo '<td>'.$session->getLocation()->getName().'</td></tr>';
                }
            }
            ?>
        </table>
    </div>
</div>
