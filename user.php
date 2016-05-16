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
			<a href="user/create.php" class="btn btn-warning">Hinzuf&uuml;gen</a>
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
					$query = "SELECT u.Id, u.Surname, u.Name, r.Rank FROM user u join rank r on u.RankID = r.ID";
					$result = $conn->query ( $query );
					
					while ( $res = $result->fetch_assoc () ) {
						echo '<tr>';
						echo '<td>' . $res ['Rank'] . '</td>';
						echo '<td>' . $res ['Id'] . '</td>';
						echo '<td>' . $res ['Surname'] . '</td>';
						echo '<td>' . $res ['Name'] . '</td>';
						echo '<td class="text-right"><a href="user/edit.php?id=' . $res ['Id'] . '"><i class="fa fa-pencil"></i></a> <a href="user.delete.php"><i class="fa fa-trash"></i></a></td>';
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