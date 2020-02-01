<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$title = 'Inscription';

$errors = array();
$success = false;


if (!empty($_POST['submitted'])) {

    $pseudo = clean($_POST['pseudo']);
    $email = clean($_POST['email']);
    $password1 = clean($_POST['password1']);
    $password2 = clean($_POST['password2']);
    $cgu       = clean($_POST['cgu']);


    if (empty($pseudo)) {
        $errors['pseudo'] = 'Veuillez renseigner ce champ !';
    } elseif (mb_strlen($pseudo) >= 100) {
        $errors['pseudo'] = 'Maximum 100 caractères';
    } elseif (mb_strlen($pseudo) <= 2) {
        $errors['pseudo'] = 'Minimum 2 caractères';
    } else {
        $sql = "SELECT id FROM users WHERE pseudo = :pseudo";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if (!empty($verifPseudo)) {
            $errors['pseudo'] = 'Ce pseudo existe déjà !';
        }
    }

    if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Veuillez renseigner une adresse mail VALIDE !';
    } else {
        $sql = "SELECT id FROM users WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if (!empty($verifPseudo)) {
            $errors['email'] = 'Cette adresse mail est déjà utilisée !';
        }
    }

    if (!empty($password1)) {
        if ($password1 != $password2) {
            $errors['password'] = 'Les 2 mots de passes doivent être identiques !';
        } elseif (mb_strlen($password1) <= 5) {
            $errors['password'] = 'Minimum 6 caractères';
        }
    } else {
        $errors['password'] = 'Entrez un mot de passe !';
    }

    if (!empty($_POST['cgu']) && $_POST['cgu']) {

    } else {
        $errors['cgu'] = 'Veuillez accepter les Conditions générales d’utilisation.';
    }


    if (count($errors) == 0) {

        $hashpassword = password_hash($password1, PASSWORD_BCRYPT);
        $token = generateRandomString(200);

        $sql = "INSERT INTO users VALUES (null, :pseudo, :email, :password, :token, 'abonne', NOW())";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $hashpassword, PDO::PARAM_STR);
        $query->bindValue(':token', $token, PDO::PARAM_STR);
        $query->execute();
        $success = true;

        header('Location: login.php');
    }
}

include('inc/header.php'); ?>
    <div class="clear"></div>
    <div class="wrap">
        <h1> Inscription </h1>
        <form action="inscription.php" method="post">
            <label for="pseudo"> Pseudo : </label>
            <input type="text" name="pseudo" id="pseudo" value="<?php if (!empty($_POST['pseudo'])) {
                echo $_POST['pseudo'];
            } ?>">
            <p class="error"><?php if (!empty($errors['pseudo'])) {
                    echo $errors['pseudo'];
                } ?></p>

            <label for="email"> Email : </label>
            <input type="email" name="email" id="email" value="<?php if (!empty($_POST['email'])) {
                echo $_POST['email'];
            } ?>">
            <p class="error"><?php if (!empty($errors['email'])) {
                    echo $errors['email'];
                } ?></p>

            <label for="password1"> Mot de passe : </label>
            <input type="password" name="password1" id="password1" value="">
            <p class="error"><?php if (!empty($errors['password'])) {
                    echo $errors['password'];
                } ?></p>

            <label for="password2"> Confirmez votre mot de passe : </label>
            <input type="password" name="password2" id="password2" value="">


            <a href="cgu.php"> Conditions générales d’utilisation </a>
            <input type="checkbox" name="cgu" id="cgu" value="yes" <?php  if(!empty($_GET['condition'])) {if($_GET['condition'] == 'yes') {echo 'checked';}} ?>>
            <p class="error"><?php if(!empty($errors['cgu'])) { echo $errors['cgu']; } ?></p>


            <input type="submit" name="submitted" value="Inscrivez vous">
        </form>
        <div class="clear"></div>
    </div>
<?php include('inc/footer.php');