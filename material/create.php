<?php
$message = "";
?>
<html>
<head>
<?php
include_once '../resources/head.php';
include_once '../includes/database.php';
include_once '../model/Material.php';
?>

</head>
<?php

if ((isset ( $_POST ['serialNumber'] )) && (isset ( $_POST ['description'] )) && (isset ( $_POST ['size'] ))) {
	$insertMaterial = new Material ();
	
	$insertMaterial->setSerialNumber ( htmlspecialchars ( $_POST ['serialNumber'] ) );
	$insertMaterial->setDescription ( htmlspecialchars ( $_POST ['description'] ) );
	$insertMaterial->setSize ( htmlspecialchars ( $_POST ['size'] ) );
	
	$selectQuery = "select m.ID from material m where m.SerialNumber = '" . $insertMaterial->getSerialNumber () . "' and m.DescriptionId = '" . $insertMaterial->getDescription () . "' and m.SizeId = '" . $insertMaterial->getSize () . "';";
	$res = $conn->query ( $selectQuery );
	
	if ($res->num_rows < 1) {
		
		$query = "insert into material (SerialNumber, DescriptionId, SizeId) values ('" . $insertMaterial->getSerialNumber () . "', '" . $insertMaterial->getDescription () . "', '" . $insertMaterial->getSize () . "');";
		var_dump ( $query );
		$result = $conn->query ( $query );
		if ($result) {
			header ( "Location: ../material.php?action=create" );
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
			<h2>Material hinzuf&uuml;gen</h2>
		</div>
		<div class="row container">
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php
					
					echo $message;
					$selectQuery = "Select d.ID, d.Description from materialdescription d";
					$executeRes = $conn->query ( $selectQuery );
					?>
					<div class="form-group">
					<label for="inputSerialNumber">Seriennummer</label> <input
						type="text" class="form-control" name="serialNumber"
						id="serialNumber" placeholder="Serien Nummer" value="">
				</div>
				<div class="form-group">
					<label for="description">Beschreibung</label> <select
						name="description" class="form-control">
					<?php
					while ( $fetch = $executeRes->fetch_assoc () ) {
						echo '<option value="' . $fetch ['ID'] . '">' . $fetch ['Description'] . '</option>';
					}
					
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="rank">Gr&ouml;sse</label> <select name="size"
						class="form-control">
					<?php
					$selectRankQuery = "select ID, Size from size";
					
					$executeRes = $conn->query ( $selectRankQuery );
					while ( $fetch = $executeRes->fetch_assoc () ) {
						echo '<option value="' . $fetch ['ID'] . '">' . $fetch ['Size'] . '</option>';
					}
					
					?>
					</select>
				</div>
				<button type="submit" class="btn btn-default">Speichern</button>
				<a href="../material.php" class="cancel"> Abbrechen</a>
			</form>
		</div>

	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>