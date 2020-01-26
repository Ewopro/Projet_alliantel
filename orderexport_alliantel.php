<?php
// code d'affichage de la table orderexport_alliantel
try {
    $link = new PDO('mysql:host=localhost;dbname=alliantel',
	'root', '');
	$sql = "SELECT*FROM orderexport_alliantel ORDER BY A" ;
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
<!-- tableau des resulats de la requette ci-dessus -->
	<div class="classement-orderexport">
		<h1>Tableau ordrexport</h1>
		<table class="table1">
		  <thead class="thead-dark">
		    <tr>
			  <th scope="col">Ref Orange</th>
			  <th scope="col">Prénom / Nom ou raison sociale</th>
			  <th scope="col">Etat</th>
			  <th scope="col">Créé le</th>
			  <th scope="col">Dernier Jalon</th>
			  <th scope="col">Date dernier Jalon</th>
			  <th scope="col">AID</th>
			  <th scope="col">NDS</th>
			  <th scope="col">Offre</th>
			  <th scope="col">Offre technique</th>
			  <th scope="col">Adresse d’installation</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($result as $orderexport_alliantel) {?>
			    <tr class="table-dark">
					<td><?php echo $orderexport_alliantel['A']; ?></td>
					<td><?php echo $orderexport_alliantel['B']; ?></td>
					<td><?php echo $orderexport_alliantel['E']; ?></td>
					<td><?php echo $orderexport_alliantel['F']; ?></td>
					<td><?php echo $orderexport_alliantel['G']; ?></td>
					<td><?php echo $orderexport_alliantel['H']; ?></td>
					<td><?php echo $orderexport_alliantel['I']; ?></td>
					<td><?php echo $orderexport_alliantel['J']; ?></td>
					<td><?php echo $orderexport_alliantel['K']; ?></td>
					<td><?php echo $orderexport_alliantel['L']; ?></td>
					<td><?php echo $orderexport_alliantel['M']; ?></td>
			    </tr>
			<?php } ?>
		  </tbody>
		</table>
</div>

<?php include("footer.php");?>