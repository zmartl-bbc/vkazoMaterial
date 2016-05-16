<html>
<head>
<?php
include_once 'resources/head.php';
include_once 'includes/database.php';
?>

</head>
<body>
<?php
if (isset ( $_GET ['action'] )) {
	$result = $_GET ['action'];
	if ($result == 'save') {
		?>
		<div class="alert alert-success fade in alert-custom"
		id="alertSuccessMessage">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-check"></i> Datensatz ge&auml;ndert!</strong>
		<br /> Der Datensatz wurde bearbeitet.
	</div>
		<?php
	} else if ($result == 'create') {
		?>
		<div class="alert alert-success fade in alert-custom"
		id="alertSuccessMessage">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-plus"></i> Datensatz hinzugef&uuml;gt!</strong>
		<br /> Der Datensatz wurde hinzugef&uuml;gt.
	</div>
			<?php
	} else if ($result = 'delete') {
		if (isset ( $_GET ['id'] )) {
			$id = htmlspecialchars ( $_GET ['id'] );
			$query = "delete from rank where id = '" . $id . "';";
			$result = $conn->query ( $query );
			if ($result) {
				?>
				<div class="alert alert-danger fade in alert-custom"
		id="alertSuccessMessage">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-trash"></i> Datensatz gel&ouml;scht!</strong>
		<br /> Der Datensatz wurde gel&ouml;scht.
	</div>
				<?php
			} else {
				?><div class="alert alert-warning fade in alert-custom"
		id="alertSuccessMessage">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Warnung!</strong>
		<br /> Datensatz konnte nicht gel&ouml;scht werden. <br/>M&ouml;glicherweise ist er noch von einem anderen Datensatz in Gebrauch.
	</div><?php
			}
		}
	}
}
?>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img src="images/logo.jpg" alt="logo">
			</div>
			<div class="col-md-8">
				<h1>Materialverwaltung VKAZO</h1>
			</div>
		</div>
<?php
include_once 'resources/navigation.php';
?>
<div class="container">
			<h2>Rang</h2>
			<a href="rang/create.php" class="btn btn-warning">Hinzuf&uuml;gen</a>
		</div>
		<div class="row container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="col-md-11">Rang</th>
						<th class="col-md-1">Aktion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT id, rank FROM rank";
					$result = $conn->query ( $query );
					
					while ( $res = $result->fetch_assoc () ) {
						echo '<tr>';
						echo '<td>' . $res ['rank'] . '</td>';
						echo '<td class="text-right"><a href="rang/edit.php?id=' . $res ['id'] . '"><i class="fa fa-pencil"></i></a> <a href="' . $_SERVER ["PHP_SELF"] . '?action=delete&id=' . $res ['id'] . '"><i class="fa fa-trash"></i></a></td>';
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>

	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>