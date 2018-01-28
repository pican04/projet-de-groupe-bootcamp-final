<?php include('connexion.php');
    $msg="";
    if (isset($_POST['btnValider'])){
        $sql= "INSERT INTO categorie (libelle) VALUES ('".$_POST['libelle']."')";
        $result=mysqli_query($link  ,$sql);
        if ($result) {
            $msg='Insertion reussie';
        }else{
            $msg=mysqli_error($link);
        }
    }
 ?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Popote</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css" >
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body class="img-responsive" style="background-color: white;" >
        <div>
            <header style="background-color: #85C630; opacity: 0.7;">
            <img src="img/LOGO POPOT.PNG" width="150" height="130" align="center"> 

            <div class="container">
                <div class="row">
                    <div class="span12">
                        <form id="custom-search-form" class="form-search form-horizontal pull-right">
                            <div class="input-append span12">
                                <input type="text" class="search-query" placeholder="Search">
                                <button type="submit" class="btn"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>          
            </header>
        </div>
        <div>
           <img src="img/ban.png" width="1349" height="400" id="bandeau-haut">
        </div>
        
        <!--<hr>-->      
        
    <section class="webmaster" >
        <div class="container">
            <div class="row">
                <div class="col-md-2" style="background-color:#85C630;">
                    <h4 align="center">RECETTES DE LA SEMAINE</h4>
                    <img src="img/timthumb (1).JPG" width="200" height="150" >
                        <button type="button" class="btn btn-default"><a href="recette.php" target="blank">Voir plus</a></button>
                    <hr>
                    <img src="img/timthumb (1).JPG" width="200" height="150" >
                </div><!-- Gestion de stock -->
                <div class="col-md-7" style="background-color: #FDD131;" style="height: 500%;">
                    <h1 align="center">GESTION DE STOCK</h1>
                        <div>
                            <?php include('condiment.php'); ?>
                        </div> 
                </div>
            </div>

                <div class="col-md-3" style="background-color:#85C630; " style="border-width: 10px;">
                    <?php include('index.php');
                    ?>
                    <hr>
                    <h4>LEGUME EN SAISON</h4>
                    <img src="img/peppers-731653__340.jpg" width="150" height="130">
                    <p>Le piment "sent bon",originaire de zouan hounien</p>
                </div>
            </div>
        </div>
    </section>
    </body>
</html>