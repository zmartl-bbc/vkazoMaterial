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
include_once '../model/UserMaterial.php';
?>

</head>
<?php
if ((isset ( $_POST ['material'] )) && (isset ( $_POST ['received'] )) && (isset ( $_POST ['kuerzel'] ))) {
	$materialInput = new UserMaterial ();
	$materialInput->setMaterial ( htmlspecialchars ( $_POST ['material'] ) );
	$materialInput->setReceived ( htmlspecialchars ( $_POST ['received'] ) );
	$materialInput->setKuerzel ( htmlspecialchars ( $_POST ['kuerzel'] ) );
	
	$selectQuery = "select uhm.ID from userhasmaterial uhm join material m on uhm.MaterialId = m.Id where m.SerialNumber = '" . $materialInput->getSerialNumber () . "' and m.DescriptionId = '" . $materialInput->getMaterial () . "' and m.SizeId = '" . $materialInput->getSize () . "' and uhm.UserId = '" . $materialInput->getKuerzel () . "';";
	$res = $conn->query ( $selectQuery );
	
	if ($res->num_rows < 1) {
		
		$query = "update userhasmaterial set MaterialId = '" . $materialInput->getMaterial () . "', UserId = '" . $materialInput->getKuerzel () . "', Receive = '" . $materialInput->getReceived () . "' where id = " . $id . ";";

		$conn->query ( $query );
		if ($conn->query ( $query )) {
			header ( "Location: ../insert.php" );
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
			<h2>Materialen bearbeiten</h2>
		</div>
		<div class="row container">
			
					<?php
					$query = "SELECT uhm.UserId, md.Description, uhm.Receive, m.SerialNumber, s.Size FROM userhasmaterial uhm join material m on uhm.MaterialId = m.Id join materialdescription md on m.DescriptionId = md.Id join size s on m.SizeId = s.Id where uhm.ID = '" . $id . "';";
					$result = $conn->query ( $query );
					$material = new UserMaterial ();
					while ( $res = $result->fetch_assoc () ) {
						$material->setKuerzel ( $res ['UserId'] );
						$material->setMaterial ( $res ['Description'] );
						$material->setSize ( $res ['Size'] );
						$material->setSerialNumber ( $res ['SerialNumber'] );
						$material->setReceived ( $res ['Receive'] );
					}
					?>
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php
					
					echo $message;
					$selectQuery = "Select m.SerialNumber, s.Size, d.ID, d.Description from material m join materialdescription d on m.DescriptionId = d.Id join Size s on m.SizeId = s.Id";
					$executeRes = $conn->query ( $selectQuery );
					?>
					<div class="form-group">
					<input class="form-control" type="hidden" name="id"
						value="<?php echo $id; ?>"> <label for="inputKuerzel">K&uuml;rzel</label>
					<input type="text" class="form-control" name="kuerzel" id="kuerzel"
						placeholder="K&uuml;rzel"
						value="<?php echo $material->getKuerzel(); ?>" required>
				</div>
				<div class="form-group">
					<label for="material">Seriennummer / Beschreibung / Gr&ouml;sse</label> <select name="material"
						class="form-control" required>
					<?php
					while ( $fetch = $executeRes->fetch_assoc () ) {
						if ($fetch ['Description'] == $material->getMaterial ()) {
							echo '<option value="' . $fetch ['ID'] . '" selected>' . $fetch ['SerialNumber'] . " / " . $fetch ['Description'] . " / " . $fetch['Size'] . '</option>';
						} else {
							echo '<option value="' . $fetch ['ID'] . '">' . $fetch ['SerialNumber'] . " / " . $fetch ['Description'] . " / " . $fetch['Size'] . '</option>';
						}
					}
					
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputDate">Erhalten</label> <input type="date"
						class="form-control" name="received" id="received"
						placeholder="Erhalten am"
						value="<?php echo $material->getReceived(); ?>" required>
				</div>
				<button type="submit" class="btn btn-default">Speichern</button>
				<a href="../insert.php" class="cancel"> Abbrechen</a>
			</form>
		</div>

	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>