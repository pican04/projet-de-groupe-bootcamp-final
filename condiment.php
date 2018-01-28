<?php
	include('connexion.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Les condiments de votre cuisine</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	</head>
	<body>
		<h1 class="text-center">condiments</h1>
		<div class="col-md-12"><?php
			$n=1;
			$sql="SELECT * FROM categories";
			$rep=mysqli_query($link, $sql);
			while ($data=mysqli_fetch_array($rep)) {?>
				<button type="button" name="btn btn-primary"><?php echo $data['libelle']; ?></button>
			<?php
				$m=1;
				//$sql="SELECT * FROM condiments INNER JOIN categories ON id_categories=".$data['id'];
				$req_cond = " SELECT *, id, designation FROM condiments WHERE id_categories=".$data['id'];

				$repcond=mysqli_query($link, $req_cond);
				while ($datacond=mysqli_fetch_array($repcond)) {?>
					<button class="btn btn-success"><?php echo $datacond['designation']; ?></button>
					<?php
					$m++;
				}
			$n++; echo "<hr>";
			}
			?>
		</div>
		<div class="col-md-12">
			<form action="" method="POST" role="form" enctype="multipart/form-data">
				<legend>Nouveau condiment</legend>
			
				<div class="form-group">
					<label for="" class="col-md-2">Désignation</label>
					<div class="col-md-10">
						<input type="text" name="designation" class="form-control" id="" placeholder="unité" value="<?php if(isset($_GET['id'])) echo $dataU['designation']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-2">Stock max</label>
					<div class="col-md-10">
						<input type="text" name="stockmax" class="form-control" id="" placeholder="Limite maximale" value="<?php if(isset($_GET['id'])) echo $dataU['stockmax']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3">Stock disponible</label>
					<div class="col-md-9">
						<input type="text" name="stock" class="form-control" id="" placeholder="Limite maximale" value="<?php if(isset($_GET['id'])) echo $dataU['stock']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-2">Image</label>
					<div class="col-md-10">
						<input type="file" name="image" class="form-control" id="" placeholder="Limite maximale" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-2">Categories</label><div class="col-md-10">
					<select name="categorie" class="form-control"><?php
						$cat=1;
						$sql="SELECT * FROM categories";
						$rep=mysqli_query($link, $sql);
						while ($data=mysqli_fetch_array($rep)) {
						?>
							<option value="<?php echo $data['id']; ?>"><?php echo $data['libelle']; ?></option>
						<?php
						$cat++;
						}
						?>
					</select></div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-2">Unités</label>
					<div class="col-md-10">
					<select name="unite" class="form-control">
						<?php
						$cat=1;
						$sql="SELECT * FROM unites";
						$rep=mysqli_query($link, $sql);
						while ($data=mysqli_fetch_array($rep)) {
						?>
							<option value="<?php echo $data['id']; ?>"><?php echo $data['libelle']; ?></option>
						<?php
						$cat++;
						}
						?>
					</select>
					</div>
				</div>
				<div>
					<button type="submit" name="ajouter" class="btn btn-primary btn-block">Enregistrer</button>
				</div>
				
			</form>
			<?php
				if (isset($_POST['ajouter'])) {
					if (move_uploaded_file($_FILES['image']['tmp_name'], 'upload/'.$_FILES['image']['name'])){
						echo "<p>Image chargée!!!</p>";
					}
					if (isset($_GET['id'])) {//mettre à jour les informations sur un condiment
						$sql="UPDATE condiments SET designation='".mysqli_real_escape_string($link, $_POST['designation'])."', stockmax='".mysqli_real_escape_string($link, $_POST['stockmax'])."', stock='".mysqli_real_escape_string($link, $_POST['stock'])."', image='".$_FILES['image']['name']."', id_categories='".mysqli_real_escape_string($link, $_POST['categorie'])."', id_unites='".mysqli_real_escape_string($link, $_POST['unite'])."' WHERE id=".$_GET['id'];
					}else{//ajouter un condiment
						$sql="INSERT INTO condiments (designation, stockmax, stock, image, id_categories, id_unites) VALUES ('".mysqli_real_escape_string($link, $_POST['designation'])."','".mysqli_real_escape_string($link, $_POST['stockmax'])."','".mysqli_real_escape_string($link, $_POST['stock'])."','".$_FILES['image']['name']."','".mysqli_real_escape_string($link, $_POST['categorie'])."','".mysqli_real_escape_string($link, $_POST['unite'])."')";
					}
					$rep=mysqli_query($link, $sql);
					if ($rep) {
						echo "Modification effectuée";
					}else{
						echo mysqli_error($link);
					}
				}
			?>
			<div class="row"><!-- Liste des condiments -->
				<h2>Condiments de ma cuisine</h2>
				<table style="width: 100%;">
					<tr>
						<th>N° d'ordre</th>
						<th>Nom</th>
						<th>Stock</th>
						<th>Stock maximum</th>
						<th>Image</th>
						<th>Catégorie</th>
						<th>Unité</th>
						<th>Action</th>
						<th>Etat</th>
					</tr>
				<?php 
				$n=1;
					$list="SELECT o.*, c.libelle, u.abreviation FROM condiments o INNER JOIN categories c ON o.id_categories=c.id INNER JOIN unites u ON o.id_unites=u.id";
					$reponse=mysqli_query($link, $list);
					while ($data=mysqli_fetch_array($reponse)) {
				?>
					<tr>
						<td><?php echo $n; ?></td>
						<td><?php echo $data['designation']; ?></td>
						<td><?php echo $data['stock']; ?></td>
						<td><?php echo $data['stockmax']; ?></td>
						<td><img src="upload/<?php echo $data['image']; ?>" style="width: 30px; height: 30px;"></td>
						<td><?php echo $data['libelle']; ?></td>
						<td><?php echo $data['abreviation']; ?></td>
						<td><button type="button" data-toggle="modal" data-target="#maj">Mettre à jour</a></td>
						<td><progress value="<?php echo $data['stock']; ?>" max="<?php echo $data['stockmax'];?>" min="0"></td>
					</tr>
				<?php
						$n++;
					}
				?>
				</table>
			</div>
			<!-- Pop up pour mettre à jour son stock -->
			<div class="modal fade" id="maj" tabindex="-1" role="dialog" href=".id=<?php echo $data['id']; ?>" aria-labelledby="majLabel" aria-hidden="false">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="majLabel">essai</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" method="POST" class="form-horizontal" role="form">

			<?php
				if (isset($_GET['id'])) {
					$maj="SELECT * FROM condiments WHERE id=".$_GET['id'];
					$repmaj=mysqli_query($link, $maj);
					$datamaj=mysqli_fetch_array($repmaj);
				}
		if (isset($_POST['ajouter'])) {
			if (isset($_GET['id'])) {
				$maj="UPDATE condiments SET stock=stock+".$_POST['stock']." WHERE id=".$_GET['id'];
				$repmaj=mysqli_query($link, $maj);
				$datamaj=mysqli_fetch_array($repmaj);
			
			/*if ($datamaj['stock']>$datamaj['stockmax']) {
				$maj="UPDATE condiments SET stockmax='".$datamaj['stock']."'' WHERE id=".$_GET['id'];
				$repmaj=mysqli_query($link, $maj);
				$datama=mysqli_fetch_array($repmaj);
				$sql = 'SELECT * FROM condiments WHERE id='.$_GET['id'];
				$repmaj=mysqli_query($link, $sql);
				$datamaj=mysqli_fetch_array($repmaj);*/
				 echo "<h3>Votre nouveau stock est de : ".$datamaj['stock']." et le stock maximum limité à ".$datamaj['stockmax'].".</h3>";
			}
		}
		if (isset($_POST['utiliser'])) {
			if (isset($_GET['id'])) {
				$maj="UPDATE condiments SET stock=stock-".$_POST['stock']." WHERE id=".$_GET['id'];
				$repmaj=mysqli_query($link, $maj);
				$sql = 'SELECT * FROM condiments WHERE id='.$_GET['id'];
				$repmaj=mysqli_query($link, $sql);
				$datamaj=mysqli_fetch_array($repmaj);
				 echo "<h3>Votre nouveau stock est de : ".$datamaj['stock'].'</h3>';
			}
		}*/
	?>
								<div class="form-group">
									<legend>Faire une action sur votre stock</legend>
									<div class="col-md-12">
										<input type="text" name="stock" class="form-control" placeholder="<?php echo $datamaj['stock']; ?>">
									</div>
								</div>
								<!--<div>
									<p style="font-family: Verdana;">Votre stock maximum est actuellement limité à <?php //echo $datamaj['stockmax']; ?></p>
								</div>-->
								<div class="form-group">
									<div class="col-md-4">
										<progress value="<?php echo $datamaj['stock']; ?>" max="<?php echo $datamaj['stockmax'];?>" min="0">
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success" name="ajouter">Ajouter</button>
							<button type="submit" class="btn btn-warning" name="utiliser">Utiliser</button>
						</div>
				</div>
			</div>
		</div>
		<!-- jQuery -->
		<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<!--<script src="//code.jquery.com/jquery.js"></script>-->
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>