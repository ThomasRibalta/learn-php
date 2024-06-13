<?php
$title = "Fake Shop";
require 'header.php';
require 'class/FakeShop.php';

$fakeShop = new FakeShop('https://fakestoreapi.com/products?limit=5');
$articles = $fakeShop->getArticles();
?>

<div class="container">
    <div class="row">
    <?php
    foreach ($articles as $article) {
      echo $fakeShop->articlesToHTML($article);
    }
    ?>
</div>