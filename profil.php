<?php
session_start();

$DB_DSN = 'mysql:host=localhost;dbname=livreor';
$DB_USER = 'root';
$DB_PASS = '';

try
{
$options =
[
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_EMULATE_PREPARES => false
];
if(!isset($_SESSION['connexion']))
{
    header('location: connexion.php');
    exit();
}
//ici on stocke le contenu de la variable SESSION (le login entré precedemment) dans $loginverify
//pour pouvoir l'utiliser pour fixer la ligne lors de la requete UPDATE
$idverify = $_SESSION['connexion'];

      if(isset($_POST['submit']))
      {
            if(!empty($_POST))
            {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $test= 'salut';

                  if($password==$password2)
                  {
                    
                  $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
                  $request = $PDO->prepare("SELECT*FROM utilisateurs WHERE login = ? ");         
                  $request->bindValue(1, $login);
                  $request->execute();

                  $row = $request->rowCount();
                            

                         if($row==0)
                         {
                         $request2 = $PDO->prepare("UPDATE utilisateurs SET login = ?, password = ?  WHERE id = ? ");
                        

                         $request2->bindValue(1, $login);
                         $request2->bindValue(2, $password);
                         $request2->bindValue(3, $idverify);
                         $request2->execute();
                         var_dump($request2);
                         }
                  }
            }
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


<form  class="text-center border border-light p-5"  action="profil.php" method="post">
    <p class="h4 mb-4">Modifiez votre pseudo et mot de passe</p>

    <input type="text" id="defaultLoginFormText" class="form-control mb-4" placeholder="Pseudo" name="login">
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Mot de passe" name="password">
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Confirmez" name="password2">
   
    <button class="btn btn-info btn-block my-4" type="submit" name="submit">C'est parti !</button>
</form>


<footer class="footer_me_ins" class="page-footer font-small blue">
  <div class="footer-copyright text-center py-3">Yaya-production™
    <a href="#"> bangbang</a>
  </div>
</footer>


   
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>