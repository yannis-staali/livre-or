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
    
                
    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
    $request = $PDO->prepare("SELECT commentaires.date, utilisateurs.login, commentaires.commentaire FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id ");         
    $request->execute();                  
  
    // $ligne = $request->fetch(PDO::FETCH_ASSOC);

    // while($resultat = $request->fetch())
    // {
    //   $date = $resultat['date'];
    //   $login = $resultat['login'];
    //   $commentaire = $resultat['commentaire'];
    // }
      
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

<!-- <main class="jumbotron">
  <h1 class="display-3">Liste des commentaires</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</main> -->
<?php  
        echo "<table class='comm'>";
        while($resultat = $request->fetch())
        {
          echo "<tr><td> $resultat[date] </td>  <td> $resultat[login] </td> . <td> $resultat[commentaire] </td></tr>" ;
           
        }
        echo "</table>";
?>

<footer class="footer_or" class="page-footer font-small blue">
  <div class="footer-copyright text-center py-3">Yaya-production™
    <a href="#"> bangbang</a>
  </div>
</footer>


   
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>