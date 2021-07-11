<?php 

class Data{

    private $connexion;

    function __construct() {
  
        try {
            $this->connexion = new PDO("mysql:host=".HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);
            //echo"connxion ok";
        } catch (PDOExeption $th) {
            echo $th-> getMessage;
        }
    }
   /**
     * fonction qui créer un client en base de données
     * @param nom 
     * @param email
     * @param password 
     * @return TRUE return true cas de succes sinon FALSE 
     * @return NULL return Nulle cas d'exception
     */
    function createUsers($nom,$email,$password){
        $sql = "INSERT INTO clients (nom,email,password) VALUES (:nom,:email,:password)";
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':nom' => $nom,
                ':email' => $email,
                ':password' => sha1($password)
            ));
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }    

    }
/**
     * fonction qui permet d'authentifier un customer
     * @param email l'email du customer
     * @param password le mot de passe du customer
     * @return ARRAY tableau contenant les infos du customer si authentification réussie
     * @return FALSE si authentification échouée
     * @return NULL s'il y a une exception déclenchée 
     */
    function session($email, $password) {

        $sql = "SELECT * FROM clients WHERE email = :email";
        try {
            $result = $this->connexion->prepare($sql);
            $result->execute(array(':email'=>$email));
 
            $data = $result->fetch(PDO::FETCH_ASSOC);
            if($data && ($data['password'] == sha1($password))){
                unset($data['password']);//masquer le mot de passe du tableau 
                return $data;
            } else {
                return FALSE ;
            }
        } catch (PDOException $th) {
            return NULL;
        }

    }

    /**
     * fonction qui creer un produit en base de donnees
     * @param idProduit
     * @param idClient
     * @param quantite
     * @param prix
     * @return TRUE command reussi
     * @return NULL cas d'exception 
     */

    function commande($idProduit,$idClient,$quantite,$prix) {

        $sql = "INSERT INTO commande(id_produit, id_client, quantite, prix) VALUES
        (:id_produit, :id_client,:quantite,:prix)";
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
    
            ':id_produit' =>$idProduit,
            ':id_client' =>$idClient,
            ':quantite' =>$quantite,
            ':prix' =>$prix

            ));

            if($var){
                return true;
            } else {

                return false;
            }

        } catch (PDOException $th) {
            return NULL;
        }
    }

    // tableau des cles valeurs ex: ('valeurOrigine' =>'newvalue')

     function updateClient($newEntrer){
         $sql = "UPDATE clients SET ";
         try {
            
            foreach($newEntrer as $key => $value){
                $sql .= "$key = '$value' ,"; // syantax puisque en concaten avec une chaine de caractere
            }
            $sql = substr($sql,0,-1);// supprimer le dernier element , du tableau
            $sql .= "WHERE id = :id";

            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array('id'=>$newEntrer['id']));
            
            if ($var){
                return TRUE;
            } else {
                return FALSE;
            }

         }  catch (PDOException $th) {
            return NULL;
         }

     }

     function getCategorie(){

        $sql = "SELECT * FROM categorie";
        try {
            
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($var){
                return $data;
            } else {
                return FALSE;
            }

        } catch (PDOException $th) {
            return NULL;
         }
     }


     function getProduct($limit=NULL,$categorie = NULL, $id=NULL){
        $sql = "SELECT * FROM produits ";
        try {
            if(!is_null($id)) {
                $sql .= ' WHERE id = ' .$id; // rechercher un id categorie donnne
            }

            if(!is_null($categorie)) {
                $sql .= ' WHERE id_categorie = ' .$categorie; // rechercher une categorie donnne
            }
            if(!is_null($limit)) {
                $sql .= ' LIMIT ' .$limit; // limite le nombre des produits rechercher
            }
      
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($var){
                return $data;
            } else {
                return FALSE;
            }

        } catch (PDOException $th) {
            return NULL;
         }
     }

}

?>