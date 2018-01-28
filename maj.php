<?php
	include('connexion.php');
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
				$datamaj=mysqli_fetch_array($repmaj);
				 echo "<h3>Votre nouveau stock est de : ".$datamaj['stock']." et le stock maximum limité à ".$datamaj['stockmax'].".</h3>";*/
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
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
		
			
		<form action="" method="POST" class="form-horizontal" role="form">
			<div class="form-group">
				<legend>Faire une action sur votre stock</legend>
				<div class="col-md-3">
					<input type="text" name="stock" class="form-control" placeholder="<?php echo $datamaj['stock']; ?>">
				</div>
			</div>
			<div>
				<p style="font-family: Verdana;">Votre stock maximum est actuellement limité à <?php //echo $datamaj['stockmax']; ?></p>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<button type="submit" class="btn btn-success" name="ajouter">Ajouter</button>
					<button type="submit" class="btn btn-warning" name="utiliser">Utiliser</button>

					<progress value="<?php echo $datamaj['stock']; ?>" max="<?php echo $datamaj['stockmax'];?>" min="0">
				</div>
			</div>
		</form>
	</div>

	</body>
</html>