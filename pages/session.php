<?php
// Finds the current sport_session
$id = $_GET['_id'];

// Retreives data from database
$devices = Device_session::findBy('sport_session', $id);
$session = Sport_session::findById($id); ?>

<div class="jumbotron page_layout">
    <div class="container">
        <?php
        echo '<h2>Hieronder volgt informatie over de sportsessie die u op '.substr($session->getSession_start(), 0, 10).' heeft gehad.</h2>';
        echo '<h4>U sportte tussen '.substr($session->getSession_start(), 11, 5).' uur en '.
             substr($session->getSession_end(), 11, 5).' uur in '.$session->getLocation()->getName().'.<hr><br>';
        ?>
        <table class="table">
            <!-- Creates the tableheaders -->
            <tr>
                <th>Apparaat</th>
                <th>Begintijd</th>
                <th>Eindtijd</th>
                <th>Calorieën verbrand</th>
                <th>Prestatie</th>
            </tr>
            <?php
            foreach($devices as $device){

                // Calculates the time between start and end
                $start = strtotime($device->getSession_start());
                $end = strtotime($device->getSession_end());
                $minutes = round(abs($end - $start) / 60,2);

                // Calculates the performance and calories
                $distance = $minutes * $device->getMeter_distance() / 1000; // in km
                $floors = $minutes * $device->getFloors();
                $sets = $minutes * $device->getSets();
                $calories = $minutes * $device->getSports_devices()->getCalories_per_minute();

                // Displays the table
                echo '<tr><td>'.$device->getSports_devices()->getName().'</td>';
                echo '<td>'.substr($device->getSession_start(), 0, 5).'</td>';
                echo '<td>'.substr($device->getSession_end(), 0, 5).'</td>';
                echo '<td>'.ceil($calories).'</td>';

                // Checks which option applies to this device
                if($device->getMeter_distance()) {
                    echo '<td>'.round($distance,2).' kilometer</td></tr>';
                } elseif($device->getFloors()) {
                    echo '<td>'.$floors.' etages</td></tr>';
                } elseif($device->getSets()) {
                    // ceil function always rounds up
                    echo '<td>'.ceil($sets).' sets</td></tr>';
                } else {
                    echo '<td>Onbekend</td></tr>';
                }
            } ?>
        </table>
    </div>
</div>
