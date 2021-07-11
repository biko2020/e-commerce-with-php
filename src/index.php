<?php
session_start();
require "include.php";

$url = trim($_SERVER['PATH_INFO'],'/');
$url = explode('/',$url); //transformer URL a un tableau
$route = array("Accueil", "produits", "contact", "categorie","details","panier",
"supprimer","actionInscription","Profile","Deconnexion","actionconnexion");



$action = $url[0];

// controleur

if(!in_array($action, $route)){
   
    $title =  "Page Erreur ";
    $content = "Page non trouver !";
} else {
    
    // fonction qui fait appel a l'action demande par l'utilisateur
    $function = "display".ucwords($action);
    $title =  "Page ".$action;
     $content = $function();

}

require VIEWS.SP."templates".SP."default.php";
?>