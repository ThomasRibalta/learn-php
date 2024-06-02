<?php
$title = "Game";
$number = 42;
$PFC_TAB = ["Pierre", "Feuille", "Ciseau"];
$PFC_RESULT = $PFC_TAB[rand(0, 2)];

require "header.php";
?>

<?php if (isset($_POST["number"]) && $_POST["number"] < $number): ?>
    <div class="container mt-5">
        <h1 class="text-center mt-5">C'est plus (<?=$_POST["number"]?>)!</h1>
    </div>
<?php elseif (isset($_POST["number"]) && $_POST["number"] > $number): ?>
    <div class="container mt-5">
        <h1 class="text-center mt-5">C'est moins (<?=$_POST["number"]?>)!</h1>
    </div>
<?php else: ?>
    <div class="container mt-5">
        <h1 class="text-center mt-5">Bravo vous avez trouvé <?=$number?>!</h1>
    </div>
<?php endif; ?>

<form action="index.php" method="POST">
    <div class="container mt-5">
        <h1 class="text-center mt-5">Jeu de devinette</h1>
        <p class="text-center">Devinez le nombre entre 1 et 100</p>
        <div class="form-group">
            <label for="number">Entrez un nombre</label>
            <input type="number" class="form-control" id="number" name="number" required>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
</form>

<?php if (isset($_POST["choice"])): ?>
    <div class="container mt-5">
        <h3 class="text-center mt-5">Vous avez choisi <?=$_POST["choice"]?>!</h3>
        <h3 class="text-center mt-5">L'ordinateur a choisi <?=$PFC_RESULT?>!</h3>
    </div>
    <?php if ($_POST["choice"] === $PFC_RESULT): ?>
        <div class="container mt-5">
            <h2 class="text-center mt-5">Egalité!</h2>
        </div>
    <?php elseif ($_POST["choice"] === "Pierre" && $PFC_RESULT === "Feuille"): ?>
        <div class="container mt-5">
            <h2 class="text-center mt-5">Vous avez perdu!</h2>
        </div>
    <?php elseif ($_POST["choice"] === "Feuille" && $PFC_RESULT === "Ciseau"): ?>
        <div class="container mt-5">
            <h2 class="text-center mt-5">Vous avez perdu!</h2>
        </div>
    <?php elseif ($_POST["choice"] === "Ciseau" && $PFC_RESULT === "Pierre"): ?>
        <div class="container mt-5">
            <h2 class="text-center mt-5">Vous avez perdu!</h2>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <h2 class="text-center mt-5">Vous avez gagné!</h2>
        </div>
    <?php endif; ?>
<?php endif; ?>

<form action="index.php" method="POST">
    <div class="container mt-5">
        <h1 class="text-center mt-5">Pierre Feuille Ciseau</h1>
        <p class="text-center">Choisissez entre Pierre, Feuille et Ciseau</p>
        <div class="form-group">
            <label for="choice">Entrez un choix</label>
            <select class="form-control" id="choice" name="choice" required>
                <option value="Pierre">Pierre</option>
                <option value="Feuille">Feuille</option>
                <option value="Ciseau">Ciseau</option>
            </select>
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
</form>

<?php if (isset($_POST["flavor"])): ?>
    <div class="container mt-5">
        <h3 class="text-center mt-5">Vous avez choisi:</h3>
        <ul class="list-group">
            <?php foreach ($_POST["flavor"] as $flavor): ?>
                <li class="list-group-item"><?=$flavor?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="index.php" method="POST">
    <div class="container mt-5">
        <h1 class="text-center mt-5">Fais ta glace</h1>
        <p class="text-center">Choisissez entre les parfums, les coulis et les toppings</p>
        <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="flavor[]" value="Vanille" id="vanille">
                    <label class="form-check-label" for="vanille">Vanille</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="flavor[]" value="Chocolat" id="chocolat">
                    <label class="form-check-label" for="chocolat">Chocolat</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="flavor[]" value="Fraise" id="fraise">
                    <label class="form-check-label" for="fraise">Fraise</label>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
</form>