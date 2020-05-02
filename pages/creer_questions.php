<?php 
if(isset($_POST['enregistrer'])){
$question=$_POST['question'];
$nbr_point=$_POST['nbr_point'];
$type_rps=$_POST['type_rps'];
$bonne_reponse=array();
$reponses=array();
//$bonnes_rps = (isset($_POST['bonne_reponse']))?$_POST['bonne_reponse']:null;

if(empty($question) or empty($nbr_point) or empty($type_rps)){
    echo" <p style='color:red'>Veuillez renseigner tous les champs </p>";
}else{ 
    $fichier_json="./data/questions.json";
    $recup = file_get_contents($fichier_json);
    $tab = json_decode($recup, true);

    
  if($type_rps==="text"){
    $i=1;
    while( !empty($_POST['rps_'.$i])){
        $reponses[]="";
       $bonne_reponse=$_POST['rps_'.$i];
       $i++;
    }
    array_push( $tab, array(
        // array(
         "question"=> $question,
         "nbr_points"=>$nbr_point,
         "type_de_reponse"=>$type_rps,
         "reponses"=>$reponses,
         "bonnes_reponses"=>$bonne_reponse
        // )
     ));
   
     $contenu_json = json_encode($tab);
     file_put_contents($fichier_json, $contenu_json);
     echo " <p style='color:red'>Informations enregistrees!  </p>";
    
}
elseif($type_rps==="choix_simple"){
    $i=1;
    while(!empty($_POST['rps_'.$i])){
        $reponses[]=$_POST['rps_'.$i];
        if(!empty($_POST['bonne_reponse_'.$i])){
            $bonne_reponse[]=$_POST['rps_'.$i];
        }
            $i++;
        }
        array_push( $tab, array(
            // array(
             "question"=> $question,
             "nbr_points"=>$nbr_point,
             "type_de_reponse"=>$type_rps,
             "reponses"=>$reponses,
             "bonnes_reponses"=>$bonne_reponse
            // )
         ));
     $contenu_json = json_encode($tab);
     file_put_contents($fichier_json, $contenu_json);
     echo " <p style='color:red'>Informations enregistrees!  </p>";
    }
    elseif($type_rps==="choix_multiple"){
        
        $i=1;
        while(!empty($_POST['rps_'.$i])){
            $reponses[]=$_POST['rps_'.$i];
            if(!empty($_POST['bonne_reponse_'.$i])){
                $bonne_reponse[]=$_POST['rps_'.$i];
            }
            $i++;
        }
        array_push( $tab, array(
            // array(
             "question"=> $question,
             "nbr_points"=>$nbr_point,
             "type_de_reponse"=>$type_rps,
             "reponses"=>$reponses,
             "bonnes_reponses"=>$bonne_reponse
            // )
         ));
                $contenu_json = json_encode($tab);
                file_put_contents($fichier_json, $contenu_json);
                echo " <p style='color:red'>Informations enregistrees!  </p>";
       
    }
        
        }
}

?>
<link rel="stylesheet" href="./pages/creer_qst.css">
<style>
   input[type=radio]{
    width: 4%;
    height: 4%;
    background-color: rgb(138, 87, 26);
    margin-right:6px;
}
input[type=checkbox]{
    width: 4%;
    height: 4%;
    background-color: rgb(138, 87, 26);
}
#btn-submit{
        background-color: #05c5e9; 
        border: none;
        color: white;
        padding: 13px 28px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>

<html>

<body>
<div class="contenu_questions">
<div class="header_questions">
<div class="ajout_qst">
    <form action="" id="form-qst" method="post">
        <div class="row">
         <label for="">Questions</label> 
        <textarea id="textarea" cols="50" rows="5" error="error-1"name="question" class="entree"></textarea> 
        <div id="error-1" style= "color:red"></div>
        </div>
    <div class="row">
    <label for="">Nbre dePoints</label>
    <input type="number" id="nbr_point" name="nbr_point" error="error-2" class="entree"min="1" max="10000" >
    <div id="error-2" style= "color:red"></div>
</div>

<form id="form-qst">
 
    <div class="row" id="ligne_0">

    <label for="">Type de reponse</label>
    <select id="mySelect" class="entree" id="type_rps" name="type_rps" error="error-3" onchange="AddInput()" >
        <option value="text">Type text</option>
        <option value="choix_simple">Choix simple</option>
        <option value="choix_multiple">Choix multiple</option>
    </select>
    <div id="error-3" style= "color:red"></div>
    <button type="button" id="icon-form" onclick="AddInput()"> </button>
         </div>
         <div id="inputs"> </div>
    <button type="submit" name="enregistrer" id="btn-submit">Enregistrer</button>
    </form>
