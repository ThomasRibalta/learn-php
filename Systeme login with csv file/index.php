<?php
$title = "Inscription";
require "header.php";
require "account_manager.php";
?>

<?php if (isset($_GET['status'])): ?>
    <div class="alert alert-danger"><?= $_GET['status'] ?></div>
<?php endif; ?>

<div class="container mt-5">
    <h1>Inscription</h1>
    <form action="is_connect.php" method="post">
        <div class="form-group">
            <label for="pseudo">Pseudonyme</label>
            <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Entrez votre pseudo...">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre e-mail">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe">
        </div>
        <div class="form-group">
            <button class="btn btn-primary">S'inscrire</button>
        </div>
    </form>
</div>