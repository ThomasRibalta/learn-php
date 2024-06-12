<?php
$tilte = 'Compteur du vue';
require 'header.php';
require 'compteur.php';
$vue = increment_count();
?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1>Compteur de vue</h1>
            <p>Le site a été vu <?= $vue ?> fois</p>
        </div>
    </div>
</div>