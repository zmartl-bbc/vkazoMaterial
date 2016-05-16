<?php
$message = "";
if (isset ( $_GET ['id'] )) {
	$id = htmlspecialchars ( $_GET ['id'] );
} else if (isset ( $_POST ['id'] )) {
	$id = htmlspecialchars ( $_POST ['id'] );
}

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

if ((isset ( $_POST ['kuerzel'] )) && (isset ( $_POST ['vorname'] )) && (isset ( $_POST ['nachname'] )) && (isset ( $_POST ['rang'] ))) {
	$insertUser = new User ();
	$insertUser->setKuerzel ( htmlspecialchars ( $_POST ['kuerzel'] ) );
	$insertUser->setVorname ( htmlspecialchars ( $_POST ['vorname'] ) );
	$insertUser->setNachname(htmlspecialchars($_POST['nachname']));
	$insertUser->setRangId(htmlspecialchars($_POST['rang']));
	$query = "update user set Vorname = '" . $insertUser->getVorname() . "', Nachname = '" . $insertUser->getNachname() . "' where kuerzel = '" . $insertUser->getKuerzel() . "';";
	var_dump($query);
	$conn->query ( $query );
	if ($conn->query ( $query )) {
		header ( "Location: ../size.php" );
	} else {
		?>
			<div class="alert alert-danger fade in alert-custom">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-exclamation-circle"></i> Achtung!</strong> <br/> Der Datensatz konnte nicht ge&auml;ndert werden.
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
include_once '../resources/navigation.php';
?>
<div class="container">
			<h2>Benutzer bearbeiten</h2>
		</div>
		<div class="row container">
			
					<?php
					$query = "select Kuerzel, Vorname, Nachname, r.Rang from user u  join rang r on u.RangID = r.ID where Kuerzel = 'Mar'";
					$result = $conn->query ( $query );
					$user = new User ();
					while ( $res = $result->fetch_assoc () ) {
						$user->setKuerzel ( $res ['Kuerzel'] );
						$user->setVorname ( $res ['Vorname'] );
						$user->setNachname ( $res ['Nachname'] );
						$user->setRangId ( $res ['Rang'] );
					}
					?>
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php echo $message; ?>
				<div class="form-group">
					<input class="form-control" type="hidden" name="id"
						value="<?php echo $id; ?>"> <label for="inputKuerzel">K&uuml;rzel</label>
					<input type="text" class="form-control" name="kuerzel"
						id="inputkuerzel" placeholder="K&uuml;erzel"
						value="<?php echo $user->getKuerzel() ?>" readonly>
				</div>
				<div class="form-group">
					<label for="inputVorname">Vorname</label> <input type="text"
						class="form-control" name="vorname" id="inputvorname"
						placeholder="Vorname" value="<?php echo $user->getVorname(); ?>">
				</div>
				<div class="form-group">
					<label for="inputNachname">Nachname</label> <input type="text"
						class="form-control" name="nachname" id="inputnachname"
						placeholder="Nachname" value="<?php echo $user->getNachname() ?>">
				</div>
				<div class="form-group">
					<label for="inputNachname">Rang</label> <input type="text"
						class="form-control" name="rang" id="inputrang" placeholder="Rang"
						value="<?php echo $user->getRangId() ?>">
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