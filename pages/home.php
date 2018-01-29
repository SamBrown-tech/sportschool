<!-- Section for the title and redirections  -->
<div class="jumbotron text-center">
    <div class="container">
        <h1>Welkom bij Sportschool Benno</h1>
        <!-- Displays the icons -->
        <section class="row main-content-icons">
            <div class="col-sm-6">
                <a href="?page=sportSessions">
                    <div class="icon-content-container text-center">
                        <div class="icon-content-img">
                            <center><img src="assets/img/013-clipboard-1.png" alt=""></center>
                        </div>
                        <div class="icon-content-text">
                            <p>Sportstracking</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="?page=subscription">
                    <div class="icon-content-container">
                        <div class="icon-content-img">
                            <center><img src="assets/img/004-weightlifting-3.png" </center></div>
                        <div class="icon-content-text text-center">
                            <p>Word fit</p>
                        </div>
                    </div>
                </a>
            </div>
        </section>
        <!-- End Section  -->
        <!-- Displays information about the different subscriptions -->
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h3 class="display-5">Abonnementen</h3>
            <div class="container">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Studenten</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">&euro;15 <small class="text-muted">/ maand</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Zeer voordelig</li>
                                <li>Onbeperkt sporten</li>
                                <li>Ideaal voor studenten</li>
                                <li>Studentenpas verplicht</li>
                            </ul>
                            <?php if($_SESSION['role'] == "guest") { ?>
                                <a href="?page=register"><button type="button" class="btn btn-lg btn-block btn-primary">Nu inschrijven!</button></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Daluren</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">&euro;20 <small class="text-muted">/ maand</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Jaarcontract</li>
                                <li>Betaling per maand</li>
                                <li>Sporten in de daluren</li><br>
                            </ul>
                            <?php if($_SESSION['role'] == "guest") { ?>
                                <a href="?page=register"><button type="button" class="btn btn-lg btn-block btn-primary">Nu inschrijven!</button></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Onbeperkt</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">&euro;30 <small class="text-muted">/ maand</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Onbeperkt sporten</li>
                                <li>Maandelijks opzegbaar</li>
                                <li>Trainingsschema's op maat</li>
                                <li>Sport de eerste drie maanden gratis!*</li>
                            </ul>
                            <?php if($_SESSION['role'] == "guest") { ?>
                                <a href="?page=register"><button type="button" class="btn btn-lg btn-block btn-primary">Nu inschrijven!</button></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End subscriptions -->
    </div>
</div>
