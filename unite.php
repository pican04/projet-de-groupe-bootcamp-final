<?php
	include('connexion.php');

	if (isset($_GET['id'])) {
		$sql="SELECT * FROM unites WHERE id=".$_GET['id'];
		$up=mysqli_query($link, $sql);
		$dataU=mysqli_fetch_array($up);
	}
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Unités de mesure</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<h1 class="text-center">unites</h1>
		<div class="container">
			<form action="" method="POST" role="form">
				<legend>Nouvelle unité de mesure</legend>
			
				<div class="form-group">
					<label for="" class="col-md-3">Unité</label>
					<div class="col-md-8">
						<input type="text" name="libelle" class="form-control" id="" placeholder="unité" value="<?php if(isset($_GET['id'])) echo $dataU['libelle']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3">Abréviation</label>
					<div class="col-md-8">
						<input type="text" name="abreviation" class="form-control" id="" placeholder="brève abreviation du contenu de la categorie" value="<?php if(isset($_GET['id'])) echo $dataU['abreviation']; ?>">
					</div>
				</div>
				<div>
					<button type="submit" name="ajouter" class="btn btn-primary btn-block">Enregistrer</button>
				</div>
				
			</form>
			<?php
				if (isset($_POST['ajouter'])) {
					if (isset($_GET['id'])) {
						$sql="UPDATE unites SET libelle='".mysqli_real_escape_string($link, $_POST['libelle'])."', abreviation='".mysqli_real_escape_string($link, $_POST['abreviation'])."' WHERE id=".$_GET['id'];
					}else{
						$sql="INSERT INTO unites (libelle, abreviation) VALUES ('".mysqli_real_escape_string($link, $_POST['libelle'])."','".mysqli_real_escape_string($link, $_POST['abreviation'])."')";
					}
					$rep=mysqli_query($link, $sql);
					if ($rep) {
						echo "Modification effectuée";
					}else{
						echo mysqli_error($link);
					}
				}
			?>
			<div class="row">
				<h2>Unités de mesure</h2>
				<?php 
				$n=1;
					$list="SELECT * FROM unites";
					$reponse=mysqli_query($link, $list);
					while ($data=mysqli_fetch_array($reponse)) {
				?>
				<h3><?php echo $data['libelle']." : ".$data['abreviation']; ?></h3><a href="?id=<?php echo $data['id']; ?>">Modifier</a>
				<?php
						$n++;
					}
				?>
			</div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>