<?php

include('inc/pdo.php');
include('inc/function.php');

$title = 'Mot de passe oublié';

$errors = array();
$success = false;

if (!empty($_POST['submitted'])){
    $email = clean($_POST['email']);
    $sql = "SELECT email, token FROM users WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if (!empty($user)){
        $token = $user['token'];
        $email = urlencode($email);
        $html = '<a href="modif-mot-de-passe.php?email=' . $email . '&token=' . $token . '">Cliquez ici pour modifiez votre mot de passe</a>';

    } else {
        $errors['email'] = 'Mauvais mot de passe';
    }
}

include('inc/header.php'); ?>
    <div class="wrap">
        <div class="clear"></div>
        <h1> Mot de passe oublié </h1>

        <form action="" method="post">
            <label for="email">E-mail : </label>
            <input type="email" name="email" id="email" value="<?php if (!empty($_POST['email'])) {
                echo $_POST['email'];
            } ?>">
            <p class="error"><?php if (!empty($errors['email'])) {
                    echo $errors['email'];
                } ?></p>

            <input type="submit" name="submitted" value="Modifier mon mot de passe">
        </form>
        <?php if (empty($_POST['submitted'])){ echo $html; }?>
        <div class="clear"></div>
    </div>
<?php include('inc/footer.php');
