<?php
$message = "";
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
	$size = strtoupper(htmlspecialchars ( $_POST ['size'] ));
	$query = "insert into groesse (Groesse) values ('" . $size . "');";
	$result = $conn->query ( $query );
	if ($result) {
		header ( "Location: ../size.php?action=create" );
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
			<h2>Gr&ouml;sse hinzuf&uuml;gen</h2>
		</div>
		<div class="row container">
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php echo $message; ?>
				<div class="form-group">
					<input class="form-control" type="hidden" name="id"
						value=""> <label for="inputSize">Gr&ouml;sse</label>
					<input type="text" class="form-control" name="size" id="inputSize"
						placeholder="Gr&ouml;sse" value="">
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