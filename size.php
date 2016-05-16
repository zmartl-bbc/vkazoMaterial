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
			$id = htmlspecialchars($_GET['id']);
			$query = "delete from groesse where id = '" .$id. "';";
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
			<h2>Gr&ouml;sse</h2>
			<a href="size/create.php" class="btn btn-warning">Hinzuf&uuml;gen</a>
		</div>
		<div class="row container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="col-md-11">Gr&ouml;sse</th>
						<th class="col-md-1">Aktion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "select id, groesse from groesse;";
					$result = $conn->query ( $query );
					
					while ( $res = $result->fetch_assoc () ) {
						echo '<tr><td>' . $res ["groesse"] . '</td><td class="text-right"><a href="size/edit.php?id=' . $res ['id'] . '"><i class="fa fa-pencil"></i></a> <a href="' . $_SERVER ["PHP_SELF"] . '?action=delete&id=' . $res ['id'] . '"><i class="fa fa-trash"></i></a></td></tr>';
					}
					?>
				</tbody>
			</table>
		</div>

	</div>
	<!-- Script zone start -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript"> 
      $(document).ready( function() {
        $('#alertSuccessMessage').delay(5000).fadeOut();
      });
    </script>
	<!-- Script zone end -->
</body>
</html>