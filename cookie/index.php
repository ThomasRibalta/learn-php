<?php
$title = 'Cookies';
require 'header.php';

if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter')
{
    unset($_COOKIE['pseudo']);
    setcookie('pseudo', '', time() - 10);
}
if (isset($_COOKIE['pseudo']))
    header('Location: profil.php');
if (isset($_POST['connect-pseudo']) && !empty($_POST['connect-pseudo']))
{
    setcookie('pseudo', $_POST['connect-pseudo'], time() + 365 * 24 * 3600, null, null, false, true);
    header('Location: profil.php');
}
?>

<div class="container">
    <h1>Cookie Page log try</h1>
    <form action="index.php" method="post">
        <div class="form-group mt-5">
            <label for="pseudo">Pseudonyme</label>
            <input type="text" name="connect-pseudo" id="pseudo" class="form-control" placeholder="Entrez votre pseudo...">
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Se connecter</button>
        </div>
    </form>
</div>