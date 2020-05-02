<?php
function connexion($login,$pwd){
        $users=getData();
        foreach( $users as $key => $user){
            if($user["login"]===$login && $user["password"]===$pwd){
                    $_SESSION['user']=$user;
                    $_SESSION['statut']="login";
                if($user["profil"]==="admin"){
                        return "accueil";
                }else{
                    return "jeu";
                }
            }
               
        }
        return "error";
}

function comparer_pwd($pwd1,$pwd2){
    if($pwd1==$pwd2){
        return true;
    }
     return false;
}

function login_inscription($login){
    $users=file_get_contents('utilisateur.json');
    $users=json_decode($users,true);
    foreach( $users as $key => $user){
        if($user["login"]===$login){
            return true;
        }
    }
    return false;
}

/*function gestion_image($avatar){
    $avatar=$_FILES['avatar'];
    if (isset($avatar)&& !empty($avatar['name'])){
                $extensionUpload=strtolower(substr(strrchr($avatar['name'],'.'),1));
                         $chemin='./Avatars/'.$extensionUpload;
                         move_uploaded_file($avatar['tmp_name'],$chemin);
        }
    
   
}*/

function deconnexion(){
            unset($_SESSION['user']);
            unset($_SESSION['statut']);
            session_destroy();
}

function is_connected(){
            if(!isset($_SESSION['statut'])){
                header("location:index.php");
            }
}

function getData($file="utilisateur"){
        $data=file_get_contents("data/".$file.".json");
        $data=json_decode($data,true);
        return $data;
}
?>