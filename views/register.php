<?php
session_start();
require '../tool/connect.php';
$title ="Inscription";
if(isset($_POST['envoyer'])){
  if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['password'])){
    $pseudo = htmlspecialchars($_POST ['pseudo']);
    $email = htmlspecialchars($_POST ['email']);
    $email2 = htmlspecialchars($_POST ['email2']);
    $pass = $_POST ['password'];
    $options = array('cost'=>11);
    $password = password_hash($pass, PASSWORD_BCRYPT, $options);
    $message="";
    echo $password;
    if(strlen($pseudo)<=255){
      $reqPseudo = $bdd->prepare("SELECT * FROM members WHERE pseudo = ?");
      $reqPseudo->execute(array($pseudo));
      $pseudoExist = $reqPseudo->rowCount();
      if($pseudoExist ==0){
      if(filter_var($email , FILTER_VALIDATE_EMAIL)){
        $reqmail = $bdd->prepare("SELECT * FROM members WHERE email = ?");
        $reqmail->execute(array($email));
        $mailexist = $reqmail->rowCount();
        if($mailexist ==0){
          if($email == $email2){
            $insertmbr = $bdd->prepare('INSERT INTO members(pseudo, email, password) VALUES (:pseudo,:email,:password)');
            $insertmbr->execute(array('pseudo' => $pseudo,
            'email' => $email,
            'password' => $password));

            $_SESSION['message'] = '<div class="success">Votre compte a bien été créé.</div>';
            //header('Location: ../index.php');
          }else{
            $message = '<div class="erreur">Vos adresses mail ne correspondent pas.</div>';
          }
        }else{
          $message = '<div class="erreur">Cette adresse mail est déjà utilisée.</div>';
        }
      }else {
        $message = '<div class="erreur">Veuillez entrer un mail valide !</div>';

      }
    }else{
        $message = '<div class="erreur">Ce pseudo est déjà utilisé.</div>';
      }

    }else{
      $message = '<div class="erreur">Votre pseudo ne doit pas dépasser 255 caractères.</div>';
    }

  }else{
    $message ='<div class="erreur">Tous les champs doivent être complétés !</div>';
  }
  if($message){
    echo $message;
  }
}

 require 'header.php';?>
    <div class="" align="center">
      <h2 class="title">Inscription</h2>
      <br/><br/>
      <form class="" action="" method="post">
        <table>
          <tr>
            <td align="right">
              <label for="pseudo">Pseudo : </label>
            </td>
            <td>
              <input type="text" name="pseudo" value="<?php if($pseudo){
                echo $pseudo;       } ?>" placeholder="Votre pseudo" id="pseudo">
            </td>
          </tr>
          <tr>
            <td align="right">
              <label for="mail">Mail : </label>
            </td>
            <td>
              <input type="eamil" name="email" value="<?php if($email){
                echo $email;       } ?>" placeholder="Votre email" id="email">
            </td>
          </tr>
          <tr>
            <td align="right">
              <label for="mail2">Confirmer email : </label>
            </td>
            <td>
              <input type="email" name="email2" value="<?php if($email2){
                echo $email2;       } ?>" placeholder="Confirmez votre email" id="email2">
            </td>
          </tr>
          <tr>
            <td align="right">
              <label for="password">Mot de passe : </label>
            </td>
            <td>
              <input type="password" name="password" value="" placeholder="Votre mot de passe" id="password">
            </td>
          </tr>
          <tr>
            <td colspan="2">
            </td>
          </tr>
        </table>
        <br/>
        <input type="submit" name="envoyer" value="Je m'inscris">
      </form>
      <br>
      <div class="">
        Vous avez déjà un compte ? <a href="login.php">Se Connecter</a>
      </div>
      <br>
      <a href="../index.php">Retour à l'accueil</a>
    </div>
  </body>
</html>
