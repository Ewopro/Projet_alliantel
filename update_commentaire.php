<?php

try{
	$link = new PDO('mysql:host=localhost:3306;dbname=','', '');
} catch(PDOExecption $e) {
	print "Erreur !: ".$e->getMessage()."<br />";
	die();
}

// code de modification du formulaire commentaire 

if(isset($_POST['envoyer'])){
	if ($_POST['DMZ']!="" && $_POST['IPPUBLIQUE']!=""  && $_POST['PARTENAIRE']!="" ) {
		$sql = "UPDATE formulaire SET DMZ=:DMZ ,IPPUBLIQUE=:IPPUBLIQUE, PARTENAIRE=:PARTENAIRE WHERE REFORANGE=:REFORANGE;";
		
		$stmt = $link->prepare($sql);
   		$stmt->execute(array(
			'REFORANGE' 		=> $_POST['REFORANGE'],
			"DMZ"  				=> $_POST['DMZ'],
			"IPPUBLIQUE" 	 	=> $_POST['IPPUBLIQUE'],
	    	"PARTENAIRE"     	=> $_POST['PARTENAIRE'],
    	));
   		header("Location: index.php");

	}
}
	
	$sql = "SELECT * FROM formulaire WHERE 	REFORANGE = :REFORANGE;";
	$stmt= $link->prepare($sql);
	$stmt->execute(array(
			'REFORANGE' => $_GET['REFORANGE'],
	));
	$result = $stmt->fetch();
?>

<?php include("header.php");?>

<!-- formulaire modification des commentaires laisser par l'utilisateur  -->

<div class="contain">
	<h1>Modifier l'utilisateur</h1>
<form action="update_commentaire.php" method="POST">
		<input id="REFORANGE" type="hidden" name="REFORANGE" value="<?php echo $result['REFORANGE']; ?>">
	<p>
		<div class="input-group input-group-sm mb-3">
  			<div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">DMZ</span>
  </div>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="DMZ"name="DMZ"  value="<?php echo $result['DMZ']; ?>">
</div>
	</p>
	<p>
		<div class="input-group input-group-sm mb-3">
  			<div class="input-group-prepend">
   				<span class="input-group-text" id="inputGroup-sizing-sm">IPPUBLIQUE</span>
 			</div>
  				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="IPPUBLIQUE" name="IPPUBLIQUE" value="<?php echo $result['IPPUBLIQUE']; ?>" >
		</div>
	</p>
	<p>
		<div class="input-group input-group-sm mb-3">
  			<div class="input-group-prepend">
   				<span class="input-group-text" id="inputGroup-sizing-sm">PARTENAIRE</span>
 			</div>
  				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="PARTENAIRE" name="PARTENAIRE" value="<?php echo $result['PARTENAIRE']; ?>" >
		</div>
	</p>
	<p>
		<input type="submit" value="Modifier" name="envoyer" class="btn btn-outline-primary">
	</p>
	<div class="alert alert-danger" role="alert">
  		Merci de ne laisser aucun champ vide !
	</div>
</form>
</div>
<?php include("footer.php");?> 
