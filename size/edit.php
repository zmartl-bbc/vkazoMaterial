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
include_once '../model/Size.php';
?>

</head>
<?php

if (isset ( $_POST ['size'] )) {
	$size = htmlspecialchars ( $_POST ['size'] );
	$selectquery = "select id from size where Size = '" . $size . "'";
	
	$res = $conn->query ( $selectquery );
	
	if ($res->num_rows < 1) {
		
		$query = "update size set Size = '" . $size . "' where id = " . $id . ";";
		$conn->query ( $query );
		if ($conn->query ( $query )) {
			header ( "Location: ../size.php?action=save" );
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
			<h2>Gr&ouml;sse bearbeiten</h2>
		</div>
		<div class="row container">
			
					<?php
					$query = "select id, size from size where id = " . $id . ";";
					$result = $conn->query ( $query );
					$size = new Size ();
					while ( $res = $result->fetch_assoc () ) {
						$size->setSize ( $res ['size'] );
						$size->setId ( $res ['id'] );
					}
					?>
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php echo $message; ?>
				<div class="form-group">
					<input class="form-control" type="hidden" name="id"
						value="<?php echo $id; ?>"> <label for="inputSize">Gr&ouml;sse</label>
					<input type="text" class="form-control" name="size" id="inputSize"
						placeholder="Gr&ouml;sse" value="<?php echo $size->getSize(); ?>" required>
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