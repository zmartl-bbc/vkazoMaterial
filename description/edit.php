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
include_once '../model/Description.php';
?>

</head>
<?php

if (isset ( $_POST ['description'] )) {
	$description = htmlspecialchars ( $_POST ['description'] );
	$selectquery = "select id from materialdescription where description = '" . $description . "'";
	
	$res = $conn->query ( $selectquery );
	
	if ($res->num_rows < 1) {
		
		$query = "update materialdescription set Description = '" . $description . "' where id = " . $id . ";";
		$conn->query ( $query );
		if ($conn->query ( $query )) {
			header ( "Location: ../description.php?action=save" );
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
			<h2>Materialbeschreibung bearbeiten</h2>
		</div>
		<div class="row container">
			
					<?php
					$query = "select id, description from materialdescription where id = " . $id . ";";
					$result = $conn->query ( $query );
					$description = new Description ();
					while ( $res = $result->fetch_assoc () ) {
						$description->setId ( $res ['id'] );
						$description->setDescription ( $res ['description'] );
					}
					?>
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php echo $message; ?>
				<div class="form-group">
					<input class="form-control" type="hidden" name="id"
						value="<?php echo $id; ?>"> <label for="inputSize">Materialbeschreibung</label> <input
						type="text" class="form-control" name="description" id="inputDescription"
						placeholder="Material Beschreibung" value="<?php echo $description->getDescription() ?>" required>
				</div>
				<button type="submit" class="btn btn-default">Speichern</button>
				<a href="../description.php" class="cancel"> Abbrechen</a>
			</form>
		</div>

	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>