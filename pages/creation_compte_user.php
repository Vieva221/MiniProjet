<?php

require ('./constante/const.php');
if(isset($_POST['submit'])){
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $login = $_POST['login'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $photo=$_FILES['avatar'];
if(!empty($photo)){
    $extensionUpload=explode('.',$_FILES['avatar']['name']);
    $nomImage=$login.'.'.$extensionUpload[count($extensionUpload)-1];
    $photo= URL_PHOTO.$nomImage;
    move_uploaded_file($_FILES['avatar']['tmp_name'],$photo);
}
if(!login_inscription($login) && comparer_pwd($pwd1,$pwd2)){
$fichier_json="./data/utilisateur.json";
// Je récupérer le contenu existant dans le fichier json
$recup = file_get_contents($fichier_json);
 // On récupère le JSON dans un tableau PHP
$tab = json_decode($recup, true);
// On ajoute le nouvel élement
array_push( $tab, array(
   // array(
    "prenom"=> $_POST['prenom'],
    "nom"=>$_POST['nom'],
    "login"=>$_POST['login'],
    "pwd1"=>$_POST['pwd1'],
    "photo"=>$photo,
    "profil"=>"joueur",
    "score"=>"0"
   // )
));

// On réencode en JSON
$contenu_json = json_encode($tab);
         // On stocke tout le JSON
        file_put_contents($fichier_json, $contenu_json);
        //echo "Vos informations ont ete enregistrees";
        header('location:index.php?lien=jeu');
        
}else{
    if(login_inscription($login)){
        echo "Ce login est deja utilise";
    }
    if(!comparer_pwd($pwd1,$pwd2)){
        echo "Mots de Passe non Identiques";
    }
}
}

?>
<!DOCTYPE html >
<html>
<div class="bg-admin">
<div class="headerform">
<h2>S'INSCRIRE</h2><p id="pour_tester">Pour proposer des quizz</p> 
</div>

<form method="post" action="">
<label>Prenom </label><br>
<input type="text" placeholder="Aaaaa" name="prenom" class="input-admin"/><br>
<label>Nom </label><br>
<input type="text" placeholder="BBBB" name="nom" class="input-admin"/><br>
<label>Login </label><br>
<input type="text" placeholder="aabaab" name="login" class="input-admin"/><br>
<label>Password </label><br>
<input type="password" placeholder="Aaaaa" name="pwd1" class="input-admin"/><br>
<label> Confirmer Password </label><br>
<input type="password" placeholder="Aaaaa" name="pwd2"class="input-admin"/><br><br>
<label id="avatarlabel"> Avatar </label> <button  id="button1"><input type="file"  name="avatar"/>Choisir un fichier</button><br><br>
<button  id="button2" name="submit">Creer compte</button>
<div>
<div class="imgArrondie"> </div>
<p id="avatarDescription">Avatar Admin</p>
</div>

</html>