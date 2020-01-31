<?php
session_start();
//require('inc/pdo.php');
//require('inc/function.php');
$title = 'Home page';
$errors = array();
$success = false;

// traitement fomulaire
if (!empty($_POST['submited'])) {
// fail xss
    $nom = trim(strip_tags($_POST['nom']));
    $prenom = trim(strip_tags($_POST['prenom']));
    $email = trim(strip_tags($_POST['email']));
    $tel = trim(strip_tags($_POST['tel']));
    $adress = trim(strip_tags($_POST['adress']));
    $diplome = trim(strip_tags($_POST['diplome']));
    $esp_pro = trim(strip_tags($_POST['esp_pro']));
    $esp_pro = trim(strip_tags($_POST['esp_pro']));
}
?>

<form action="#" method="post">
    <div class="presenation">
        <div>
            <input id="nom" name="nom" type="text" placeholder="Nom *" />
            <label id="icon_nom"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
        <div>
            <input id="prenom" name="prenom" type="text" placeholder="Prenom *" />
            <label id="icon_prenom"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
        <div>
            <input id="email" name="email" type="email" placeholder="E-mail *" />
            <label id="icon_email"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
        <div>
            <input id="tel" name="tel" type="number" placeholder="Portable *" />
            <label id="icon_tel"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
        <div>
            <input id="adress" name="adress" type="text" placeholder="Adresse *" />
            <label id="icon_adress"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
    </div>
    <div class="description">
        <h2>A propos de moi</h2>
        <textarea id="about" name="about" placeholder="Présentez-vous"></textarea>
        <label id="icon_diplome"><img src="assets/img/plus.png"></label>
    </div>
    <div class="infos">
        <div class="dipl">
            <h2>Expériences Professionelles</h2>
            <input id="diplome_annee" name="diplome" type="date" placeholder="Début *" />
            <input id="diplome_annee" name="diplome" type="date" placeholder="Fin *" />
            <input id="diplome_lieu" name="diplome" type="text" placeholder="Etablissement *" />
            <input id="diplome" name="diplome" class="diplome" type="text" placeholder="Diplôme *" />
            <label id="icon_diplome"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
        <div class="diplomes">
            <h2>Diplômes obtenues</h2>
            <input id="diplome_annee" name="diplome" type="date" placeholder="Année *" />
            <input id="diplome_lieu" name="diplome" type="text" placeholder="Etablissement *" />
            <input id="esp_pro" name="esp_pro" type="text" placeholder="Esperience professionel *" />
            <label id="icon_esp_pro"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
        <div class="competances">
            <h2>Domaine de competances</h2>
            <input id="comp" name="comp" type="text" placeholder="Compétences *" />
            <label id="icon_comp"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
        <div class="langues">
            <h2>Langues</h2>
            <input id="lang" name="lang" type="text" placeholder="langues *" />
            <label id="icon_lang"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
        <div class="Hobbies">
            <h2>Hobbies</h2>
            <input id="hob" name="hob" type="text" placeholder="hobbies *" />
            <label id="icon_lang"><img src="assets/img/plus.png"></label>
            <span class="error"></span>
        </div>
    </div>
    <div class="envoie">
        <input id="valider" type="submit" name="submited" value="Valider" />
    </div>
</form>
