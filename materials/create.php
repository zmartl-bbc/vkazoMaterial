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
	$kuerzel = htmlspecialchars ( $_POST ['kuerzel'] );
	
	$selectQuery = "select uhm.ID from userhasmaterial uhm join material m on uhm.MaterialId = m.Id where m.SerialNumber = '" . $materialInput->getSerialNumber () . "' and m.DescriptionId = '" . $materialInput->getMaterial () . "' and m.SizeId = '" . $materialInput->getSize () . "' and uhm.UserId = '" . $materialInput->getKuerzel () . "';";
	$res = $conn->query ( $selectQuery );
	
	if ($res->num_rows < 1) {
		
		$query = "insert into userhasmaterial (MaterialId, UserId, Receive) values ('" . $materialInput->getMaterial () . "', '" . $materialInput->getKuerzel () . "', '" . $materialInput->getReceived () . "');";
		if ($conn->query ( $query )) {
			header ( "Location: ../insert.php?action=create" );
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
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php
					
					echo $message;
					$selectQuery = "select m.SerialNumber, s.Size, m.ID, d.Description from material m join materialdescription d on m.DescriptionId = d.Id join Size s on m.SizeId = s.Id where m.SerialNumber not in (select m.SerialNumber from userhasmaterial uhm join material m on uhm.MaterialId = m.Id)";
					$executeRes = $conn->query ( $selectQuery );
					?>
				<div class="form-group">
					<label for="material">K&uuml;rzel</label>
					<select name="kuerzel" class="form-control" required>
					<?php
					$selectquery = "select Id from user";
					$executeResult = $conn->query ( $selectquery );
					while ( $fetchRes = $executeResult->fetch_assoc () ) {
						echo '<option value="' . $fetchRes ['Id'] . '">'. $fetchRes ['Id'] . '</option>';
					}
					
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="material">Seriennummer / Beschreibung / Gr&ouml;sse</label>
					<select name="material" class="form-control" required>
						<option selected disabled>-- Option w&auml;hlen --</option>
					<?php
					while ( $fetch = $executeRes->fetch_assoc () ) {
						echo '<option value="' . $fetch ['ID'] . '">' . $fetch ['SerialNumber'] . " / " . $fetch ['Description'] . " / " . $fetch ['Size'] . '</option>';
					}
					
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputDate">Erhalten</label> <input type="date"
						class="form-control" name="received" id="received"
						placeholder="Erhalten am" value="" required>
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