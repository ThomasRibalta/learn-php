<?php
$title = 'Profil';
require 'header.php';

if (isset($_COOKIE['pseudo']))
{
    echo '<div class="container mt-5">';
    echo '<h1>Profil</h1>';
    echo '<p>Bonjour ' . $_COOKIE['pseudo'] . '</p>';
    echo '</div>';
}
else
{
    header('Location: index.php');
}
?>

<div class="container">
    <a href="index.php?action=deconnecter" class="btn btn-danger">Se déconnecter</a>
</div>