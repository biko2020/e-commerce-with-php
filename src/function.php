<?php 

function displayAccueil(){
    $result = '<h1> Bienvenu a l\'accueil</h1>';

    $result .='<div class="bg-white shadow-sm rounded p-6">
    <form class="" action="actionInscription" method="post">
      <div class="mb-4">
        <h2 class="h4">INSCRIPTION</h2>
      </div>

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="text" name="pseudo" class="form-control " value="BRAHIM" required="" placeholder="Entrer votre Pseudo" aria-label="Entrer votre Pseudo">
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="email" class="form-control " name="email" value="brahimlion38@gmail.com" required="" placeholder="Entrez votre adresse email" aria-label="Entrez votre adresse email">
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="password" class="form-control " name="password" value="ok2020" required="" placeholder="Entrez votre mot de passe" aria-label="Entrez votre mot de passe">
        </div>
      </div>
      <!-- End Input -->

      <button type="submit" class="btn btn-block btn-primary">S\'inscrire</button>
    </form>
  </div>';

    return $result;
}

function displayActionInscription(){
  //print_r($_REQUEST);exit();
  global $data;

  $nom = $_REQUEST["pseudo"];
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  
  $data = $data->createUsers($nom,$email,$password);
  if($data){ 

    $data_customer = $data->session($email,$password);

    if($data_customer){
      $_SESSION["customer"] = $data_customer;
      return '<p class="btn btn-success btn-block">Inscription réussie '.$pseudo.', Vous êtes bien connecté</p>';
    }
  }else{ // inscription échouée
    return '<p class=" btn btn-danger btn-block">inscription échouée</p>';
  }

}

function displayActionconnexion(){
  global $data;


  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  $data_customer = $data->session($email,$password);
  if($data){ 

    $data_customer = $data->session($email,$password);

    if($data_customer){
      $_SESSION["customer"] = $data_customer;
      return '<p class="btn btn-success btn-block">Inscription réussie , Vous êtes bien connecté</p>';
    }
  }else{ // inscription échouée
      return '<p class=" btn btn-danger btn-block">inscription échouée</p>'.displayProduits();
    }
  
}

function displayProfile(){

return "<p>Mon profile</p>";

}

function displayDeconnexion() {

  unset($_SESSION["customer"]);
  return '<p class="btn btn-success btn-block">Deconnexion réussie'.displayProduits();

}

function displayContact(){
    $result= '<h1> Bienvenu au contact</h1>';
    $result .='<div class="container contact">
    <h1 class="text-center">Contactez-Nous !</h1>
    <form>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail1">Nom : </label>
              <input type="email" class="form-control" id="inputEmail1" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword2">Prenom : </label>
              <input type="text" class="form-control" id="inputPassword2" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Email : </label>
            <input type="text" class="form-control" id="inputAddress" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="inputAddress2">Message : </label>
            <textarea class="form-control" row="5" col="80" required></textarea>
          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="">
              <label class="form-check-label" for="">
                Se rappeler de moi
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Envoyer</button>
        </form>';

    return $result;
}

function displayProduits() {
    global $data;
    $dataProduct = $data->getProduct();
    
    $result = '<h1> Bienvenu au Produits</h1>';
    foreach($dataProduct as $key => $value) {
        $result .='<div class="card" style="width: 18rem; display:inline-block;">
        <img src="'.BASE_URL.SP."images".SP."produit".SP.$value["image"].'" >
        <div class="card-body">
          <h5 class="card-title">'.$value["nomProduit"].'</h5>
          <p class="card-text">'.$value["description"].'</p>
          <a href="'.BASE_URL.SP."details".SP.$value["id"].'" class="btn btn-primary">Détails</a>
          <a href="'.BASE_URL.SP."panier".SP.$value["id"].'" class="btn btn-success">commander</a>

        </div>
      </div>';
    }


    return $result;
}


