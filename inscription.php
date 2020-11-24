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
      $password2 = $_POST['password2'];

          //ici on verifie que tous les champs sont remplis
          if($login && $password && $password2)
          {
              //ici on verifie si les mots de passe sont similaires
              if($password==$password2)
              {
        
              //on connecte la base de donnée et on lance la requete préparée pour verifier que le pseudo est disponible
              $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
              $request = $PDO->prepare("SELECT*FROM utilisateurs WHERE login = ? ");         
              $request->bindValue(1, $login);
              $request->execute();
                  
              $row = $request->rowCount();
              // var_dump($row);
              // $request->close();
              // $request->closeCursor();
              // $PDO->close();

                     if($row==0)
                     {
                       $request2 = $PDO->prepare("INSERT INTO utilisateurs (login, password) VALUES (?, ?)");
                       $request2->bindValue(1, $login);
                       $request2->bindValue(2, $password);
                       $request2->execute();
                      
                       $request2->closeCursor();
                       // $PDO->close();
                       header('location: connexion.php');
                       exit();

                     }
                     else $erreur= "<p class='erreur_ins'>Ce login est deja utilisé</p>";
                     // else $PDO->close();
              }
              else $erreur= "<p class='erreur_ins'>Les mots de passes ne sont pas similaires</p>";
          }
          else $erreur= "<p class='erreur_ins'> Veuillez renseignez tous les champs</p>";
      } 
}
catch(PDOException $pe)
{
   echo 'ERREUR : '.$pe->getMessage();
}

?>

<?php

include('header.php');

?>

<div class="card col-md-auto">
<div class="card-body">
<form  class="text-center border border-light p-5"  action="inscription.php" method="post">
    <p class="h4 mb-4">Inscrivez-vous</p>

    <input type="text" id="defaultLoginFormText" class="form-control mb-4" placeholder="Pseudo" name="login">
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Mot de passe" name="password">
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Confirmez" name="password2">
   
    <button class="btn btn-info btn-block my-4" type="submit" name="submit">C'est parti !</button>
    <?php if(isset($erreur)){echo $erreur ;}?>
</form>
<div>
</div>


<footer class="footer_me_ins" class="page-footer font-small blue">
  <div class="footer-copyright text-center py-3">Yaya-production™
    <a href="#"> bangbang</a>
  </div>
</footer>


   
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>