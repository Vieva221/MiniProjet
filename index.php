
<html>
<link rel="stylesheet" href="./pages/quizz.css">
<meta=charset UTF8/>
<head>
</head>
<body>
    <div class="header">
        <div class="logo"></div>
        <div class="header-text">Le plaisir de jouer</div>
    </div>
    <div class="content">
    <?php
session_start();
require_once('./traitement/fonctions.php');


if(isset($_GET['lien'])){
    if($_GET['lien']=="creation_compte_user"){
        require_once('./pages/creation_compte_user.php');
    }
    switch($_GET['lien']){
        case "accueil":
            require_once('./pages/interface_admin.php');
        break;
        case "jeu":
            require_once('./pages/interface_joueur.php');
        break;
    }
}else{
    if(isset($_GET['statut']) && $_GET['statut']==="logout"){
        deconnexion();
    }
    require_once('./pages/page_connexion.php');
}
?>
    </div>
    </body>
    </html>
   