function displayCategorie() {
  global $data;
  global $url;
  global $categorie;

  //test if si l'utilisateur entre une faux valeur a l' URL
  if(isset($url[1]) && is_numeric($url[1]) && $url[1]>0 && $url[1] <= sizeof($categorie)) {
    $result = '<h1> Bienvenu au categorie '.$categorie[$url[1]-1]["nom"].'</h1>';
    $dataProduct = $data->getProduct(null,$url[1]);
    foreach($dataProduct as $key => $value) {
      $result .='<div class="card" style="width: 18rem; display:inline-block;">
      <img src="'.BASE_URL.SP."images".SP."produit".SP.$value["image"].'" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">'.$value["nomProduit"].'</h5>
        <p class="card-text">'.$value["description"].'</p>
        <a href="'.BASE_URL.SP."details".SP.$value["id"].'" class="btn btn-Info">Détails</a>
        <a href="'.BASE_URL.SP."panier".SP.$value["id"].'" class="btn btn-Success">commander</a>
      </div>
    </div>';
  }

 
}else {
  $result = 'Url incorrect !';
}
  return $result;

}

function displayDetails() {
  global $data;
  global $url;
  global $categorie;

  $result = '<h1> Bienvenu dans details Produits</h1>';
  $dataProduct = $data->getProduct(null,null,$url[1]);
   
  $result .='
    <div class="row details">
      <div class="col-md-5 col-12">
         <img src="'.BASE_URL.SP."images".SP."produit".SP.$dataProduct[0]["image"].'" class="card-img-top" alt="...">
      </div>
      <div class="col-md-7 col-12">
        <h2>'.$dataProduct[0]["nomProduit"].'</p>
        <p>'.$dataProduct[0]["description"].'</h2>
        <p>Categorie :'.$categorie[$dataProduct[0]["id_categorie"]-1]["nom"].'</p>
        <a href="'.BASE_URL.SP."panier".SP.$dataProduct[0]["id"].'" class="btn btn-block btn-success" >Ajouter au panier</a>
        <a href="'.BASE_URL.SP."produits".'" class="btn btn-block btn-primary" >Retour</a>

      </div>
    </div>
  ';

  return $result;

}


function  displayPanier() {
  global $data;
  global $url;

  if(isset($url[1])){
    $idProduct = $url[1];
    $dataProduct = $data->getProduct(null,null,$url[1]);
    $_SESSION["panier"][] =  $dataProduct[0];
  }

  //print_r($_SESSION);exit();
  if(!isset($_SESSION["panier"]) || sizeof($_SESSION["panier"])==0) {
   return '<h1>panier est vide !</h1>'.displayProduits();
  
  }

  $result ='<p><h5>la liste de vos Articles</h5>
      <table class="table">
      <thead class="thead-light">
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Nom Produit</th>
      <th scope="col">Description</th>
      <th scope="col">photo</th>
      <th scope="col">Prix</th>
      <th scope="col">Quantite</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>';
  $total_prix = 0;
  foreach($_SESSION["panier"] as $key => $value){
    $total_prix  += $value["prix"];
$result .='
     <tr>
     <th scope="row">'.$value["id"].'</th>
     <td>'.$value["nomProduit"].'</td>
     <td>'.$value["description"].'</td>
     <td><img src="'.BASE_URL.SP."images".SP."produit".SP.$value["image"].'" alt=".."/></td>
     <td>'.$value["prix"].'DH</td>
     <td>1</td>
     <td><a href="'.BASE_URL.SP."supprimer".SP.$key.'" class="btn btn-danger">Supprimer</a></td>
   </tr>';
  }
  $total_tva = $total_prix * TVA /100;
  $total_ttc = $total_prix + $total_tva;

  $result .='
  <tr>
  <td> </td>
  <td> </td>
  <td> </td>
  <td>Total prix(HT)</td>
  <td>'.number_format($total_prix,2).'DH</td>
  <td>1</td>
  <td></td>
</tr>';
$result .='<tr>
<td> </td>
<td> </td>
<td> </td>
<td>Taux de :'.TVA.'%</td>
<td>'.number_format($total_tva,2).'DH</td>
<td>1</td>
<td></td>
</tr>';
$result .='<tr>
<td> </td>
<td> </td>
<td> </td>
<td>Total (TTC)</td>
<td>'.number_format($total_ttc,2).'DH</td>
<td>1</td>
<td></td>
</tr>';



  $result .='</tbody>
             </table>';
             return $result;
}


function displaySupprimer(){
  global $url;
  
 if(isset($url[1]) && is_numeric($url[1])){
   $param = $url[1]; 
   unset($_SESSION["panier"][$param]);// supprimer un element du tableau
   header("Location:".BASE_URL.SP."panier");
 } 
} 
?>