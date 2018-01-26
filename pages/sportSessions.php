<div class="jumbotron">
    <div class="container">
        <h1>
            Al mijn trainingssessies
        </h1>
<?php
$sessions = Sport_session::find();
$current = App::getUser();
foreach($sessions as $session){
    if($current->getId() == $session->getUser()->getId()){
        echo $session->getSession_start().'<br>';
        echo $session->getSession_end().'<br>';
        echo $session->getLocation()->getName().'<br><br>';
    }
}


?>
    </div>
</div>
