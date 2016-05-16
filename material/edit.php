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

if (isset ( $_POST ['size'] )) {
	$description = htmlspecialchars ( $_POST ['description'] );
	$groesseId = htmlspecialchars ( $_POST ['size'] );
	$select = "select s.id from size s where s.Size = '$groesseId'";
	var_dump($select);
	$resSize = $conn->query($select);
	while($getResult = $resSize->fetch_assoc()){
		$sizeId = $getResult['id'];	
	}
	$query = "update material set descriptionId = '" . $description . "', SizeId = " . $sizeId . " where id = " . $id . ";";
	var_dump ( $query );
	$conn->query ( $query );
	if ($conn->query ( $query )) {
		header ( "Location: ../size.php" );
	} else {
		?>
			<div class="alert alert-danger fade in alert-custom">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><i class="fa fa-exclamation-circle"></i> Achtung!</strong> <br />
	Der Datensatz konnte nicht ge&auml;ndert werden.
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
			<h2>Material bearbeiten</h2>
		</div>
		<div class="row container">
			
					<?php
					$query = "SELECT m.id, d.Description, s.Size FROM material m join size s on m.ID = s.ID join materialdescription d on m.DescriptionId = d.ID where m.ID = 1;";
					$result = $conn->query ( $query );
					$material = new Material ();
					while ( $res = $result->fetch_assoc () ) {
						$material->setDescription ( $res ['Description'] );
						$material->setSize ( $res ['Size'] );
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
						value="<?php echo $id; ?>"> <label for="description">Beschreibung</label>
					<select name="description" class="form-control">
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
					<label for="inputSize">Gr&ouml;sse</label> <input type="text"
						class="form-control" name="size" id="inputSize"
						placeholder="Gr&ouml;sse"
						value="<?php echo $material->getSize(); ?>">
				</div>
				<button type="submit" class="btn btn-default">Speichern</button>
				<a href="../size.php" class="cancel"> Abbrechen</a>
			</form>
		</div>

	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>