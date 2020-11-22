<?php
session_start();

//variables intermédiaires de connexion
$DB_DSN = 'mysql:host=localhost;dbname=livreor';
$DB_USER = 'root';
$DB_PASS = '';

try
{
//configuration des erreurs et enlever l'emulation des requetes préparées
$options =
[
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_EMULATE_PREPARES => false
];
      //ici on verifie que le boutton submit est utilisé
      if(isset($_POST['submit']))
      {
      $login = $_POST['login'];
      $password = $_POST['password'];

          //ici on verifie que tous les champs sont remplis
          if($login && $password)
          {
          //on connecte la base de donnée et on lance la requete préparée pour verifier que l'utilisateur existe et a bien remplis ses infos
          $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
          $request = $PDO->prepare("SELECT login, password, id FROM utilisateurs WHERE login = ? && password = ? ");         
          $request->bindValue(1, $login);
          $request->bindValue(2, $password);
          $request->execute();
                  
          $row = $request->rowCount();
          
          $ligne = $request->fetch(PDO::FETCH_ASSOC);

                // if($ligne["login"]=='admin' && $ligne["password"]=='admin')
                // {
                //   $_SESSION['admin'] = 'admin';
                //   header('location: admin.php');
                //   exit();
                // }
                if($row==1)
                { 
                  $_SESSION['connexion'] = $ligne['id'] ;             
                  header('location: profil.php');
                  exit();
                }          
          }
          else $erreur= "<p class='erreur_ins'> Veuillez renseignez tous les champs</p>";
      } 
}
catch(PDOException $pe)
{
   echo 'ERREUR : '.$pe->getMessage();
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="livreor.css">

    <title>Connexion</title>
  </head>

  <body>
  
  <!-- Navbar ---------------- -->
  <header class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="livre-or.php">Livre d'or</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Accueil
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inscription.php">Inscription</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="connexion.php">Connexion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profil.php">Profil</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Action</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="deconnexion.php">Deconnexion</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Que cherchez-vous?">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">C'est parti !</button>
    </form>
  </div>
</header>

<!-- Formulaire ---------------- -->
<form  class="text-center border border-light p-5"  action="connexion.php" method="post">
    <p class="h4 mb-4">Connectez-vous</p>

    <input type="text" id="defaultLoginFormText" class="form-control mb-4" placeholder="Pseudo" name="login">
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Mot de passe" name="password">
   
    <button class="btn btn-info btn-block my-4" type="submit" name="submit">C'est parti !</button>
</form>

<!-- Footeer ------------------- -->
<footer class="footer_me_con" class="page-footer font-small blue">
  <div class="footer-copyright text-center py-3">Yaya-production™
    <a href="#"> bangbang</a>
  </div>
</footer>


   
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>