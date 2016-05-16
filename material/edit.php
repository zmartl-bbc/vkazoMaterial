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
include_once '../model/Material.php';
?>

</head>
<?php

if ((isset ( $_POST ['serialNumber'] )) && (isset ( $_POST ['description'] )) && (isset ( $_POST ['size'] ))) {
	$materialInput = new Material ();
	$materialInput->setSerialNumber ( htmlspecialchars ( $_POST ['serialNumber'] ) );
	$materialInput->setDescription ( htmlspecialchars ( $_POST ['description'] ) );
	$materialInput->setSize ( htmlspecialchars ( $_POST ['size'] ) );
	
	$selectQuery = "select m.ID from material m where m.SerialNumber = '" . $materialInput->getSerialNumber () . "' and m.DescriptionId = '" . $materialInput->getDescription () . "' and m.SizeId = '" . $materialInput->getSize () . "';";
	$res = $conn->query ( $selectQuery );
	
	if ($res->num_rows < 1) {
		
		$query = "update material set descriptionId = '" . $materialInput->getDescription() . "', SizeId = " . $materialInput->getSize() . ", SerialNumber = '" . $materialInput->getSerialNumber() . "' where id = " . $id . ";";
		$conn->query ( $query );
		if ($conn->query ( $query )) {
			header ( "Location: ../material.php" );
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
			<h2>Material bearbeiten</h2>
		</div>
		<div class="row container">
			
					<?php
					$query = "select m.ID, m.SerialNumber, d.Description, s.Size from material m join materialdescription d on m.DescriptionId = d.ID join Size s on m.SizeId = s.ID where m.ID = '" . $id . "';";
					$result = $conn->query ( $query );
					$material = new Material ();
					while ( $res = $result->fetch_assoc () ) {
						$material->setDescription ( $res ['Description'] );
						$material->setSize ( $res ['Size'] );
						$material->setSerialNumber ( $res ['SerialNumber'] );
					}
					?>
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php
					
					echo $message;
					$selectQuery = "Select d.ID, d.Description from materialdescription d";
					$executeRes = $conn->query ( $selectQuery );
					?>
					<div class="form-group">
					<input class="form-control" type="hidden" name="id"
						value="<?php echo $id; ?>"> <label for="inputSerialNumber">Seriennummer</label>
					<input type="text" class="form-control" name="serialNumber"
						id="serialNumber" placeholder="Serien Nummer"
						value="<?php echo $material->getSerialNumber(); ?>">
				</div>
				<div class="form-group">
					<label for="description">Beschreibung</label> <select
						name="description" class="form-control" required>
					<?php
					while ( $fetch = $executeRes->fetch_assoc () ) {
						if ($fetch ['Description'] == $material->getDescription ()) {
							echo '<option value="' . $fetch ['ID'] . '" selected>' . $fetch ['Description'] . '</option>';
						} else {
							echo '<option value="' . $fetch ['ID'] . '">' . $fetch ['Description'] . '</option>';
						}
					}
					
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="rank">Gr&ouml;sse</label> <select name="size"
						class="form-control" required>
					<?php
					$selectRankQuery = "select ID, Size from size";
					
					$executeRes = $conn->query ( $selectRankQuery );
					while ( $fetch = $executeRes->fetch_assoc () ) {
						if ($fetch ['Size'] == $material->getDescription ()) {
							echo '<option value="' . $fetch ['ID'] . '" selected>' . $fetch ['Size'] . '</option>';
						} else {
							echo '<option value="' . $fetch ['ID'] . '">' . $fetch ['Size'] . '</option>';
						}
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