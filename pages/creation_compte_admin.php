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
    "profil"=>"admin",
   // )
));

var_dump($tab);

// On réencode en JSON
$contenu_json = json_encode($tab);
         // On stocke tout le JSON
        file_put_contents($fichier_json, $contenu_json);
        //echo "Vos informations ont ete enregistrees";
        header('location:index.php?lien=accueil');
        
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

<form method="post" action="" id="form-admin" enctype="multipart/form-data">
<label>Prenom </label><br>
<input type="text" placeholder="Aaaaa" name="prenom" error="error-1"  class="input-admin"/><br>
<div class="error-form" id="error-1"></div>
<label>Nom </label><br>
<input type="text" placeholder="BBBB" name="nom" error="error-2" class="input-admin"/><br>
<div class="error-form" id="error-2"></div>
<label>Login </label><br>
<input type="text" placeholder="aabaab" name="login" error="error-3" class="input-admin"/><br>
<div class="error-form" id="error-3"></div>
<label>Password </label><br>
<input type="password" placeholder="Aaaaa" name="pwd1" error="error-4" class="input-admin"/><br>
<div class="error-form" id="error-4"></div>
<label> Confirmer Password </label><br>
<input type="password" placeholder="Aaaaa" name="pwd2" error="error-5" class="input-admin"/><br><br>
<div class="error-form" id="error-5"></div>
<label id="avatarlabel"> Avatar </label> <input type="file"  id="button1" value="Choisir un fichier" name="avatar"/><br><br>
<button type="submit" id="button2" name="submit">Creer compte</button>
<div>
<div class="imgArrondie">  </div>
<p id="avatarDescription">Avatar Admin</p>
</div>

</html>
<script>
const inputs=document.getElementsByTagName("input");
for(input of inputs){
    input.addEventListener("keyup",function(e){
       if(e.target.hasAttribute("error")) {
        var idDivError=e.target.getAttribute("error")
        document.getElementById(idDivError).innerText=""
       }
    })

}


document.getElementById("form-admin").addEventListener("submit", function(e){
    const inputs=document.getElementsByTagName("input");
    var error=false;
    for(input of inputs){
        if(input.hasAttribute("error")){
           var idDivError=input.getAttribute("error")
        if(!input.value){
                document.getElementById(idDivError).innerText="Ce champ est obligatoire"
                error=true;
            }
           
        }
    }
    if(error){
        e.preventDefault();
    }

    return false;
   
})
</script>
