<html>
<head>
<?php
include_once 'resources/head.php';
include_once 'includes/database.php';
?>

</head>
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
			$id = htmlspecialchars($_GET['id']);
			$query = "delete from material where id = '" .$id. "';";
			$result = $conn->query($query);
			
			if($result){
				?>
				<div class="alert alert-danger fade in alert-custom"
		id="alertSuccessMessage">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><i class="fa fa-trash"></i> Datensatz gel&ouml;scht!</strong>
		<br /> Der Datensatz wurde gel&ouml;scht.
	</div>
				<?php 	
			}
		}
	}
}
?>
<body>
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
			<h2>Material</h2>
			<a href="material/create.php" class="btn btn-warning">Hinzuf&uuml;gen</a>
		</div>
		<div class="row container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="col-md-2">Seriennummer</th>
						<th class="col-md-5">Bezeichnung</th>
						<th class="col-md-4">Gr&ouml;sse</th>
						<th class="col-md-1 text-right">Aktion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "select m.ID, m.SerialNumber, d.Description, s.Size from material m join materialdescription d on m.DescriptionId = d.ID join Size s on m.SizeId = s.ID";
					$result = $conn->query ( $query );
					
					while ( $res = $result->fetch_assoc () ) {
						echo '<tr>';
						echo '<td>' . $res ['SerialNumber'] . '</td>';
						echo '<td>' . $res ['Description'] . '</td>';
						echo '<td>' . $res ['Size'] . '</td>';
						echo '<td class="text-right"><a href="material/edit.php?id=' . $res ['ID'] . '"><i class="fa fa-pencil"></i></a> <a href="material.delete.php"><i class="fa fa-trash"></i></a></td>';
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