</div> 
 </div>
 </div> 

    <script>
    
        var nbLignes=0;
     /*  function putName(){
            var myInputs = document.getElementById('rps');
        myInputs.setAttribute('name','rps_'+nbLignes);
            nbLignes++;
        }*/
    function verifSelect(){
        nbLignes++;
        var x = document.getElementById("mySelect").value;
        var divInputs= document.getElementById('inputs');
        var newInput= document.createElement('div');
        newInput.setAttribute('id','row_'+nbLignes);
        
        switch(x) {
          case "text":
           // document.getElementById("icon-form").setAttribute("disabled","disabled");
            divInputs.innerHTML=
             ` <label> Reponse </label>
                 <input type="text"  error="error-4" class="entree"> 
                 <button type='button' id="icon-suppr" onclick="DeleteInput(${nbLignes})">
                 <img src="./images/ic-supprimer.png" alt="">
                 </button>`
                 divInputs.appendChild(newInput);
                 
                break;
                case "choix_simple":
                    divInputs.innerHTML=
            ` <label> Reponse </label>
                 <input type="text" name="rps"  error="error-4" class="entree">
                 <input type="radio">
                 <button type='button' id="icon-suppr" onclick="DeleteInput(${nbLignes})"> 
                 <img src="./images/ic-supprimer.png" alt="">
                 </button> `
                 divInputs.appendChild(newInput);
                 //document.getElementById("icon-form").setAttribute("disabled", false);
                 break;
                 case "choix_multiple":
                    divInputs.innerHTML=
            ` <label> Reponse </label>
                 <input type="text" name="rps" error="error-4" class="entree">
                 <input type="checkbox"> 
                 <button type='button' id="icon-suppr" onclick="DeleteInput(${nbLignes})">
                 <img src="./images/ic-supprimer.png" alt="">
                 </button>  `
                 divInputs.appendChild(newInput);
                // document.getElementById("icon-form").setAttribute("disabled", false);
                break;
        }
       
      // divInputs.appendChild(newInput);    
    }
    function AddInput(){
        if(nbLignes<5){
        var x = document.getElementById("mySelect").value;
        nbLignes++;
        var divInputs= document.getElementById('inputs');
        var newInput= document.createElement('div');
        newInput.setAttribute('id','row_'+nbLignes);
            
      //  var myInputs = document.getElementsByClasseName('entree');
       // myInputs.setAttribute('name','rps_'+nbLignes);
      
        switch(x) {
          case "text":
          document.getElementById("icon-form").setAttribute("disabled","disabled");
          divInputs.innerHTML= ` <label> Reponse </label>
                 <input type="text" id="rps" name="rps_${nbLignes}" error="error-4" class="entree"> 
                 <button type='button' id="icon-suppr" onclick="DeleteInput(${nbLignes})">
                 <img src="./images/ic-supprimer.png" alt="">
                 </button>`
                 
                break;
                case "choix_simple":

                    newInput.innerHTML=
            ` <label> Reponse </label>
                 <input type="text" id="rps" name="rps_${nbLignes}" error="error-4" class="entree">
                 <input type="radio" name="bonne_reponse_${nbLignes}">
                 <button type='button' id="icon-suppr" onclick="DeleteInput(${nbLignes})"> 
                 <img src="./images/ic-supprimer.png" alt="">
                 </button> `
                // divInputs.appendChild(newInput);
                 //document.getElementById("icon-form").setAttribute("disabled", false);
                 break;
                 case "choix_multiple":
                    newInput.innerHTML=
            ` <label> Reponse </label>
                 <input type="text" id="rps" name="rps_${nbLignes}" error="error-4" class="entree">
                 <input type="checkbox" name="bonne_reponse_${nbLignes}"   value="rps_${nbLignes}"> 
                 <button type='button' id="icon-suppr" onclick="DeleteInput(${nbLignes})">
                 <img src="./images/ic-supprimer.png" alt="">
                 </button>  `
                // divInputs.appendChild(newInput);
                // document.getElementById("icon-form").setAttribute("disabled", false);
                break;
        }
        divInputs.appendChild(newInput);
    }
 }
   
    function DeleteInput(n){
       var recup= document.getElementById('row_'+n);
        fadeOut('row_'+n);
        recup.remove();
    }
    function fadeOut(idTarget){
        var recup= document.getElementById(idTarget);
        var effect= setInterval(function(){
            if(!recup.style.opacity){
                recup.style.opacity=1;
            }
            if(recup.style.opacity>0){
                recup.style.opacity-=0,1;
            }else{
                clearInterval(effect);
            }
        }, 200);
    }

//Contole de saisie
const entrees=document.getElementsByClassName("entree");
for(entree of entrees){
    entree.addEventListener("keyup",function(e){
       if(e.target.hasAttribute("error")) {
        var idDivError=e.target.getAttribute("error")
        document.getElementById(idDivError).innerText=""
       }
    })

}
document.getElementById("form-qst").addEventListener("submit", function(e){
    const entrees=document.getElementsByClassName("entree");
    var error=false;
    for(entree of entrees){
        if(entree.hasAttribute("error")){
           var idDivError=entree.getAttribute("error")
        if(!entree.value){                                                      //si le champ est vide
                document.getElementById(idDivError).innerText="Ce champ est obligatoire"
                error=true;                                                  // on met erro a true pour dire qu on a trouve une erreur
            }
           
        }
    }
    if(error){
        e.preventDefault();
    }
//pour que la page ne se recharge pas
    return false;
   
})
</script>

</body>
</html>
