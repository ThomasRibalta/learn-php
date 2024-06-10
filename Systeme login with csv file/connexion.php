<?php
$title = "Connexion";
require "header.php";
require "account_manager.php";
?>

<?php if (isset($_GET['status'])): ?>
    <div class="alert alert-danger"><?= $_GET['status'] ?></div>
<?php endif; ?>

<div class="container mt-5">
    <h1>Connexion</h1>
    <form action="is_connect.php" method="post">
        <div class="form-group mt-5">
            <label for="pseudo">Pseudonyme</label>
            <input type="text" name="connect-pseudo" id="pseudo" class="form-control" placeholder="Entrez votre pseudo...">
            <label for="password">Password</label>
            <input type="password" name="connect-password" id="password" class="form-control" placeholder="Entrez votre mot de passe">
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Se connecter</button>
        </div>
    </form>
</div>