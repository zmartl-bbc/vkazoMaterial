<html>
<head>
<?php
include_once 'resources/head.php';
include_once 'includes/database.php';
?>

</head>
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
			<h2>Benutzer haben Materialien</h2>
			<a href="#" class="btn btn-warning">Hinzuf&uuml;gen</a>
		</div>
		<div class="row container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="col-md-3">K&uuml;rzel</th>
						<th class="col-md-5">Material</th>
						<th class="col-md-3">Erhalten am</th>
						<th class="col-md-1">Aktion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT uhm.id, uhm.UserID, m.Bezeichnung, uhm.Erhalten FROM userhasmaterial uhm  join material m on uhm.ID = m.ID;";
					$result = $conn->query ( $query );
					
					while ( $res = $result->fetch_assoc () ) {
						echo '<tr>';
						echo '<td>' . $res ['UserID'] . '</td>';
						echo '<td>' . $res ['Bezeichnung'] . '</td>';
						echo '<td>' . $res ['Erhalten'] . '</td>';
						echo '<td class="text-right"><a href="material.edit.php?id=' . $res ['id'] . '"><i class="fa fa-pencil"></i></a> <a href="material.delete.php"><i class="fa fa-trash"></i></a></td>';
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