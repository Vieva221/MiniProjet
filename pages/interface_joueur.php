<?php
is_connected();
?>

<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <style>
     .contenu-quizz{
    width: 98%;
    height: 98%;
    margin-left:1%;
    margin-top:5px;
    background-color: white;
    border-radius:5px
}
.titre{
  color:white;
  font-family:Open-Sans;
  font-size:22px;
  font-weight:bold;
 margin-left:15%;
 padding-top:20px;

}
.pic{
        overflow:hidden;
        -webkit-border-radius:80px;
        -moz-border-radius:80px;
        border-radius:80px;
        width:80px;
        height:80px;
        border:2px solid #ffffff;
        margin-left: 20px;
        position: absolute;
        margin-top: 20px;
        padding: 10px;
    }
.header-cont{
  width: 100%;
        height: 120px;
        background-color: #05c5e9;
        border-radius: 5px;
        margin-top:-22px;
}
.cont{
        width: 80%;
        height: 139%;
        background-color: rgb(240, 229, 229);
        margin: 2%;
        border-radius: 5px;
        margin-left: 10%;
        position: absolute;
    }
    .btn-reset{
        background-color: rgb(83, 199, 199);
        color: white;
        float: right;
        padding:10px 10px;
    }
    .titre-qst{
      width:45%;
      background-color:#d1d7d8;
      height:120px;
      position:relative;
      top:20px;
      left:8%;
      border-radius:5px;
      text-align:center;
    }
    .rps{
      position:relative;
      top:40px;
      left:12%;
      font-weight:bold;
      font-size:26px;
    }
    .btn-info {
      position:absolute;
      top:60%;
      left:42%;
    }
    .btn-danger {
      position:absolute;
      top:60%;
      left:10%;
    }
    .questions{
      width:85%;
    }
    .name_user{
        font-family: Open-Sans;
        font-weight: bold;
        color: white;
        margin-left: 20px;
        position: absolute;
        margin-top: 95px;
        font-size: 18px;
    }
    .top_quizz{
      width:18%;
      height:200px;
      background-color:silver;
      position:relative;
      margin-top:-100px;
      float:right;
      right:10%;
    }
    .nb_pts{
      background-color:#d1d7d8;
      margin-top:4%;
      margin-left:41%;
      width:11%;
      text-align:center;
      position:relative;
      height:5%;
      padding:4px 2px;
      border-radius:5px;

    }
    </style>
    <link rel="stylesheet" href="./pages/user_interface.css">
    <title>Document</title>
   
  </head>
  <body>
<div class="cont">
<div class="header-cont">
<div class="pic"> </div><div class="name_user"> AAA BBB</div>
<div class="titre">BIENVENUE SUR LA PLATEFORME DE JEU QUIZZ <br>
JOUEZ ET TESTEZ VOTRE NIVEAU DE CULTURE GENERALE </di>
 <button class="btn-reset"><a href="index.php?satut=logout">Deconnexion</a></button></div>
</div>
<div class="contenu-quizz">
<div class="questions">
<form action="" method="post">
  <?php
$fichier_json="./data/questions.json";
$recup = file_get_contents($fichier_json);
$tab = json_decode($recup, true);

$setting="./data/settings.json";
$content = file_get_contents($setting);
$nb_qst = json_decode($content, true);

define('ELT_PAR_PAGE',1); 
$NbrValeur=$nb_qst['nbre_questions'];
$nbr_de_pages=ceil($NbrValeur/ELT_PAR_PAGE); 
if (isset($_GET['liste'])) {
  $pageActu = $_GET['liste'];
} else {
  $pageActu = 1;
}
$debut = ($pageActu*ELT_PAR_PAGE - ELT_PAR_PAGE) + 1;
$fin = $pageActu*ELT_PAR_PAGE;

shuffle($tab);
  foreach ($tab as $key => $value) {
    if($key>=$debut && $key<=$fin){
     echo '<div class="titre-qst"> <h4 id="qst">Question'.$key.'/'.$NbrValeur.'</h4><b style="color:#cd0312">'.$value['question'].'</b></div>';
     echo '<div class="nb_pts"> <h5>'.$value['nbr_points'].'Points</h5></div>';
    //}
     $rps=$value['reponses'];
      foreach ($rps as $key => $valeur) {
        if($value['type_de_reponse']==='choix_simple'){
          echo '<div class="rps"> <input type="radio" name="radio" value="'.$valeur.'" class="radio">'.$valeur.'</div>';
        }
        else{
          if($value['type_de_reponse']==='choix_multiple'){
            echo '<div class="rps"> <input type="checkbox">'.$valeur.'</div>';
          }
          else{
            if($value['type_de_reponse']==='text'){
              echo '<div class="rps"> <input type="text"></div>';
            }
          }
          }
        
      }
    }
}

//<?php
if($pageActu>1){
    echo '<a  href="index.php?lien=jeu&liste='.($pageActu-1).'" class="btn btn-danger">Precedent</a>&nbsp&nbsp';
}
if($nbr_de_pages>$pageActu){
    echo '<a  type="submit" name="suivant" href="index.php?lien=jeu&liste='.($pageActu+1).'" class="btn btn-info">Suivant</a>&nbsp&nbsp';
}else{
if($nbr_de_pages=$pageActu){
  echo '<button type="submit" name="terminer" class="btn btn-info">Terminer</button>&nbsp&nbsp';
}
}

/*if(isset($_POST['terminer'])){
  while(isset($_POST['suivant'])){
  if(!empty($_POST['radio'])&& isset($_POST['radio'])){
    $table=array();
  
}
$table[]=$valeur;
var_dump($table);
  }
 
//$_SESSION['rps_user']=$table;
//var_dump($_SESSION['radio']);
//echo $_SESSION['rps_user'];

 // }
  
}*/


?>
</form>
  </div>
  <div class="top_quizz">
  <ul>
  <li>Top Score</li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  </ul>
</div>  
<?php

//echo "<p style='color:red'>bravo</p>";


?>
</div>
</body>
</html>