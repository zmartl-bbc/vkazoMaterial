<?php
$message = "";
?>
<html>
<head>
<?php
include_once '../resources/head.php';
include_once '../includes/database.php';
include_once '../model/User.php';
?>

</head>
<?php

if ((isset ( $_POST ['kuerzel'] )) && (isset ( $_POST ['surname'] )) && (isset ( $_POST ['name'] )) && (isset ( $_POST ['rank'] ))) {
	$insertUser = new User ();
	$insertUser->setKuerzel ( htmlspecialchars ( $_POST ['kuerzel'] ) );
	$insertUser->setVorname ( htmlspecialchars ( $_POST ['surname'] ) );
	$insertUser->setNachname ( htmlspecialchars ( $_POST ['name'] ) );
	$insertUser->setRangId ( htmlspecialchars ( $_POST ['rank'] ) );
	
	$selectquery = "select rank from user where id = '" . $insertUser->getKuerzel () . "'";
	$res = $conn->query ( $selectquery );
	
	if ($res->num_rows < 1) {
		
		$query = "insert into user (id, surname, name, rankId) values ('" . $insertUser->getKuerzel () . "', '" . $insertUser->getVorname () . "', '" . $insertUser->getNachname () . "', '" . $insertUser->getRangId () . "');";
		$result = $conn->query ( $query );
		if ($result) {
			header ( "Location: ../user.php?action=create" );
		} else {
			?>
		<div class="alert alert-danger fade in alert-custom">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><i class="fa fa-exclamation-circle"></i> Achtung!</strong> <br />
	Der Datensatz konnte nicht ge&auml;ndert werden.
</div>
		<?php
		}
	} else {
		?>
		<div class="alert alert-warning fade in alert-custom"
	id="alertSuccessMessage">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		Datensatz schon vorhanden</strong> <br /> Der Datensatz ist schon
	vorhanden.
</div>
		<?php
	}
}
?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img src="../images/logo.jpg" alt="logo">
			</div>
			<div class="col-md-8">
				<h1>Materialverwaltung VKAZO</h1>
			</div>
		</div>
<?php
include_once '../resources/undernavigation.php';
?>
<div class="container">
			<h2>Benutzer bearbeiten</h2>
		</div>
		<div class="row container">
<?php
$selectRankQuery = "select ID, Rank from rank";

$executeRes = $conn->query ( $selectRankQuery );
?>
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php echo $message; ?>
				<div class="form-group">
					<label for="inputKuerzel">K&uuml;rzel</label> <input type="text"
						class="form-control" name="kuerzel" id="inputkuerzel"
						placeholder="K&uuml;erzel"
						value="" required>
				</div>
				<div class="form-group">
					<label for="inputVorname">Vorname</label> <input type="text"
						class="form-control" name="surname" id="inputvorname"
						placeholder="Vorname" value="" required>
				</div>
				<div class="form-group">
					<label for="inputNachname">Nachname</label> <input type="text"
						class="form-control" name="name" id="inputnachname"
						placeholder="Nachname" value="" required>
				</div>
				<div class="form-group">
					<label for="rank">Rang</label> <select name="rank"
						class="form-control" required>
					<?php
					while ( $fetch = $executeRes->fetch_assoc () ) {
						echo '<option value="' . $fetch ['ID'] . '">' . $fetch ['Rank'] . '</option>';
					}
					
					?>
					</select>
				</div>
				<button type="submit" class="btn btn-default">Speichern</button>
				<a href="../user.php" class="cancel"> Abbrechen</a>
			</form>
		</div>

	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>