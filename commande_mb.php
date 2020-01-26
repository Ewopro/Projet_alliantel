<?php

try {
    $link = new PDO('mysql:host=localhost;dbname=alliantel',
	'root', '');
	$sql = "SELECT*FROM commandes_mb ORDER BY A" ;
	$stmt = $link->prepare($sql);
	$stmt-> execute();
	$result = $stmt->fetchall();
} 
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br>";
    die();
}
?>
<?php include("header.php");?>
	<div class="container-client text-center">
		<h1>Tableau commandes Nb</h1>
		<table class="table table-dark">
			<thead>
				<tr>
					<th>Ref Orange</th>
					<th>Ref Opérateur</th>
					<th>Type</th>
					<th>Etat</th>
					<th>Créé le</th>
					<th>Jalon</th>
					<th>Commentaire</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $commandes_mb) {?>
					<tr>
						<td><?php echo $commandes_mb['A']; ?></td>
						<td><?php echo $commandes_mb['B']; ?></td>
						<td><?php echo $commandes_mb['C']; ?></td>
						<td><?php echo $commandes_mb['D']; ?></td>
						<td><?php echo $commandes_mb['E']; ?></td>
						<td><?php echo $commandes_mb['F']; ?></td>
						<td><?php echo $commandes_mb['G']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include("footer.php");?>