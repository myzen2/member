<?php
session_start();
require '../tool/connect.php';

if($_POST['connexion']){
  $pseudoConnect = htmlspecialchars($_POST['pseudoConnect']);
  $pass = $_POST ['passwordConnect'];

  $passwordConnect = password_verify($pass);

  if (!empty($pseudoConnect) AND !empty($pass)) {
    $requser = $bdd->prepare('SELECT * FROM members WHERE pseudo = :pseudo');
    $requser->execute(array('pseudo' => $pseudoConnect));
    $result = $requser->fetch();
    if($result == true){
      //le compte existe et je vérifie le mot de passe
      $hashpassword = $result['password'];
      if (password_verify($pass, $hashpassword)) { ?>

    <?php header('Location: profile.php?id='.$result['id']);
    $_SESSION['pseudo'] = $result['pseudo'];
  }else{
        $erreur = '<div class="erreur">Mauvais pseudo ou mot de passe</div>';
      }
      var_dump($result);
    }else{
      echo $erreur = '<div class="erreur">Le compte n\'existe pas.</div>';
    }
    $userexist = $requser->rowCount();
    /*if($userexist == 1){
      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['pseudo'] = $userinfo['pseudo'];
      $_SESSION['email'] = $userinfo['email'];
      header('Location: profile.php?id='.$_SESSION['id']);
    }else{
      $erreur = '<div class="erreur">Mauvais pseudo ou mot de passe</div>';
    */
  }else{
    $erreur = '<div class="erreur">Les champs ne sont pas renseignés</div>';
  }
  if($erreur){
    echo $erreur;
  }
}

$title ="Connexion";
require '../views/header.php' ?>
<div class="" align="center">
  <h2 class="title"><?=$title?></h2>
  <br/><br/>
<form class="" action="" method="post">
  <table>
    <tr>
      <td align="right">
        <label for="pseudo">Pseudo : </label>
      </td>
      <td>
        <input type="text" name="pseudoConnect" value="<?php if($pseudoConnect){
          echo $pseudoConnect;       } ?>" placeholder="Votre pseudo" id="pseudoConnect">
      </td>
    </tr>
    <tr>
      <td align="right">
        <label for="password">Mot de passe : </label>
      </td>
      <td>
        <input type="password" name="passwordConnect" value="" placeholder="Votre mot de passe" id="passwordConnect">
      </td>
    </tr>
    <tr>
      <td>
      </td>
    </tr>
  </table>
  <br/>
  <input type="submit" name="connexion" value="Se connecter">
</form>
