<?php 
date_default_timezone_set("Europe/Paris");
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
define("JOURS", [
    "Lundi",
    "Mardi",
    "Mercredi",
    "Jeudi",
    "Vendredi",
    "Samedi",
    "Dimanche"
]);
define("CRENAUX", [

  [
    [8, 12],
    [14, 17]
  ],
  [
    [8, 12],
    [14, 19]
  ],
  [
    [8, 12],
    [14, 16]
  ],
  [
    [8, 12],
    [14, 21]
  ],
  [
    [8, 12],
    [14, 19]
  ],
  [
    [8, 12],
    [14, 23]
  ],
  [
    [8, 12],
    [14, 23]
  ]
]);

function is_open (): bool
{
  $open = false;
  if (((int)date("H") >= (int) CRENAUX[(int)date("N") - 1][0][0] && (int) date("H") <= (int) CRENAUX[(int)date("N") - 1][0][1]) || 
    ((int)date("H") >= (int) CRENAUX[(int)date("N") - 1][1][0] && (int) date("H") <= (int) CRENAUX[(int)date("N") - 1][1][1])) {
    $open = true;
  }
  return $open;
}

require "header.php";
?>

<?php if (is_open()): ?>
    <div class="alert alert-success mt-1" role="alert">
      L'e-boutique est ouverte !
    </div>
<?php else: ?>
    <div class="alert alert-danger mt-1" role="alert">
      L'e-boutique est fermée !
    </div>
<?php endif; ?>

<?php if (isset($_POST["article"]) && is_open()): ?>
    <div class="alert alert-success mt-1" role="alert">
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

<div class="row mt-5">
  <div class="col">
  </div>
  <div class="col text-center">
    <h2>Horaires d'ouvertures de l'e-boutique</h2>
    <table class="table table-striped table-bordered mt-3">
      <thead>
        <tr>
          <?php for ($i = 0; $i < count(JOURS); $i++): ?>
            <th scope="col" <?php if ($i + 1 === (int) date("N")): ?> class="bg-success" <?php endif;?>><?=JOURS[$i]?></th>
          <?php endfor; ?>
        </tr>
      </thead>
      <tbody>
        <?php for ($i = 0; $i < 2; $i++): ?>
          <tr>
            <?php for ($j = 0; $j < count(JOURS); $j++): ?>
              <td><?=CRENAUX[$j][$i][0]?>h - <?=CRENAUX[$j][$i][1]?>h</td>
            <?php endfor; ?>
          </tr>
        <?php endfor; ?>
      </tbody>
    </table>
  </div>
</div>