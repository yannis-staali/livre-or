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

//affichage boutton conenxion/deconnexion
if(isset($_SESSION['connexion']))
{
    $btn_deconnect = '';
}
if(!isset($_SESSION['connexion']))
{
    $btn_connect = '';
}
?>

<?php

include('header.php');

?>

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