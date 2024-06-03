<?php 
$title = "Little Shop";
$euro = 0;
$articles = [
    "Banane" => [
        "name" => "Banane",
        "price" => 1.5,
        "image" => "image_shop/banane.jpeg"
    ],
    "Pomme" => [
        "name" => "Pomme",
        "price" => 2.5,
        "image" => "image_shop/pomme.jpeg"
    ],
    "Poire" => [
        "name" => "Poire",
        "price" => 3.5,
        "image" => "image_shop/poire.jpeg"
    ],
    "Cerise" => [
        "name" => "Cerise",
        "price" => 4.5,
        "image" => "image_shop/cerise.jpeg"
    ],
    "Cerise1" => [
      "name" => "Cerise",
      "price" => 4.5,
      "image" => "image_shop/cerise.jpeg"
    ],
    "Cerise2" => [
      "name" => "Cerise",
      "price" => 4.5,
      "image" => "image_shop/cerise.jpeg"
    ]
];
require "header.php";
?>

<?php if (isset($_POST["article"])): ?>
    <div class="alert alert-success mt-5" role="alert">
      Vous avez acheté :
        <?php foreach ($_POST["article"] as $value): ?>
            <?=$value?>
            <?php $euro += (float) $articles[$value]["price"]?>
        <?php endforeach; ?>
      <?=$euro?>€ !
    </div>
<?php endif; ?>

<form action="index.php" method="post">
    <div class="container mt-5">
      <h1 class="text-center mt-5">Bienvenue sur notre e-boutique</h1>
        <div class="form-row mt-5">
          <?php foreach ($articles as $value): ?>
            <div class="col">
              <img src="<?=$value["image"]?>" alt="<?=$value["name"]?>" width="100" height="100">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="article[]" value="<?=$value["name"]?>">
                <label class="form-check-labal" for="article"><?=$value["name"]?> - <?=$value["price"]?>€</label>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <input type="submit" class="btn btn-primary mt-5" value="Acheter ces articles">
    </div>
</form>