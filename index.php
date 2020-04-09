
<?php include("header.php");?>

<?php

try{
		$link = new PDO('mysql:host=localhost:3306;dbname='','', '');
	} catch(PDOExecption $e) {
		print "Erreur !: ".$e->getMessage()."<br />";
		die();
	}

?>
<!-- formulaire recherche -->
<div class="container-formulaire-recherche">
	<div class="formulaire-recherche">
		<form method="POST">
			REFERENCE OPERATEUR OU NOM: <input type="text" name="q"><br>
			<input type="submit" value="RECHERCHE" class="boutton-recherche">
		</form>
	</div>
</div>

<?php
//connection a la bdd puis insertion des données
$error_complete = 0;
if(isset($_POST['send'])){

try{
		$link = new PDO('mysql:host=localhost:3306;dbname=','', '');
	} catch(PDOExecption $e) {
		print "Erreur !: ".$e->getMessage()."<br />";
		die();
	}
		$sql = "INSERT INTO formulaire (REFORANGE, DMZ, IPPUBLIQUE, PARTENAIRE) VALUES (:REFORANGE, :DMZ, :IPPUBLIQUE, :PARTENAIRE);";
				$stmt = $link->prepare($sql);
   				$stmt->execute(array(
   				"REFORANGE"  => $_POST['REFORANGE'],
    			"DMZ"  => $_POST['DMZ'],
    			"IPPUBLIQUE"     => $_POST['IPPUBLIQUE'],
    			"PARTENAIRE"  => $_POST['PARTENAIRE'],));
}
?>
<!-- formulaire pour laisser des commentaire en focntion de la ref orange  -->

<div class="formulaire-commentaire">
	<form action="" method="POST">
	<p>
		<div class="input-group input-group-sm mb-3">
  			<div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">REF-ORANGE</span>
  </div>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="REFORANGE"name="REFORANGE" >
</div>
	</p>
	<p>
		<div class="input-group input-group-sm mb-3">
  			<div class="input-group-prepend">
   				<span class="input-group-text" id="inputGroup-sizing-sm">DMZ</span>
 			</div>
  				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="DMZ" name="DMZ" >
		</div>
	</p>
	<p>
		<div class="input-group input-group-sm mb-3">
  			<div class="input-group-prepend">
   				<span class="input-group-text" id="inputGroup-sizing-sm">IP-PUBLIQUE</span>
 			</div>
  				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="IPPUBLIQUE" name="IPPUBLIQUE" >
		</div>
	</p>
	<p>
		<div class="input-group input-group-sm mb-3">
  			<div class="input-group-prepend">
   				<span class="input-group-text" id="inputGroup-sizing-sm">PARTENAIRE</span>
 			</div>
  				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="PARTENAIRE" name="PARTENAIRE" >
		</div>
	</p>
	<div class="boutton-ajouter">
		<p>
			<input type="submit" value="Ajouter" name="send" class="btn btn-outline-primary">
		</p>
	</div>
	</form>	
</div>


<!-- affichage des resultats -->
<div class="container-resultat-recherche">
	<h1>Résultat de votre recherche :</h1>
	<?php 
		$q = isset($_POST['q']) ? $_POST['q'] : '';
		if (isset($_POST['q']) AND !empty($_POST['q'])) {

			$rep1 = "SELECT * FROM commandes_mb WHERE B LIKE '%$q%'";
			$stmt= $link->prepare($rep1);
			$stmt->execute();
			$nbr = $stmt->rowcount();
			$result = $stmt->fetchALL();
			if ($nbr > 0) { foreach ($result as $commandes_mb){ ?>
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Reference Orange</th>
							<th scope="col">Reference Opérateur</th>
							<th scope="col">Type</th>
							<th scope="col">Etat</th>
							<th scope="col">Cree le</th>
							<th scope="col">Jalon</th>
							<th scope="col">Commentaire</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $commandes_mb['A']; ?></td>
							<td><?php echo $commandes_mb['B']; ?></td>
							<td><?php echo $commandes_mb['C']; ?></td>
							<td><?php echo $commandes_mb['D']; ?></td>
							<td><?php echo $commandes_mb['E']; ?></td>
							<td><?php echo $commandes_mb['F']; ?></td>
							<td><?php echo $commandes_mb['G']; ?></td>
						</tr>
					</tbody>
				</table>
			<?php }} else {
				$rep1 = "SELECT * FROM orderexport_alliantel WHERE B LIKE '%$q%'";
				$stmt= $link->prepare($rep1);
				$stmt->execute();
				$result = $stmt->fetchAll();
				foreach ($result as $orderexport_alliantel){ ?>
				
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Reference Orange</th>
							<th scope="col">Prénom / Nom ou raison sociale</th>
							<th scope="col">Etat</th>
							<th scope="col">Créé le</th>
							<th scope="col">Dernier Jalon</th>
							<th scope="col">Date dernier Jalon</th>
							<th scope="col">AID</th>
							<th scope="col">NDS</th>
							<th scope="col">Offre</th>
							<th scope="col">Offre technique</th>
						</tr>
					</thead>
					<tbody>
						<tr>
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
						</tr>
					</tbody>
				</table>
			<?php }}} ?>
		<?php 

			$q = isset($_POST['q']) ? $_POST['q'] : '';
			if (isset($_POST['q']) AND !empty($_POST['q'])) {
				$rep2 = "SELECT * FROM formulaire NATURAL JOIN commandes_mb WHERE formulaire.REFORANGE = commandes_mb.A AND B LIKE '%$q%'";
				$stmt= $link->prepare($rep2);
				$stmt->execute();
				$result = $stmt->fetchAll();
				$nbr = $stmt->rowcount();
				if ($nbr > 0){foreach ($result as $formulaire){ ?>
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Reference Orange</th>
								<th scope="col">DMZ</th>
								<th scope="col">IP-PUBLIQUE</th>
								<th scope="col">PARTENAIRE</th>
								<th scope="col">MODIFICATION</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $formulaire['REFORANGE']; ?></td>
								<td><?php echo $formulaire['DMZ']; ?></td>
								<td><?php echo $formulaire['IPPUBLIQUE']; ?></td>
								<td><?php echo $formulaire['PARTENAIRE']; ?></td>
								<td><a class="btn btn-outline-primary btn-sm" href=update_commentaire.php?REFORANGE=<?php  echo $formulaire['REFORANGE']; ?>>Modifier</a></td>>
							</tr>
						</tbody>
					</table>
				<?php }} else {
					$rep2 = "SELECT * FROM `formulaire` NATURAL JOIN orderexport_alliantel WHERE formulaire.REFORANGE = orderexport_alliantel.A AND B LIKE '%$q%' ";
					$stmt= $link->prepare($rep2);
					$stmt->execute();
					$result = $stmt->fetchAll();
					foreach ($result as $formulaire){ ?>

					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Reference Orange</th>
								<th scope="col">DMZ</th>
								<th scope="col">IP-PUBLIQUE</th>
								<th scope="col">PARTENAIRE</th>
								<th scope="col">MODIFICATION</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $formulaire['REFORANGE']; ?></td>
								<td><?php echo $formulaire['DMZ']; ?></td>
								<td><?php echo $formulaire['IPPUBLIQUE']; ?></td>
								<td><?php echo $formulaire['PARTENAIRE']; ?></td>
								<td><a class="btn btn-outline-primary btn-sm" href=update_commentaire.php?REFORANGE=<?php  echo $formulaire['REFORANGE']; ?>>Modifier</a></td>
							</tr>
						</tbody>
					</table>

			<?php }}} ?>
</div>



<?php include("footer.php");?>
