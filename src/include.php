<?php 
//recuperer la racin du dossier

define("SRC", dirname(__FILE__)); 
define("ROOT", dirname(SRC));
define("SP", DIRECTORY_SEPARATOR); // separateur entre dossiers
define("CONFIG", ROOT.SP."config");
define("VIEWS", ROOT.SP."views");
define("MODEL", ROOT.SP."model");
define("BASE_URL",dirname(dirname($_SERVER['SCRIPT_NAME'])));// eviter la repetition de l'url 
define("TVA", 14);

// import de notre model
require CONFIG.SP."config.php";
require MODEL.SP."Data.class.php";

$data = new Data();
$categorie = $data->getCategorie();

//$data = $data->getProduct(3,1);
//print_r($data);exit();

//print_r($categorie); exit();

//$categorie = $data->getCategorie();
//print_r($categorie);exit();

//$Product = $data->getProduct();
//print_r($Product);exit();


//$var = $data->createUsers('fati','fati@gmail.com','fati3456');
//$auten =  $data->session('fati@gmail.com','fati3456');

//print_r($auten); exit();
//print_r(array(VIEWS,MODEL)); exit();
//$data->updateClient(array('id'=> 1,'nom'=>'AIT OUFKIR','prenom'=>'BRAHIM','email'=>'lion38@gmail.com'));
// fonctions appelee par le conroleur
require "function.php";


?>