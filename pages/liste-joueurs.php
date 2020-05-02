
<!DOCTYPE html >
<html>
<meta=charset UTF8/>
<head>
    <style>
        .table_list_joueurs{
    width:90%;
    background-color:rgb(83, 199, 199);
    border-radius:5px;
}
.tr_list_joueurs{
    padding:2px;
}
.td_list_joueurs{
    color:black;
    padding:5px;
    font-family:Opens-Sans;
    font-weight:bold;

}
th{
    color:
}
    </style>
</head>    
<body>

<h3 class="title-list">LISTE JOUEURS PAR SCORE</h3>
<?php 
$users=file_get_contents('./data/utilisateur.json');
$tabUsers=json_decode($users,true);
//array_multisort($tabUsers,SORT_DESC,$tabUsers);
//var_dump($tabUsers);
echo"<table>";

define('ELT_PAR_PAGE',10); 
$NbrValeur=count($tabUsers);
$nbr_de_pages=ceil($NbrValeur/ELT_PAR_PAGE); 

if (isset($_GET['liste'])) {
    $pageActu = $_GET['liste'];
} else {
    $pageActu = 1;
}
$debut = ($pageActu*ELT_PAR_PAGE - ELT_PAR_PAGE) + 1;
$fin = $pageActu*ELT_PAR_PAGE;

foreach ($tabUsers as $value) {
    $tab[]=array(
        'prenom'=>$value['prenom'],
        'nom'=>$value['nom'],
        'score'=>$value['score'],
    );
    
}
$columns = array_column($tab, 'score');
array_multisort($columns, SORT_DESC, $tab);
//var_dump($tab);


echo"<table class='table_list_joueurs'>";
echo "<th>PRENOM</th> <th>NOM</th> <th>SCORE</th>";
for ($i=$debut; $i <=$fin ; $i=$i+1) { 
    
    echo "<tr class='tr_list_joueurs'>";
 if (isset($tab[$i])){
    if($tabUsers[$i]['profil']=="joueur"){
     echo "<td class='td_list_joueurs'>".$tab[$i]['prenom']."</td>
     <td class='td_list_joueurs'>".$tab[$i]['nom']."</td>
     <td class='td_list_joueurs'>".$tab[$i]['score']."</td>";
    }

 }
 else{
     echo " ";
 }
echo "</tr>";
}
echo"</table>";
for ($i=1; $i <= $nbr_de_pages; $i++) {  
    //if ($pageActu>1)
    echo '<a href="index.php?lien=accueil&contenu=liste-joueurs&liste='.$i.'">['.$i.']</a>&nbsp&nbsp';
}
?>



</body>
</html>
