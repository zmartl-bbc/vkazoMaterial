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
			<h2>User</h2>
			<a href="#" class="btn btn-warning">Hinzuf&uuml;gen</a>
		</div>
		<div class="row container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="col-md-2">Rang</th>
						<th class="col-md-2">K&uuml;rzel</th>
						<th class="col-md-3">Vorname</th>
						<th class="col-md-4">Nachname</th>
						<th class="col-md-1">Aktion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT id, Kuerzel, Vorname, Nachname, r.Rang FROM user u join rang r on u.RangID = r.ID";
					$result = $conn->query ( $query );
					
					while ( $res = $result->fetch_assoc () ) {
						echo '<tr>';
						echo '<td>' . $res ['Rang'] . '</td>';
						echo '<td>' . $res ['Kuerzel'] . '</td>';
						echo '<td>' . $res ['Vorname'] . '</td>';
						echo '<td>' . $res ['Nachname'] . '</td>';
						echo '<td class="text-right"><a href="user/edit.php?id=' . $res ['id'] . '"><i class="fa fa-pencil"></i></a> <a href="user.delete.php"><i class="fa fa-trash"></i></a></td>';
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