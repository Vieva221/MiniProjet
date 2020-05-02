<?php 
$liste=file_get_contents('./data/questions.json');
$tabqst=json_decode($liste,true);

?>
<!DOCTYPE html >
<html>
<meta=charset UTF8/>
<head>
<title>Liste questions</title>
<style>
.ma-liste{
    background-color:white;
}
h3{
    font-family:Open-Sans;
}

</style>
</head>
<body>
<div class="ma-liste">
<?php
define('ELT_PAR_PAGE',10); 
$NbrValeur=count($tabqst);
$nbr_de_pages=ceil($NbrValeur/ELT_PAR_PAGE); 

foreach ($tabqst as $value) {
    
    echo '<h3>'.$value['question'].'</h3>';
    
    for($i=1; $i<count($value['reponses']); $i++){
    echo '<p>'.$value['reponses'][$i].'</p>';
    
    }
}

?>
</div>
</body>
</html>