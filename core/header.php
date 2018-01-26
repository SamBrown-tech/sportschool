<?php
//Create your menu here
?>
<nav>
    <div>
    <ul class="left">
			<li><img class="logoimg" src="logo.jpg"/></li>
		</ul>
		<ul class="left">
			<li><a href="?page=home">home</a></li>
		</ul>
        <ul class="right">
            <?php if($_SESSION['role'] == "guest") { ?>
			<li>
				<a href="?page=login">login</a>
			</li>
			<li>
				<a href="?page=register">register</a>
			</li>
            <?php } else { ?>
            <?php if($_SESSION['role'] == "user") { ?>
            <li>
				<a href="?page=graph">Sportstracking</a>
			</li>
			<?php } ?>
            <?php if($_SESSION['role'] == "admin") { ?>
			<li>
				<a href="?page=newLocation">Locatie toevoegen</a>
			</li>
            <li>
				<a href="?page=sportSessions">Sportsessies</a>
			</li>
			<?php } ?>
			<li>
				<a href="?page=account">account</a>
			</li>
			<li>
				<a href="?page=logout">logout</a>
			</li>
            <?php } ?>
        </ul>
    </div>
</nav>
