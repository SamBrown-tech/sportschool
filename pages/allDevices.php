<div class="jumbotron page_layout">
    <div class="container">
        <h1>Overzicht apparaten</h1>

        <!-- Creates the tableheaders -->
        <table class="table">
            <tr>
                <th width="20%">Naam</th>
                <th width="10%">Maximale tijd</th>
                <th width="10%">Calorieën per minuut</th>
                <th width="60%">Omschrijving</th>
            </tr>
            <?php
            $devices = Sports_device::find();

            // Displays all sessions
            foreach($devices as $device){
                echo '<tr><td>'.$device->getName().'</td>';
                echo '<td>'.$device->getSession_max_minutes().'</td>';
                echo '<td>'.$device->getCalories_per_minute().'</td>';
                echo '<td>'.$device->getDescription().'</td></tr>';
            }
            ?>
        </table>
    </div>
</div>
