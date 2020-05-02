
<html>

<div class="contenu">
<div class="header-contenu">
<div class="title-setting">CREER ET PARAMETRER VOS QUIZZ <button class="reset"><a href="index.php?satut=logout">Deconnexion</a></button></div>
</div>
<div class="contenu-admin">
  <div class="aside">
      <div class="header-aside">
      <div class="photo"> </div>
      <div class="pseudo"> AAA<br/> BBB</div>
      </div>
      <ul>
        <li><a href="index.php?lien=accueil&contenu=liste-questions">Liste Questions</a> <div class="icone-liste"></div></li>
        <li><a href="index.php?lien=accueil&contenu=creation_compte_admin ">Creer Admin</a><div class="icone-ajout"></div></li>
        <li><a href="index.php?lien=accueil&contenu=liste-joueurs">Liste joueurs</a><div class="icone-liste-active"></div></li>
        <li><a href="index.php?lien=accueil&contenu=creation_questions">Creer Questions</a><div class="icone-ajout-2"></div></li>
      </ul>
  </div>
  <div class="contenu-dynamique">
    <?php
      if(isset($_GET['contenu'])){
        if($_GET['contenu']=="liste-joueurs"){
        include('liste-joueurs.php');
        }
        elseif($_GET['contenu']=="creation_compte_admin"){
            include('creation_compte_admin.php');
          }
          elseif($_GET['contenu']=="creation_questions"){
            include('creer_questions.php');
          }elseif($_GET['contenu']=="liste-questions"){
            include('liste_questions.php');
          }
        }
    ?>
  </div>
 </div>
 </div>

</html>