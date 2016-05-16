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
include_once '../model/Rang.php';
?>

</head>
<?php

if (isset ( $_POST ['rang'] )) {
	$rang = htmlspecialchars ( $_POST ['rang'] );
	$query = "update rang set Rang = '" . $rang . "' where id = " . $id . ";";
	$conn->query ( $query );
	if ($conn->query ( $query )) {
		header ( "Location: ../rang.php?action=save" );
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
			<h2>Rang bearbeiten</h2>
		</div>
		<div class="row container">
			
					<?php
					$query = "select id, rang from rang where id = " . $id . ";";
					$result = $conn->query ( $query );
					$rang = new Rang ();
					while ( $res = $result->fetch_assoc () ) {
						$rang->setId($res['id']);
						$rang->setRang($res['rang']);
					}
					?>
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php echo $message; ?>
				<div class="form-group">
				<input class="form-control" type="hidden" name="id" value="<?php echo $id; ?>">
					<label for="inputSize">Rang</label> <input type="text"
						class="form-control" name="rang" id="inputRang"
						placeholder="Rang" value="<?php echo $rang->getRang(); ?>">
				</div>
				<button type="submit" class="btn btn-default">Speichern</button> <a href="../rang.php" class="cancel"> Abbrechen</a>
			</form>
		</div>

	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>