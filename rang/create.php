<?php
$message = "";
?>
<html>
<head>
<?php
include_once '../resources/head.php';
include_once '../includes/database.php';
?>

</head>
<?php

if (isset ( $_POST ['rank'] )) {
	$rank = htmlspecialchars ( $_POST ['rank'] );
	$selectquery = "select id from rank where Rank ='" . $rank . "'";
	
	$res = $conn->query ( $selectquery );
	
	if ($res->num_rows < 1) {
		
		$query = "insert into rank (Rank) values ('" . $rank . "');";
		var_dump ( $query );
		$result = $conn->query ( $query );
		if ($result) {
			header ( "Location: ../rank.php?action=create" );
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
			<h2>Rang hinzuf&uuml;gen</h2>
		</div>
		<div class="row container">
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<?php echo $message; ?>
				<div class="form-group">
					<input class="form-control" type="hidden" name="id" value=""> <label
						for="inputRang">Gr&ouml;sse</label> <input type="text"
						class="form-control" name="rank" id="inputRang" placeholder="Rang"
						value="<?php if(isset($rank)){echo $rank;}?>" required>
				</div>
				<button type="submit" class="btn btn-default">Speichern</button>
				<a href="../rank.php" class="cancel"> Abbrechen</a>
			</form>
		</div>

	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>