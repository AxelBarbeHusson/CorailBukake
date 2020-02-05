<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$title = 'Connexion';

$errors = array();
$success = false;

if (!empty($_POST['submitted'])) {

    $login = clean($_POST['login']);
    $password = clean($_POST['password']);

    if (empty($login) || empty($password)) {
        $errors['login'] = 'Veuillez renseigner ces champs';
    } else {
        $sql = "SELECT * FROM users WHERE pseudo = :login OR email = :login";
        $query = $pdo->prepare($sql);
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch();

        if (!empty($user)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['login'] = array(
                    'id' => $user['id'],
                    'pseudo' => $user['pseudo'],
                    'role' => $user['role'],
                    'ip' => $_SERVER['REMOTE_ADDR']
                );
                header('Location:index.php');
            } else {
                $errors['login'] = 'Pseudo/E-mail inconnu ou mot de passe oublié';
            }
        } else {
            $errors['login'] = 'Pseudo/E-mail inconnu';
        }
    }
}
include('inc/header.php'); ?>

        <div class="titlelogin">
            <h1> Connexion </h1>
        </div>
        <form id="formLog" action="connexion.php" method="post">
            <label for="login">Pseudo ou E-mail : </label>
            <input type="text" name="login" id="login" value="<?php if (!empty($_POST['login'])) {
                echo $_POST['login'];
            } ?>">
            <p class="error"><?php if (!empty($errors['login'])) {
                    echo $errors['login'];
                } ?></p>

            <label for="password">Mot de passe : </label>
            <input type="password" name="password" id="password" value="<?php if (!empty($_POST['password'])) {
                echo $_POST['password'];
            } ?>">
            <p class="error"><?php if (!empty($errors['password'])) {
                    echo $errors['password'];
                } ?></p>
            <input type="submit" name="submitted" value="Connectez vous">
        </form>
        <a href="mot-de-passe-oublie.php"> Mot de passe oublié </a>
        <div class="clear"></div>

<?php include('inc/footer.php');
