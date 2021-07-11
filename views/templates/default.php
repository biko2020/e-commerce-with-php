<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title><?php echo $title ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo BASE_URL.SP."Accueil" ?>">ElectroStore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo BASE_URL.SP."Accueil" ?>">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL.SP."produits" ?>">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL.SP."contact" ?>">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle id="dropdownMenuButton data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Categories</a>
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <?php 

                            foreach($categorie as $key => $value)
                            echo '<a class="dropdown-item" href="'.BASE_URL.SP."categorie".SP.$value["id"].'">'.$value["nom"].'</a>';

                           ?>
                              <!--   <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                              --> 
                            </div>
                        </li>
                        <a class="btn btn-outline-success my-1 my-sm-0" href="<?php echo BASE_URL.SP."panier" ?>">Panier</a>
                        
                </ul>
                <?php  if(!isset($_SESSION["customer"])): /**si l'user est connecter desactiver le boutton connexion> */?>

                    <form class="form-inline my-2 my-lg-0" action="actionconnexion" method="post">
                    <input class="form-control mr-sm-2" name="email" type="email" placeholder="votre e-mail" required>
                    <input class="form-control mr-sm-2" name="password" type="password" placeholder="votre mot de passe" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">connexion</button>
                
                    </form>
                    <a href="<?php echo BASE_URL.SP."Accueil" ?>" class="btn btn-outline-success my-2 my-sm-0" type="submit">inscription</a>
                    
                <?php  endif;?>

                <?php  if(isset($_SESSION["customer"])):?>
                    <a href="<?php echo BASE_URL.SP."Profile" ?>" class="btn btn-outline-success my-2 my-sm-0" type="submit">Profile</a>
                    <a href="<?php echo BASE_URL.SP."Deconnexion" ?>" class="btn btn-outline-success my-2 my-sm-0" type="submit">Déconnexion</a> 
                <?php  endif;?>
        </div>
</nav>
    <div class="container">
         <?php echo $content?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>